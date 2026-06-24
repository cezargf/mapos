<?php
/**
 * Proxy para consultar cidades da API do IBGE com cache local.
 * Localizado em: application/controllers/api/Ibge.php
 */
class Ibge extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cache_dir = APPPATH . 'cache/ibge/';
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }

    public function cidades($uf) {
        $uf = strtoupper($uf);
        $cache_file = $this->cache_dir . "cidades_{$uf}.json";
        
        // Se o cache existe e tem menos de 30 dias, usa ele
        if (file_exists($cache_file) && (time() - filemtime($cache_file) < 30 * 24 * 60 * 60)) {
            $data = file_get_contents($cache_file);
        } else {
            // Tenta buscar da API
            $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_code == 200 && !empty($response)) {
                file_put_contents($cache_file, $response);
                $data = $response;
            } else {
                // Se falhou, tenta servir o cache antigo mesmo que expirado
                if (file_exists($cache_file)) {
                    $data = file_get_contents($cache_file);
                } else {
                    $data = json_encode([]);
                }
            }
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output($data);
    }

    public function search_cities($uf)
    {
        $term = $this->input->get('term');
        $uf = strtoupper($uf);
        $cache_file = $this->cache_dir . "cidades_{$uf}.json";
        $cities = [];

        if (file_exists($cache_file)) {
            $cities = json_decode(file_get_contents($cache_file), true);
        } else {
            // Se não houver cache, busca na hora
            $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios";
            $response = @file_get_contents($url);
            if ($response) {
                file_put_contents($cache_file, $response);
                $cities = json_decode($response, true);
            }
        }

        $results = [];
        if ($cities) {
            // Função para remover acentos e normalizar a string
            $normalize = function ($string) {
                $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ';
                $b = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
                $string = utf8_decode($string);
                $string = strtr($string, utf8_decode($a), $b);
                $string = strtolower($string);
                return utf8_encode($string);
            };

            $isNumericTerm = is_numeric($term);

            foreach ($cities as $city) {
                if ($isNumericTerm) {
                    if ($city['id'] == $term) {
                        $results[] = [
                            'id' => $city['nome'], 
                            'text' => $city['nome'], 
                            'ibge' => $city['id']
                        ];
                    }
                } else {
                    $termNormalized = $normalize($term);
                    if (strpos($normalize($city['nome']), $termNormalized) !== false) {
                        $results[] = [
                            'id' => $city['nome'], 
                            'text' => $city['nome'], 
                            'ibge' => $city['id']
                        ];
                    }
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['results' => $results]));
    }

    public function consultarCnae()
    {
        $term = $this->input->get('term');
        $cnae_file = FCPATH . 'assets/json/cnae.json';
        $cnaes = [];
        $source = 'file';

        if (file_exists($cnae_file)) {
            $cnaes = json_decode(file_get_contents($cnae_file), true);
        } else {
            $url = "https://servicodados.ibge.gov.br/api/v2/cnaes/classes";
            $response = @file_get_contents($url);
            if ($response) {
                file_put_contents($cnae_file, $response);
                $cnaes = json_decode($response, true);
                $source = 'api';
            }
        }

        $results = [];
        if ($cnaes && $term) {
            foreach ($cnaes as $cnae) {
                $code = '';
                $desc = '';

                if ($source === 'api') {
                    if (isset($cnae['id']) && isset($cnae['descricao'])) {
                        $code = strval($cnae['id']);
                        $desc = $cnae['descricao'];
                    }
                } else {
                    if (isset($cnae['cod']) && isset($cnae['desc'])) {
                        $code = $cnae['cod'];
                        $desc = $cnae['desc'];
                    }
                }

                if ($code) {
                    $id = preg_replace('/[^0-9]/', '', $code);
                    if (stripos($id, $term) !== false || stripos($desc, $term) !== false || stripos($code, $term) !== false) {
                        $results[] = ['id' => $id, 'text' => $code . ' - ' . $desc];
                    }
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['results' => $results]));
    }
}
