<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produtos extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('produtos_model');
        $this->data['menuProdutos'] = 'Produtos';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }

        $this->load->library('pagination');

        $pesquisa = $this->input->get('pesquisa');
        $de = $this->input->get('de');
        $ate = $this->input->get('ate');
        $sort = $this->input->get('sort') ?: 'idProdutos';
        $order = $this->input->get('order') ?: 'desc';

        $this->data['configuration']['base_url'] = site_url('produtos/gerenciar/');
        
        // Filtros para contagem
        if ($pesquisa) {
            $this->db->group_start()
                ->like('codDeBarra', $pesquisa)
                ->or_like('descricao', $pesquisa)
                ->group_end();
        }
        if ($de) {
            $this->db->where('dataCadastro >=', $de);
        }
        if ($ate) {
            $this->db->where('dataCadastro <=', $ate);
        }
        $this->data['configuration']['total_rows'] = $this->db->count_all_results('produtos');

        // Monta o sufixo da URL para manter os filtros na paginação
        $suffix = '';
        if ($pesquisa) $suffix .= ($suffix ? '&' : '?') . "pesquisa={$pesquisa}";
        if ($de) $suffix .= ($suffix ? '&' : '?') . "de={$de}";
        if ($ate) $suffix .= ($suffix ? '&' : '?') . "ate={$ate}";
        if ($sort !== 'idProdutos') $suffix .= ($suffix ? '&' : '?') . "sort={$sort}";
        if ($order !== 'desc') $suffix .= ($suffix ? '&' : '?') . "order={$order}";

        if ($suffix) {
            $this->data['configuration']['suffix'] = $suffix;
            $this->data['configuration']['first_url'] = base_url("index.php/produtos/gerenciar") . $suffix;
        }

        $this->pagination->initialize($this->data['configuration']);

        // Busca dos dados com filtros e paginação
        $this->db->select('produtos.*, produtos_imagens.thumb');
        $this->db->from('produtos');
        $this->db->join('produtos_imagens', 'produtos_imagens.produtos_id = produtos.idProdutos AND produtos_imagens.principal = 1', 'left');
        
        if ($pesquisa) {
            $this->db->group_start()
                ->like('codDeBarra', $pesquisa)
                ->or_like('descricao', $pesquisa)
                ->group_end();
        }
        if ($de) {
            $this->db->where('dataCadastro >=', $de);
        }
        if ($ate) {
            $this->db->where('dataCadastro <=', $ate);
        }
        
        $this->db->order_by($sort, $order);
        $this->db->limit($this->data['configuration']['per_page'], $this->uri->segment(3));
        
        $this->data['results'] = $this->db->get()->result();
        // dd([$this->data['results'], $this->db->last_query()]);

        $this->data['view'] = 'produtos/produtos';
        return $this->layout();
    }

    public function adicionar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(',', '', $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(',', '', $precoVenda);
            $data = [
                'codDeBarra' => set_value('codDeBarra'),
                'descricao' => set_value('descricao'),
                'unidade' => set_value('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => set_value('estoque'),
                'estoqueMinimo' => set_value('estoqueMinimo'),
                'saida' => set_value('saida'),
                'entrada' => set_value('entrada'),
                'url_pagina' => set_value('url_pagina'),
                'url_especificacoes' => set_value('url_especificacoes'),
                'ncm' => set_value('ncm'),
                'cest' => set_value('cest'),
                'origem' => set_value('origem'),
                'cst_csosn' => set_value('cst_csosn'),
                'ibs_cbs' => set_value('ibs_cbs'),
                'aliquota_icms' => $this->input->post('aliquota_icms') ?: '0.00',
            ];

            if ($idProduto = $this->produtos_model->add('produtos', $data, true)) {
                $this->uploadImagens($idProduto);
                $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
                log_info('Adicionou um produto');
                redirect(site_url('produtos/adicionar/'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';

        return $this->layout();
    }

    public function editar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3)) || ! $this->produtos_model->getById($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Produto não encontrado ou parâmetro inválido.');
            redirect('produtos/gerenciar');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(',', '', $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(',', '', $precoVenda);
            $data = [
                'codDeBarra' => $this->input->post('codDeBarra'),
                'descricao' => $this->input->post('descricao'),
                'unidade' => $this->input->post('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => $this->input->post('estoque'),
                'estoqueMinimo' => $this->input->post('estoqueMinimo'),
                'saida' => set_value('saida'),
                'entrada' => set_value('entrada'),
                'url_pagina' => $this->input->post('url_pagina'),
                'url_especificacoes' => $this->input->post('url_especificacoes'),
                'ncm' => $this->input->post('ncm'),
                'cest' => $this->input->post('cest'),
                'origem' => $this->input->post('origem'),
                'cst_csosn' => $this->input->post('cst_csosn'),
                'ibs_cbs' => $this->input->post('ibs_cbs'),
                'aliquota_icms' => $this->input->post('aliquota_icms') ?: '0.00',
            ];

            if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == true) {
                $this->uploadImagens($this->input->post('idProdutos'));
                $this->session->set_flashdata('success', 'Produto editado com sucesso!');
                log_info('Alterou um produto. ID: ' . $this->input->post('idProdutos'));
                redirect(site_url('produtos/editar/') . $this->input->post('idProdutos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));
        $this->data['images'] = $this->produtos_model->getImages($this->uri->segment(3));

        $productId = $this->data['result']->idProdutos;
        $baseUrl = rtrim($_ENV['APP_BASEURL'] ?? base_url(), '/');
        
        // Prioriza a URL da página cadastrada, caso contrário usa a URL padrão da loja
        $productUrl = !empty($this->data['result']->url_pagina) 
            ? $this->data['result']->url_pagina 
            : $baseUrl . '/loja/produto/' . $productId;

        $qrCode = new \Mpdf\QrCode\QrCode($productUrl);
        $output = new \Mpdf\QrCode\Output\Svg();
        $this->data['qrCode'] = $output->output($qrCode, 150);
        $this->data['productUrl'] = $productUrl;

        $this->data['view'] = 'produtos/editarProduto';

        return $this->layout();
    }

    public function visualizar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));
        $this->data['images'] = $this->produtos_model->getImages($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto não encontrado.');
            redirect(site_url('produtos'));
        }

        $this->data['view'] = 'produtos/visualizarProduto';

        return $this->layout();
    }

    public function atualizarNCM()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para atualizar a tabela NCM.');
            redirect(base_url('index.php/produtos/gerenciar/'));
        }

        $url = 'https://portalunico.siscomex.gov.br/classif/api/publico/nomenclatura/download/json';
        
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MapOS/1.0\r\n"
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false
            ]
        ];

        $context = stream_context_create($opts);
        $json = @file_get_contents($url, false, $context);

        if ($json) {
            $path = FCPATH . 'assets/json/ncm.json';
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }
            if (file_put_contents($path, $json)) {
                $this->session->set_flashdata('success', 'Tabela NCM atualizada com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao salvar o arquivo JSON do NCM na pasta assets.');
            }
        } else {
            $this->session->set_flashdata('error', 'Erro ao baixar a tabela NCM oficial da Receita Federal.');
        }

        redirect(base_url('index.php/produtos/gerenciar/'));
    }

    public function autoCompleteNCM()
    {
        $search = $this->input->get('search');
        if (!$search) { echo json_encode([]); return; }

        $search = strtolower(trim($search));
        $path = FCPATH . 'assets/json/ncm.json';

        if (!file_exists($path)) {
            echo json_encode([['label' => 'Tabela NCM não encontrada. Clique no botão "Atualizar NCM" na listagem de produtos.', 'value' => '']]);
            return;
        }

        $data = json_decode(file_get_contents($path), true);
        $results = [];
        $nomenclaturas = isset($data['Nomenclaturas']) ? $data['Nomenclaturas'] : [];

        foreach ($nomenclaturas as $ncm) {
            if (count($results) >= 15) break;
            
            $codigo = isset($ncm['Codigo']) ? str_replace('.', '', $ncm['Codigo']) : '';
            $descricao = isset($ncm['Descricao']) ? $ncm['Descricao'] : '';

            if (strlen($codigo) === 8 && (strpos(strtolower($codigo), $search) !== false || strpos(strtolower($descricao), $search) !== false)) {
                $results[] = ['label' => $codigo . ' - ' . (strlen($descricao) > 50 ? substr($descricao, 0, 50) . '...' : $descricao), 'value' => $codigo];
            }
        }
        echo json_encode($results);
    }

    public function consultarCosmos()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $gtin = $this->input->get('gtin');
        if (!$gtin) {
            echo json_encode(['result' => false, 'message' => 'GTIN não informado.']);
            return;
        }

        $token = $_ENV['COSMOS_API_TOKEN'] ?? getenv('COSMOS_API_TOKEN');
        if (!$token) {
            echo json_encode(['result' => false, 'message' => 'Token da API Cosmos não configurado no .env (COSMOS_API_TOKEN).']);
            return;
        }

        $url = "https://api.cosmos.bluesoft.com.br/gtins/{$gtin}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Cosmos-Token: {$token}", "User-Agent: MapOS"]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 200) { echo $response; } else { echo json_encode(['result' => false, 'message' => 'Produto não encontrado na base do Cosmos ou erro na API.']); }
    }

    public function uploadImagens($idProduto)
    {
        // Revertido para o nome padrão 'userfile' que funciona no projeto antigo
        if (empty($_FILES['userfile']['name'][0])) {
            return;
        }

        $this->load->library('upload');
        $this->load->library('image_lib');

        $upload_path = FCPATH . 'assets/uploads/produtos';
        $thumb_path = $upload_path . '/thumbs';

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        if (!file_exists($thumb_path)) {
            mkdir($thumb_path, 0777, true);
        }

        // Configuração básica
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF',
            'max_size' => 2048, // 2MB
            'encrypt_name' => true,
            'detect_mime' => true,
        ];

        $images = [];
        $files = $_FILES['userfile'];
        $principal_index = $this->input->post('principal_index');
        $reset_done = false;

        foreach ($files['name'] as $key => $image) {
            if (empty($files['name'][$key])) continue;

            $_FILES['single_file']['name'] = $files['name'][$key];
            $_FILES['single_file']['type'] = $files['type'][$key];
            $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['single_file']['error'] = $files['error'][$key];
            $_FILES['single_file']['size'] = $files['size'][$key];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('single_file')) {
                // Só reseta se pelo menos um upload deu certo e temos intenção de definir principal
                if (!$reset_done && ($principal_index !== null && $principal_index !== '')) {
                    $this->db->where('produtos_id', $idProduto);
                    $this->db->update('produtos_imagens', ['principal' => 0]);
                    $reset_done = true;
                }

                $data = $this->upload->data();
                
                // Gerar Thumbnail
                $config_thumb = [
                    'image_library' => 'gd2',
                    'source_image' => $data['full_path'],
                    'new_image' => $thumb_path . '/' . $data['file_name'],
                    'maintain_ratio' => TRUE,
                    'width' => 200,
                    'height' => 200
                ];
                $this->image_lib->initialize($config_thumb);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $images[] = [
                    'url' => base_url('assets/uploads/produtos/' . $data['file_name']),
                    'thumb' => base_url('assets/uploads/produtos/thumbs/' . $data['file_name']),
                    'path' => $data['full_path'],
                    'produtos_id' => $idProduto,
                    'principal' => ($principal_index !== null && $principal_index !== '' && (string)$principal_index === (string)$key) ? 1 : 0
                ];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Erro no arquivo "' . $files['name'][$key] . '": ' . strip_tags($error));
            }
        }

        if (!empty($images)) {
            $this->produtos_model->addImages($images);
        }
    }

    public function excluirImagem()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(['result' => false, 'message' => 'Permissão negada']));
        }

        $idImage = $this->input->post('id');
        if (!$idImage) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['result' => false, 'message' => 'ID não informado']));
        }

        $image = $this->produtos_model->getImageById($idImage);

        if ($image) {
            // Remover arquivos físicos
            if (file_exists($image->path)) {
                unlink($image->path);
            }
            $thumb_path = FCPATH . 'assets/uploads/produtos/thumbs/' . basename($image->path);
            if (file_exists($thumb_path)) {
                unlink($thumb_path);
            }

            if ($this->produtos_model->deleteImage($idImage)) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['result' => true]));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['result' => false, 'message' => 'Erro ao excluir do banco']));
            }
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['result' => false, 'message' => 'Imagem não encontrada']));
        }
    }

    public function marcarPrincipal()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(['result' => false, 'message' => 'Permissão negada']));
        }

        $idImage = $this->input->post('id');
        $idProduto = $this->input->post('idProduto');

        if ($this->produtos_model->setMainImage($idImage, $idProduto)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['result' => true]));
        } else {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['result' => false]));
        }
    }

    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(site_url('produtos/gerenciar/'));
        }

        $this->db->where('produtos_id', $id);
        $this->db->delete('produtos_os');

        $this->db->where('produtos_id', $id);
        $this->db->delete('itens_de_vendas');

        $this->db->where('produtos_id', $id);
        $this->db->delete('produtos_imagens');

        $this->produtos_model->delete('produtos', 'idProdutos', $id);

        log_info('Removeu um produto. ID: ' . $id);
        $this->session->set_flashdata('success', 'Produto excluído com sucesso!');

        redirect(site_url('produtos/gerenciar/'));
    }

    public function atualizar_estoque()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para atualizar estoque de produtos.');
            redirect(base_url());
        }

        $idProduto = $this->input->post('id');
        $estoque = $this->input->post('estoque');

        if ($this->produtos_model->updateEstoque($idProduto, $estoque) == true) {
            $this->session->set_flashdata('success', 'Estoque atualizado com sucesso!');
            log_info('Atualizou estoque de um produto. ID: ' . $idProduto);
            redirect(site_url('produtos/visualizar/') . $idProduto);
        } else {
            $this->data['custom_error'] = '<div class="alert">Ocorreu um erro.</div>';
        }
    }

    public function importarXml()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para importar produtos.');
            redirect(base_url());
        }

        $config['upload_path'] = './assets/uploads/xml_produtos';
        $config['allowed_types'] = 'xml';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = true;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = ['error' => $this->upload->display_errors()];
            $this->session->set_flashdata('error', 'Erro ao fazer upload do arquivo XML: ' . $error['error']);
            redirect(site_url('produtos'));
        }
        
        $data = $this->upload->data();
        $xmlFile = $data['full_path'];

        $xml = simplexml_load_file($xmlFile);
        if ($xml === false) {
            $this->session->set_flashdata('error', 'Não foi possível ler o arquivo XML.');
            redirect(site_url('produtos'));
        }

        $namespace = $xml->getNamespaces(true);
        $namespace = array_shift($namespace);
        $xml->registerXPathNamespace('nfe', $namespace);

        $produtosAdicionados = 0;
        $produtosAtualizados = 0;

        foreach ($xml->xpath('//nfe:det') as $det) {
            $det->registerXPathNamespace('nfe', $namespace);
            $prod = $det->prod;

            $cEAN = (string)$prod->cEAN;
            $cProd = (string)$prod->cProd;
            $codDeBarra = ($cEAN && $cEAN !== 'SEM GTIN') ? $cEAN : $cProd;

            if(empty($codDeBarra)) {
                continue;
            }

            $descricao = (string)$prod->xProd;
            $unidade = (string)$prod->uCom;
            $precoCompra = (float)$prod->vUnCom;
            $estoque = (int)$prod->qCom;
            $ncm = (string)$prod->NCM;
            $origem = (string)$prod->orig;
            $cst_csosn = (string)$prod->CST;

            $produtoExistente = $this->produtos_model->getByCodDeBarra($codDeBarra);

            if ($produtoExistente) {
                $novoEstoque = $produtoExistente->estoque + $estoque;
                if($this->produtos_model->edit('produtos', ['estoque' => $novoEstoque], 'idProdutos', $produtoExistente->idProdutos)) {
                    $produtosAtualizados++;
                }
            } else {
                $data = [
                    'codDeBarra' => $codDeBarra,
                    'descricao' => $descricao,
                    'unidade' => $unidade,
                    'precoCompra' => $precoCompra,
                    'precoVenda' => $precoCompra, // Default to purchase price
                    'estoque' => $estoque,
                    'estoqueMinimo' => 0,
                    'saida' => 0,
                    'entrada' => $estoque,
                    'ncm' => $ncm,
                    'origem' => $origem,
                    'cst_csosn' => $cst_csosn,
                    'dataCadastro' => date('Y-m-d')
                ];
                if($this->produtos_model->add('produtos', $data)) {
                    $produtosAdicionados++;
                }
            }
        }

        unlink($xmlFile); // Remove the uploaded file

        $this->session->set_flashdata('success', "Importação concluída! {$produtosAdicionados} produtos adicionados e {$produtosAtualizados} atualizados.");
        redirect(site_url('produtos'));
    }
}
