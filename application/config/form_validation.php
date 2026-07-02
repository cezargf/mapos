<?php

defined('BASEPATH') or exit('No direct script access allowed');

$config = [
    'clientes' => [
        [
            'field' => 'nomeCliente',
            'label' => 'Nome',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'documento',
            'label' => 'CPF/CNPJ',
            'rules' => 'trim|max_length[20]|verific_cpf_cnpj|unique[clientes.documento.' . get_instance()->uri->segment(3) . '.idClientes]',
            'errors' => [
                'verific_cpf_cnpj' => 'O campo %s não é um CPF ou CNPJ válido.',
            ],
        ],
        [
            'field' => 'ie',
            'label' => 'Inscrição Estadual',
            'rules' => 'trim|max_length[20]|valid_ie',
            'errors' => [
                'valid_ie' => 'O campo Inscrição Estadual está inválido.',
            ],
        ],
        [
            'field' => 'im',
            'label' => 'Inscrição Municipal',
            'rules' => 'trim|min_length[5]|max_length[20]|valid_im',
            'errors' => [
                'valid_im' => 'O campo Inscrição Municipal está inválido.',
            ],
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'trim|max_length[25]',
        ],
        [
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'trim|max_length[25]',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|valid_email|max_length[255]',
        ],
        [
            'field' => 'rua',
            'label' => 'Rua',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'complemento',
            'label' => 'Complemento',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'estado',
            'label' => 'Estado',
            'rules' => 'trim|max_length[20]',
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'codigo_ibge',
            'label' => 'Código IBGE',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'contato',
            'label' => 'Pessoa de Contato',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'sexo',
            'label' => 'Sexo',
            'rules' => 'trim|max_length[50]',
        ],
        [
            'field' => 'nascimento',
            'label' => 'Data de Nascimento',
            'rules' => 'trim|max_length[10]',
        ],
        [
            'field' => 'tratamento',
            'label' => 'Forma de Tratamento',
            'rules' => 'trim|max_length[50]',
        ],
    ],
    'contatos' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'callback_validar_multiplos_telefones',
        ],
        [
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'callback_validar_multiplos_telefones',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'callback_validar_multiplos_emails',
        ],
        [
            'field' => 'cargo',
            'label' => 'Cargo',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'observacoes',
            'label' => 'Observações',
            'rules' => 'trim|max_length[500]',
        ],
    ],
    'servicos' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'descricao',
            'label' => '',
            'rules' => 'trim',
        ],
        [
            'field' => 'preco',
            'label' => '',
            'rules' => 'required|trim',
        ],
    ],
    'produtos' => [
        [
            'field' => 'codDeFabrica',
            'label' => 'Código de Fabrica',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'modelo',
            'label' => 'Modelo',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'fabricante',
            'label' => 'Fabricante',
            'rules' => 'trim|max_length[100]',
        ],
        [
            'field' => 'unidade',
            'label' => 'Unidade',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'precoCompra',
            'label' => 'Preço de Compra',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'precoVenda',
            'label' => 'Preço de Venda',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estoque',
            'label' => 'Estoque',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estoqueMinimo',
            'label' => 'Estoque Minimo',
            'rules' => 'trim',
        ],
        [
            'field' => 'url_pagina',
            'label' => 'Página do Produto (URL)',
            'rules' => 'trim|valid_url',
        ],
        [
            'field' => 'url_especificacoes',
            'label' => 'Especificações (URL)',
            'rules' => 'trim|valid_url',
        ],
        [
            'field' => 'url_manual',
            'label' => 'Manual (URL)',
            'rules' => 'trim|valid_url',
        ],
        [
            'field' => 'ncm',
            'label' => 'NCM',
            'rules' => 'trim|max_length[8]',
        ],
        [
            'field' => 'cest',
            'label' => 'CEST',
            'rules' => 'trim',
        ],
        [
            'field' => 'origem',
            'label' => 'Origem',
            'rules' => 'trim',
        ],
        [
            'field' => 'cst_csosn',
            'label' => 'CST/CSOSN',
            'rules' => 'required|trim|max_length[3]',
        ],
        [
            'field' => 'ibs_cbs',
            'label' => 'IBS/CBS',
            'rules' => 'trim',
        ],
    ],
    'adicionar_produtos_imagens' => [
        [
            'field' => 'url',
            'label' => 'URL',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'thumb',
            'label' => 'Thumb',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'path',
            'label' => 'Path',
            'rules' => 'required|trim|max_length[255]',
        ],
    ],
    'usuarios' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'rg',
            'label' => 'RG',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'required|trim|verific_cpf_cnpj|is_unique[usuarios.cpf]',
            'errors' => [
                'verific_cpf_cnpj' => 'O campo %s não é um CPF válido.',
            ],
        ],
        [
            'field' => 'rua',
            'label' => 'Rua',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'numero',
            'label' => 'Numero',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'estado',
            'label' => 'Estado',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|is_unique[usuarios.email]',
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'situacao',
            'label' => 'Situacao',
            'rules' => 'required|trim',
        ],
    ],
    'os' => [
        [
            'field' => 'dataInicial',
            'label' => 'DataInicial',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'dataFinal',
            'label' => 'DataFinal',
            'rules' => 'trim',
        ],
        [
            'field' => 'garantia',
            'label' => 'Garantia',
            'rules' => 'trim|numeric',
            'errors' => [
                'numeric' => 'Por favor digite apenas número.',
            ],
        ],
        [
            'field' => 'termoGarantia',
            'label' => 'Termo Garantia',
            'rules' => 'trim',
        ],
        [
            'field' => 'descricaoProduto',
            'label' => 'DescricaoProduto',
            'rules' => 'trim',
        ],
        [
            'field' => 'defeito',
            'label' => 'Defeito',
            'rules' => 'trim',
        ],
        [
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'observacoes',
            'label' => 'Observacoes',
            'rules' => 'trim',
        ],
        [
            'field' => 'clientes_id',
            'label' => 'clientes',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'usuarios_id',
            'label' => 'usuarios_id',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'laudoTecnico',
            'label' => 'Laudo Tecnico',
            'rules' => 'trim',
        ],
    ],
    'tiposUsuario' => [
        [
            'field' => 'nomeTipo',
            'label' => 'NomeTipo',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'situacao',
            'label' => 'Situacao',
            'rules' => 'required|trim',
        ],
    ],
    'receita' => [
        [
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'valor',
            'label' => 'Valor',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'vencimento',
            'label' => 'Data Vencimento',
            'rules' => 'required|trim',
        ],

        [
            'field' => 'cliente',
            'label' => 'Cliente',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'tipo',
            'label' => 'Tipo',
            'rules' => 'required|trim',
        ],
    ],
    'despesa' => [
        [
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'valor',
            'label' => 'Valor',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'vencimento',
            'label' => 'Data Vencimento',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'fornecedor',
            'label' => 'Fornecedor',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'tipo',
            'label' => 'Tipo',
            'rules' => 'required|trim',
        ],
    ],
    'garantias' => [
        [
            'field' => 'dataGarantia',
            'label' => 'dataGarantia',
            'rules' => 'trim',
        ],
        [
            'field' => 'usuarios_id',
            'label' => 'usuarios_id',
            'rules' => 'trim',
        ],
        [
            'field' => 'refGarantia',
            'label' => 'refGarantia',
            'rules' => 'trim',
        ],
        [
            'field' => 'textoGarantia',
            'label' => 'textoGarantia',
            'rules' => 'required|trim',
        ],
    ],
    'pagamentos' => [
        [
            'field' => 'Nome',
            'label' => 'nomePag',
            'rules' => 'trim',
        ],
        [
            'field' => 'clientId',
            'label' => 'clientId',
            'rules' => 'trim',
        ],
        [
            'field' => 'clientSecret',
            'label' => 'clientSecret',
            'rules' => 'trim',
        ],
        [
            'field' => 'publicKey',
            'label' => 'publicKey',
            'rules' => 'trim',
        ],
        [
            'field' => 'accessToken',
            'label' => 'accessToken',
            'rules' => 'trim',
        ],
    ],
    'vendas' => [
        [
            'field' => 'dataVenda',
            'label' => 'Data da Venda',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'observacoes',
            'label' => 'Observacoes',
            'rules' => 'trim',
        ],
        [
            'field' => 'clientes_id',
            'label' => 'clientes',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'usuarios_id',
            'label' => 'usuarios_id',
            'rules' => 'trim|required',
        ],
    ],
    'anotacoes_os' => [
        [
            'field' => 'anotacao',
            'label' => 'Anotação',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'os_id',
            'label' => 'ID Os',
            'rules' => 'trim|required|integer',
        ],
    ],
    'adicionar_produto_os' => [
        [
            'field' => 'idProduto',
            'label' => 'idProduto',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'quantidade',
            'label' => 'quantidade',
            'rules' => 'trim|required|numeric|greater_than[0]',
        ],
        [
            'field' => 'preco',
            'label' => 'preco',
            'rules' => 'trim|required|numeric|greater_than[-1]',
        ],
        [
            'field' => 'idOsProduto',
            'label' => 'idOsProduto',
            'rules' => 'trim|required|numeric',
        ],
    ],
    'adicionar_servico_os' => [
        [
            'field' => 'idServico',
            'label' => 'idServico',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'quantidade',
            'label' => 'quantidade',
            'rules' => 'trim|required|numeric|greater_than[0]',
        ],
        [
            'field' => 'preco',
            'label' => 'preco',
            'rules' => 'trim|required|numeric|greater_than[-1]',
        ],
        [
            'field' => 'idOsServico',
            'label' => 'idOsServico',
            'rules' => 'trim|required|numeric',
        ],
    ],
    'cobrancas' => [
        [
            'field' => 'id',
            'label' => 'id',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'tipo',
            'label' => 'tipo',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'forma_pagamento',
            'label' => 'forma_pagamento',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'gateway_de_pagamento',
            'label' => 'gateway_de_pagamento',
            'rules' => 'required|trim',
        ],
    ],
    'emitente' => [
        [
            'field' => 'nome',
            'label' => 'Razão Social',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'cnpj',
            'label' => 'CNPJ',
            'rules' => 'required|trim|max_length[18]|verific_cpf_cnpj',
            'errors' => [
                'verific_cpf_cnpj' => 'O campo %s deve conter um CNPJ válido.',
            ],
        ],
        [
            'field' => 'ie',
            'label' => 'Inscrição Estadual',
            'rules' => 'trim|max_length[20]|valid_ie',
            'errors' => [
                'valid_ie' => 'O campo %s deve conter uma Inscrição Estadual válida.',
            ],
        ],
        [
            'field' => 'im',
            'label' => 'Inscrição Municipal',
            'rules' => 'trim|min_length[5]|max_length[20]|valid_im',
            'errors' => [
                'valid_im' => 'O campo %s deve conter uma Inscrição Municipal válida.',
            ],
        ],
        [
            'field' => 'logradouro',
            'label' => 'Logradouro',
            'rules' => 'required|trim|max_length[255]',
        ],
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'required|trim|max_length[10]',
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'required|trim|max_length[100]',
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|trim|max_length[100]',
        ],
        [
            'field' => 'uf',
            'label' => 'UF',
            'rules' => 'required|trim|max_length[2]',
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|trim|max_length[10]',
        ],
        [
            'field' => 'telefone',
            'label' => 'Telefone',
            'rules' => 'required|trim|max_length[25]',
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|max_length[255]',
        ],
    ],
];
