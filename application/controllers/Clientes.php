<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Clientes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('clientes_model');
        $this->load->model('contatos_model');
        $this->load->model('usuarios_clientes_model');
        $this->data['menuClientes'] = 'clientes';
    }

    public function index()
    {
        $this->gerenciar();
    }

    public function gerenciar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $pesquisa = $this->input->get('pesquisa');
        $cidade = $this->input->get('cidade'); // Pode ser um array
        $estado = $this->input->get('estado'); // Pode ser um array
        $tipo = $this->input->get('tipo');
        $sort = $this->input->get('sort') ?: 'idClientes';
        $order = $this->input->get('order') ?: 'desc';

        $this->load->library('pagination');

        // Inicia com a configuração de paginação base
        $config = $this->data['configuration'];
        
        $perPage = $this->input->get('per_page') ?: $config['per_page'];

        // Sobrescreve e adiciona as configurações necessárias
        $config['base_url'] = site_url('clientes/gerenciar');
        $config['total_rows'] = $this->clientes_model->countWithFilters($pesquisa, $estado, $cidade, $tipo);
        $config['per_page'] = $perPage;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true; // Mantém os parâmetros GET na paginação

        // Remove configurações antigas que não são mais necessárias com a abordagem atual
        unset($config['suffix']);
        unset($config['first_url']);
        
        $this->pagination->initialize($config);

        $this->data['results'] = $this->clientes_model->getWithFilters(
            $pesquisa,
            $estado,
            $cidade,
            $tipo,
            $sort,
            $order,
            $config['per_page'],
            $this->input->get('page', true) ?: 0
        );

        $this->data['view'] = 'clientes/clientes';

        return $this->layout();
    }

    public function getGeographicData()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $estado = $this->input->get('estado'); // Pode ser um array
        $cidade = $this->input->get('cidade'); // Pode ser um array
        $tipo = $this->input->get('tipo');

        $this->db->select('idClientes, nomeCliente, cidade, estado, rua, numero, latitude, longitude, fornecedor');
        $this->db->from('clientes');
        $this->db->where('latitude IS NOT NULL');
        $this->db->where('longitude IS NOT NULL');

        if ($estado && !empty($estado)) {
            $this->db->where_in('estado', $estado);
        }
        if ($cidade && !empty($cidade)) {
            $this->db->where_in('cidade', $cidade);
        }
        if ($tipo !== null && $tipo !== '') {
            $this->db->where('fornecedor', $tipo);
        }

        $clientes = $this->db->get()->result();
        echo json_encode(['status' => 'success', 'data' => $clientes]);
    }

    public function pesquisarUsuariosAjax()
    {
        $termo = $this->input->get('term');
        if (!$termo) {
            echo json_encode([]);
            return;
        }

        $this->db->select('idUsuariosClientes, nome, email');
        $this->db->like('nome', $termo);
        $this->db->or_like('email', $termo);
        $this->db->limit(10);
        $usuarios = $this->db->get('usuarios_clientes')->result();

        $data = [];
        foreach ($usuarios as $u) {
            $data[] = [
                'id' => $u->idUsuariosClientes,
                'label' => $u->nome . ' (' . $u->email . ')',
                'value' => $u->nome,
                'email' => $u->email
            ];
        }

        echo json_encode($data);
    }

    public function adicionar()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $senhaCliente = $this->input->post('senha') ? $this->input->post('senha') : preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        $cpf_cnpj = preg_replace('/[^\p{L}\p{N}\s]/', '', set_value('documento'));

        if (strlen($cpf_cnpj) == 11) {
            $pessoa_fisica = true;
        } else {
            $pessoa_fisica = false;
        }

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $email = set_value('email');
            
            // Conversão de datas para o formato MySQL (YYYY-MM-DD)
            $data_situacao = set_value('data_situacao');
            if ($data_situacao) {
                $dt = explode('/', $data_situacao);
                if (count($dt) == 3) {
                    $data_situacao = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
                }
            }

            $data_situacao_especial = set_value('data_situacao_especial');
            if ($data_situacao_especial) {
                $dt_esp = explode('/', $data_situacao_especial);
                if (count($dt_esp) == 3) {
                    $data_situacao_especial = $dt_esp[2] . '-' . $dt_esp[1] . '-' . $dt_esp[0];
                }
            }

            $data = [
                'nomeCliente' => set_value('nomeCliente'),
                'contato' => set_value('contato'),
                'pessoa_fisica' => $pessoa_fisica,
                'documento' => set_value('documento'),
                'ie' => set_value('ie'),
                'im' => set_value('im'),
                'sexo' => set_value('sexo'),
                'nascimento' => set_value('nascimento'),
                'tratamento' => set_value('tratamento'),
                'telefone' => set_value('telefone'),
                'celular' => set_value('celular'),
                'email' => $email,
                'senha' => password_hash($senhaCliente, PASSWORD_DEFAULT),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'complemento' => set_value('complemento'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'codigo_ibge' => set_value('codigo_ibge'),
                'tipo' => set_value('tipo'),
                'porte' => set_value('porte'),
                'cnae' => set_value('cnae'),
                'fantasia' => set_value('fantasia'),
                'atividade_principal' => set_value('atividade_principal'),
                'atividades_secundarias' => set_value('atividades_secundarias'),
                'natureza_juridica' => set_value('natureza_juridica'),
                'situacao' => set_value('situacao'),
                'data_situacao' => $data_situacao,
                'motivo_situacao' => set_value('motivo_situacao'),
                'situacao_especial' => set_value('situacao_especial'),
                'data_situacao_especial' => $data_situacao_especial,
                'capital_social' => set_value('capital_social'),
                'qsa' => set_value('qsa'),
                'dataCadastro' => date('Y-m-d'),
                'fornecedor' => $this->input->post('fornecedor') ? 1 : 0,
                'prospectado' => 0,
                'origem_prospeccao' => '',
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
            ];

            // Obter contatos do frontend (JSON)
            $contatos_json = $this->input->post('contatos_json');
            $contatos = [];
            if ($contatos_json) {
                $contatos = json_decode($contatos_json, true);
            }

            // Iniciar transação
            $this->db->trans_start();

            // Lógica de Usuário Centralizado
            $usuario_id = $this->input->post('usuarios_clientes_id');
            if (!$usuario_id && $email) {
                $usuario_existente = $this->usuarios_clientes_model->getByEmail($email);
                if ($usuario_existente) {
                    $usuario_id = $usuario_existente->idUsuariosClientes;
                } else {
                    $usuario_data = [
                        'nome' => $data['nomeCliente'],
                        'email' => $email,
                        'senha' => $data['senha'],
                        'dataCadastro' => date('Y-m-d H:i:s')
                    ];
                    $usuario_id = $this->usuarios_clientes_model->add($usuario_data);
                }
            }

            // Inserir cliente
            $cliente_id = $this->clientes_model->add('clientes', $data);

            if ($cliente_id) {
                // Criar vínculo se tivermos um usuário
                if ($usuario_id) {
                    $vinculo_data = [
                        'usuarios_clientes_id' => $usuario_id,
                        'clientes_id' => $cliente_id,
                        'tipo' => 'admin'
                    ];
                    $this->clientes_model->addVinculo($vinculo_data);
                }

                // Inserir contatos associados
                if (is_array($contatos) && !empty($contatos)) {
                    foreach ($contatos as $contato) {
                        $contato_data = [
                            'cliente_id' => $cliente_id,
                            'nome' => isset($contato['nome']) ? $contato['nome'] : '',
                            'email' => isset($contato['email']) ? $contato['email'] : '',
                            'telefone' => isset($contato['telefone']) ? $contato['telefone'] : '',
                            'celular' => isset($contato['celular']) ? $contato['celular'] : '',
                            'cargo' => isset($contato['cargo']) ? $contato['cargo'] : '',
                            'observacoes' => isset($contato['observacoes']) ? $contato['observacoes'] : '',
                            'dataCadastro' => date('Y-m-d H:i:s')
                        ];
                        $this->contatos_model->add($contato_data);
                    }
                }

                // Completar transação
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao salvar. Por favor, tente novamente.</p></div>';
                } else {
                    $this->session->set_flashdata('success', 'Cliente e contatos adicionados com sucesso!');
                    log_info('Adicionou um cliente com contatos e vínculo de usuário.');
                    redirect(site_url('clientes/'));
                }
            } else {
                $this->db->trans_rollback();
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro ao adicionar o cliente.</p></div>';
            }
        }

        $this->data['view'] = 'clientes/adicionarCliente';

        return $this->layout();
    }

    public function editar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3)) || ! $this->clientes_model->getById($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Cliente não encontrado ou parâmetro inválido.');
            redirect('clientes/gerenciar');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $email = $this->input->post('email');
            $idCliente = $this->input->post('idClientes');
            if ($email && $this->clientes_model->emailExists($email, $idCliente)) {
                $this->data['custom_error'] = '<div class="form_error"><p>Este e-mail já está sendo utilizado por outro cliente.</p></div>';
            } else {
                $cpf_cnpj = preg_replace('/[^\p{L}\p{N}\s]/', '', $this->input->post('documento'));
                if (strlen($cpf_cnpj) == 11) {
                    $pessoa_fisica = true;
                } else {
                    $pessoa_fisica = false;
                }

                // Conversão de datas para o formato MySQL (YYYY-MM-DD)
                $data_situacao = $this->input->post('data_situacao');
                if ($data_situacao) {
                    $dt = explode('/', $data_situacao);
                    if (count($dt) == 3) {
                        $data_situacao = $dt[2] . '-' . $dt[1] . '-' . $dt[0];
                    }
                }

                $data_situacao_especial = $this->input->post('data_situacao_especial');
                if ($data_situacao_especial) {
                    $dt_esp = explode('/', $data_situacao_especial);
                    if (count($dt_esp) == 3) {
                        $data_situacao_especial = $dt_esp[2] . '-' . $dt_esp[1] . '-' . $dt_esp[0];
                    }
                }

                $data = [
                    'nomeCliente' => $this->input->post('nomeCliente'),
                    'contato' => $this->input->post('contato'),
                    'pessoa_fisica' => $pessoa_fisica,
                    'documento' => $this->input->post('documento'),
                    'ie' => $this->input->post('ie'),
                    'im' => $this->input->post('im'),
                    'sexo' => $this->input->post('sexo'),
                    'nascimento' => $this->input->post('nascimento'),
                    'tratamento' => $this->input->post('tratamento'),
                    'telefone' => $this->input->post('telefone'),
                    'celular' => $this->input->post('celular'),
                    'email' => $this->input->post('email'),
                    'rua' => $this->input->post('rua'),
                    'numero' => $this->input->post('numero'),
                    'complemento' => $this->input->post('complemento'),
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'cep' => $this->input->post('cep'),
                    'codigo_ibge' => $this->input->post('codigo_ibge'),
                    'tipo' => $this->input->post('tipo'),
                    'porte' => $this->input->post('porte'),
                    'cnae' => $this->input->post('cnae'),
                    'fantasia' => $this->input->post('fantasia'),
                    'atividade_principal' => $this->input->post('atividade_principal'),
                    'atividades_secundarias' => $this->input->post('atividades_secundarias'),
                    'natureza_juridica' => $this->input->post('natureza_juridica'),
                    'situacao' => $this->input->post('situacao'),
                    'data_situacao' => $data_situacao,
                    'motivo_situacao' => $this->input->post('motivo_situacao'),
                    'situacao_especial' => $this->input->post('situacao_especial'),
                    'data_situacao_especial' => $data_situacao_especial,
                    'capital_social' => $this->input->post('capital_social'),
                    'qsa' => $this->input->post('qsa'),
                    'fornecedor' => $this->input->post('fornecedor') ? 1 : 0,
                    'prospectado' => 0,
                    'origem_prospeccao' => '',
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                ];

                $senha = $this->input->post('senha');
                if ($senha != null) {
                    $data['senha'] = password_hash($senha, PASSWORD_DEFAULT);
                }

                $idCliente = $this->input->post('idClientes');
                $clienteAntigo = $this->clientes_model->getById($idCliente);

                if ($this->clientes_model->edit('clientes', $data, 'idClientes', $idCliente) == true) {
                    // Sincronização de Usuário Centralizado: garante que o e-mail do formulário tenha acesso
                    $email = $this->input->post('email');

                    if ($email) {
                        $usuario_existente = $this->usuarios_clientes_model->getByEmail($email);
                        $usuario_id = null;

                        if ($usuario_existente) {
                            $usuario_id = $usuario_existente->idUsuariosClientes;
                        } else {
                            // Criar novo usuário se o e-mail não existir na central
                            $senha_nova = $this->input->post('senha') ?: preg_replace('/\D/', '', $this->input->post('documento'));
                            $usuario_data = [
                                'nome' => $data['nomeCliente'],
                                'email' => $email,
                                'senha' => password_hash($senha_nova, PASSWORD_DEFAULT),
                                'dataCadastro' => date('Y-m-d H:i:s')
                            ];
                            $usuario_id = $this->usuarios_clientes_model->add($usuario_data);
                        }

                        // Garantir que o vínculo exista para este e-mail/usuário
                        if ($usuario_id && ! $this->clientes_model->checkVinculoExists($usuario_id, $idCliente)) {
                            $vinculo_data = [
                                'usuarios_clientes_id' => $usuario_id,
                                'clientes_id' => $idCliente,
                                'tipo' => 'admin'
                            ];
                            $this->clientes_model->addVinculo($vinculo_data);
                        }
                    }

                    $alteracoes = [];
                    if ($clienteAntigo) {
                        foreach ($data as $campo => $novoValor) {
                            $valorAntigo = $clienteAntigo->$campo ?? '';
                            if ($valorAntigo != $novoValor && $campo != 'senha') {
                                $alteracoes[] = $campo;
                            }
                        }
                    }
                    $detalhes = !empty($alteracoes) ? ' (Modificou: ' . implode(', ', $alteracoes) . ')' : '';

                    $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
                    log_info('Alterou um cliente. ID: ' . $idCliente . $detalhes);
                    redirect(site_url('clientes/editar/') . $idCliente);
                } else {
                    $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
                }
            }
        }

        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['usuarios_vinculados'] = $this->clientes_model->getUsuariosVinculados($this->uri->segment(3));
        $this->data['view'] = 'clientes/editarCliente';

        return $this->layout();
    }

    public function adicionarVinculoAjax()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            echo json_encode(['result' => false, 'message' => 'Você não tem permissão para editar clientes.']);
            return;
        }

        $usuario_id = $this->input->post('usuario_id');
        $cliente_id = $this->input->post('cliente_id');

        if (!$usuario_id || !$cliente_id) {
            echo json_encode(['result' => false, 'message' => 'Parâmetros inválidos.']);
            return;
        }

        if ($this->clientes_model->checkVinculoExists($usuario_id, $cliente_id)) {
            echo json_encode(['result' => false, 'message' => 'Este usuário já possui acesso a este cliente.']);
            return;
        }

        $data = [
            'usuarios_clientes_id' => $usuario_id,
            'clientes_id' => $cliente_id,
            'tipo' => 'admin'
        ];

        if ($this->clientes_model->addVinculo($data)) {
            echo json_encode(['result' => true, 'message' => 'Acesso concedido com sucesso!']);
        } else {
            echo json_encode(['result' => false, 'message' => 'Erro ao conceder acesso.']);
        }
    }

    public function removerVinculoAjax()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            echo json_encode(['result' => false, 'message' => 'Você não tem permissão para editar clientes.']);
            return;
        }

        $usuario_id = $this->input->post('usuario_id');
        $cliente_id = $this->input->post('cliente_id');

        if (!$usuario_id || !$cliente_id) {
            echo json_encode(['result' => false, 'message' => 'Parâmetros inválidos.']);
            return;
        }

        if ($this->clientes_model->removeVinculo($usuario_id, $cliente_id)) {
            echo json_encode(['result' => true, 'message' => 'Acesso removido com sucesso!']);
        } else {
            echo json_encode(['result' => false, 'message' => 'Erro ao remover acesso.']);
        }
    }

    public function visualizar()
    {
        if (! $this->uri->segment(3) || ! is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['result_vendas'] = $this->clientes_model->getAllVendasByClient($this->uri->segment(3));
        $this->data['contatos'] = $this->contatos_model->getByCliente($this->uri->segment(3));
        $this->data['view'] = 'clientes/visualizar';

        return $this->layout();
    }

    public function checkPendencias()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id = $this->input->get('id');
        $pendencias = $this->clientes_model->countPendencias($id);

        echo json_encode(['status' => 'success', 'data' => $pendencias]);
    }

    public function excluir()
    {
        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir clientes.');
            redirect(base_url());
        }

        $id = $this->input->post('id');
        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir cliente.');
            redirect(site_url('clientes/gerenciar/'));
        }

        $confirmFinanceiro = $this->input->post('confirm_financeiro');

        // Lógica Financeira: Se o usuário escolheu marcar como recebido
        if ($confirmFinanceiro == 'received') {
            $this->clientes_model->baixarPendencias($id);
            log_info('Baixou lançamentos pendentes antes de excluir o cliente. ID: ' . $id);
        }

        $os = $this->clientes_model->getAllOsByClient($id);
        if ($os != null) {
            $this->clientes_model->removeClientOs($os);
        }

        // excluindo Vendas vinculadas ao cliente
        $vendas = $this->clientes_model->getAllVendasByClient($id);
        if ($vendas != null) {
            $this->clientes_model->removeClientVendas($vendas);
        }

        // Excluindo Cobranças e Lançamentos remanescentes (não baixados)
        $this->db->where('clientes_id', $id)->delete('cobrancas');
        $this->db->where('clientes_id', $id)->delete('lancamentos');

        $this->clientes_model->delete('clientes', 'idClientes', $id);
        log_info('Removeu um cliente. ID' . $id);

        $this->session->set_flashdata('success', 'Cliente e dados vinculados excluídos com sucesso!');
        redirect(site_url('clientes/gerenciar/'));
    }

    public function autoComplete()
    {
        if ($this->input->get('term')) {
            $q = strtolower($this->input->get('term'));
            $data = $this->clientes_model->autoCompleteCliente($q);
            $results = [];
            foreach ($data as $row) {
                $label = $row->nomeCliente;
                if ($row->documento) {
                    $label .= ' | ' . $row->documento;
                }
                if ($row->email) {
                    $label .= ' | ' . $row->email;
                }
                if ($row->telefone) {
                    $label .= ' | ' . $row->telefone;
                }
                $results[] = ['id' => $row->idClientes, 'label' => $label, 'value' => $row->nomeCliente];
            }
            echo json_encode($results);
        }
    }

    /**
     * AJAX: Carregar contatos de um cliente
     * Retorna JSON com lista de contatos ou mensagem de erro
     */
    public function getContatos()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
            return;
        }

        $cliente_id = $this->input->post('cliente_id');

        if (!$cliente_id || !is_numeric($cliente_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Cliente inválido']);
            return;
        }

        // Verificar se cliente existe
        $cliente = $this->clientes_model->getById($cliente_id);
        if (!$cliente) {
            echo json_encode(['status' => 'error', 'message' => 'Cliente não encontrado']);
            return;
        }

        $contatos = $this->contatos_model->getByCliente($cliente_id);

        if ($contatos) {
            echo json_encode(['status' => 'success', 'data' => $contatos]);
        } else {
            echo json_encode(['status' => 'empty', 'data' => []]);
        }
    }

    /**
     * AJAX: Obter dados de um contato específico
     * Retorna JSON com dados do contato ou erro
     */
    public function getContatoById()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
            return;
        }

        $idContatos = $this->input->post('idContatos');

        if (!$idContatos || !is_numeric($idContatos)) {
            echo json_encode(['status' => 'error', 'message' => 'Contato inválido']);
            return;
        }

        $contato = $this->contatos_model->getById($idContatos);

        if ($contato) {
            echo json_encode(['status' => 'success', 'data' => $contato]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
        }
    }

    /**
     * AJAX: Adicionar novo contato (para editarCliente)
     * Retorna JSON com status e id do novo contato ou erro
     */
    public function adicionarContato()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
            return;
        }

        $cliente_id = $this->input->post('cliente_id');
        $nome = trim($this->input->post('nome') ?? '');
        
        $emailPost = $this->input->post('email');
        $email = is_array($emailPost) ? json_encode(array_values(array_filter(array_map('trim', $emailPost)))) : trim($emailPost ?? '');
        
        $telefonePost = $this->input->post('telefone');
        $telefone = is_array($telefonePost) ? json_encode(array_values(array_filter(array_map('trim', $telefonePost)))) : trim($telefonePost ?? '');
        
        $celularPost = $this->input->post('celular');
        $celular = is_array($celularPost) ? json_encode(array_values(array_filter(array_map('trim', $celularPost)))) : trim($celularPost ?? '');
        
        $cargo = trim($this->input->post('cargo') ?? '');
        $observacoes = trim($this->input->post('observacoes') ?? '');

        $this->load->library('form_validation');

        // Aplica as regras do grupo 'contatos' (configuradas em form_validation.php)
        if ($this->form_validation->run('contatos') == false) {
            echo json_encode([
                'status' => 'validation_error',
                'message' => 'Verifique os campos obrigatórios',
                'errors' => $this->form_validation->error_array()
            ]);
            return;
        }

        if (!$cliente_id || !is_numeric($cliente_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Cliente inválido']);
            return;
        }

        // Verificar se cliente existe
        $cliente = $this->clientes_model->getById($cliente_id);
        if (!$cliente) {
            echo json_encode(['status' => 'error', 'message' => 'Cliente não encontrado']);
            return;
        }

        // Adicionar contato
        $data = [
            'cliente_id' => $cliente_id,
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'celular' => $celular,
            'cargo' => $cargo,
            'observacoes' => $observacoes,
            'dataCadastro' => date('Y-m-d H:i:s')
        ];

        $result = $this->contatos_model->add($data);

        if ($result) {
            log_info('Adicionou contato para cliente ID: ' . $cliente_id);
            echo json_encode(['status' => 'success', 'data' => ['idContatos' => $result, 'message' => 'Contato adicionado com sucesso']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar contato']);
        }
    }

    /**
     * AJAX: Editar contato existente
     * Retorna JSON com status ou erro
     */
    public function editarContato()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
            return;
        }

        $idContatos = $this->input->post('idContatos');
        $cliente_id = $this->input->post('cliente_id');
        $nome = trim($this->input->post('nome') ?? '');
        
        $emailPost = $this->input->post('email');
        $email = is_array($emailPost) ? json_encode(array_values(array_filter(array_map('trim', $emailPost)))) : trim($emailPost ?? '');
        
        $telefonePost = $this->input->post('telefone');
        $telefone = is_array($telefonePost) ? json_encode(array_values(array_filter(array_map('trim', $telefonePost)))) : trim($telefonePost ?? '');
        
        $celularPost = $this->input->post('celular');
        $celular = is_array($celularPost) ? json_encode(array_values(array_filter(array_map('trim', $celularPost)))) : trim($celularPost ?? '');
        
        $cargo = trim($this->input->post('cargo') ?? '');
        $observacoes = trim($this->input->post('observacoes') ?? '');

        $this->load->library('form_validation');

        // Aplica as regras do grupo 'contatos' (configuradas em form_validation.php)
        if ($this->form_validation->run('contatos') == false) {
            echo json_encode([
                'status' => 'validation_error',
                'message' => 'Verifique os campos obrigatórios',
                'errors' => $this->form_validation->error_array()
            ]);
            return;
        }

        if (!$idContatos || !is_numeric($idContatos)) {
            echo json_encode(['status' => 'error', 'message' => 'Contato inválido']);
            return;
        }

        // Verificar se contato existe e pertence ao cliente
        $contato = $this->contatos_model->getById($idContatos);
        if (!$contato || $contato->cliente_id != $cliente_id) {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
            return;
        }

        // Editar contato
        $data = [
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'celular' => $celular,
            'cargo' => $cargo,
            'observacoes' => $observacoes
        ];

        $result = $this->contatos_model->edit($idContatos, $data);

        if ($result !== false) {
            log_info('Editou contato ID: ' . $idContatos);
            echo json_encode(['status' => 'success', 'message' => 'Contato atualizado com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar contato']);
        }
    }

    /**
     * AJAX: Deletar contato
     * Retorna JSON com status ou erro
     */
    public function deletarContato()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        if (! $this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
            return;
        }

        $idContatos = $this->input->post('idContatos');

        if (!$idContatos || !is_numeric($idContatos)) {
            echo json_encode(['status' => 'error', 'message' => 'Contato inválido']);
            return;
        }

        // Verificar se contato existe
        $contato = $this->contatos_model->getById($idContatos);
        if (!$contato) {
            echo json_encode(['status' => 'error', 'message' => 'Contato não encontrado']);
            return;
        }

        // Deletar contato
        $result = $this->contatos_model->delete($idContatos);

        if ($result) {
            log_info('Delegou contato ID: ' . $idContatos);
            echo json_encode(['status' => 'success', 'message' => 'Contato deletado com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar contato']);
        }
    }

    /**
     * Callback de validação para múltiplos e-mails (JSON ou Array)
     */
    public function validar_multiplos_emails($emails = null)
    {
        if (empty($emails)) {
            return true; // O e-mail não é obrigatório nativamente (required)
        }

        $cliente_id = $this->input->post('cliente_id');
        $idContatos = $this->input->post('idContatos'); // Null se for ação de adicionar

        // Interpretar string JSON ou processar Arrays nativos de $_POST
        if (is_string($emails)) {
            $decodificado = json_decode($emails, true);
            $lista = is_array($decodificado) ? $decodificado : [$emails];
        } elseif (is_array($emails)) {
            $lista = $emails;
        } else {
            $lista = [];
        }

        foreach ($lista as $em) {
            $em = trim((string)$em);
            if (!empty($em)) {
                if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                    $this->form_validation->set_message('validar_multiplos_emails', 'O e-mail informado (' . htmlspecialchars($em) . ') é inválido.');
                    return false;
                }
                
                if ($cliente_id && $this->contatos_model->emailExists($em, $cliente_id, $idContatos ?: null)) {
                    $this->form_validation->set_message('validar_multiplos_emails', 'O e-mail (' . htmlspecialchars($em) . ') já está sendo utilizado por outro contato deste cliente.');
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Callback de validação para múltiplos telefones/celulares (JSON ou Array)
     */
    public function validar_multiplos_telefones($telefones = null)
    {
        // Telefones e celulares são opcionais
        if (empty($telefones) || $telefones === '[]' || $telefones === 'null') {
            return true; 
        }

        if (is_string($telefones)) {
            $decodificado = json_decode($telefones, true);
            $lista = is_array($decodificado) ? $decodificado : [$telefones];
        } elseif (is_array($telefones)) {
            $lista = $telefones;
        } else {
            $lista = [];
        }

        foreach ($lista as $tel) {
            $tel = trim((string)$tel);
            if (!empty($tel) && strlen($tel) > 25) {
                $this->form_validation->set_message('validar_multiplos_telefones', 'O número informado (' . htmlspecialchars($tel) . ') excede o limite de 25 caracteres.');
                return false;
            }
        }

        return true;
    }
}
