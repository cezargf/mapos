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
            foreach ($cities as $city) {
                if (stripos($city['nome'], $term) !== false) {
                    $results[] = ['id' => $city['nome'], 'text' => $city['nome'], 'ibge' => $city['id']];
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['results' => $results]));
    }
}
