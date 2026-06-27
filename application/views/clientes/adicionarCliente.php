<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* Evita que a barra de rolagem apareça horizontalmente */
        overflow-x: hidden;
        z-index: 1051 !important; /* Garante que o autocomplete fique acima de outros elementos */
    }
    #imgSenha {
        position: absolute;
        right: -5px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        cursor: pointer;
    }

    .password-wrapper {
        position: relative;
        width: calc(100% - 14px);
    }

    .badgebox {
        opacity: 0;
    }

    #accordion-cliente {
        border: none !important;
    }

    .badgebox+.badge {
        text-indent: -999999px;
        width: 27px;
        margin-top: 2px;
    }

    .badgebox:focus+.badge {
        box-shadow: inset 0px 0px 5px;
    }

    .badgebox:checked+.badge {
        text-indent: 0;
    }

    .control-group.error .help-inline {
        display: flex;
    }

    .form-horizontal .controls {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        margin: 0 60px 0 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        /* margin-right: 20px; */
    }

    .widget-title h5 {
        line-height: 1.25;
        padding: 30px 20px 20px 20px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    .accordion-group {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #accordion-cliente {
        border: none !important;
    }

    .accordion-heading a {
        padding: 12px 15px;
        display: block;
        background-color: #f5f5f5;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        color: #333;
        text-decoration: none;
    }

    .accordion-heading a:hover {
        background-color: #e8e8e8;
    }

    .accordion-body {
        display: none;
        padding: 10px;
    }

    .accordion-body.in {
        display: block;
    }

    #msg-sem-contatos {
        margin-top: 15px;
    }

    #table-contatos {
        margin-top: 15px;
    }

    .campos-pessoa-fisica {
        display: none;
    }

    .campos-pessoa-fisica.visible {
        display: block;
    }

    .campos-pessoa-juridica {
        display: block;
    }

    .campos-pessoa-juridica.hidden {
        display: none;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        margin-bottom: 15px;
    }

    /* Correção para modal sobreposto e centralização no BS2 */
    #modal-mapa {
        width: 90%; /* Aumenta a largura em telas menores */
        max-width: 800px; /* Mantém um máximo */
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) !important; /* Centraliza vertical e horizontalmente */
        margin: 0; /* Reseta margens */
        z-index: 1050 !important;
        max-height: 90vh; /* Evita que o modal seja maior que a tela */
    }

    #modal-mapa .modal-body {
        max-height: calc(90vh - 120px); /* Ajusta a altura do corpo do modal */
        overflow-y: auto;
    }

    #map-selector {
        height: 400px;
        width: 100%;
        background-color: #eee; /* Fundo para indicar onde o mapa deveria estar */
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    /* --- Form Fields Style --- */
    .form-horizontal .controls input,
    .form-horizontal .controls input[type="text"],
    .form-horizontal .controls input[type="email"],
    .form-horizontal .controls input[type="date"],
    .form-horizontal .controls select,
    .form-horizontal .controls textarea {
        width: 100%;
    }

    /* --- Font-Size Standardization --- */
    .form-horizontal .controls select,
    .select2-results__option,
    .select2-selection__rendered {
        font-size: 14px !important;
    }

    .select2 {
        border: 1px solid #b1b9be;
        border-radius: 4px;
        height: 30px;
    }

    .select2-selection,
    .select2-selection__rendered {
        background-color: inherit;
        border: none !important;
    }

    .select2-selection__rendered {
        border-radius: 4px !important;
    }

    .select2-search__field {
        height: 28px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 2px !important;
    }

    .btn-consultar-cnpj {
        margin: 0 0 0 10px !important;
    }

    /* --- CNPJ/Document Field --- */
    .control-group.documento-group .controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .control-group.documento-group .controls .cpfcnpj {
        flex: 1;
    }

    .tipo-cliente {
        display: inline-flex !important;
    }

    .geo-buttons {
        display: grid;
        grid-template-columns: minmax(120px, max-content) minmax(120px, max-content);
        margin-top: 10px;
        width: auto;
    }

    @media (max-width: 1440px) {
        /* CNPJ Button */
        .btn-consultar-cnpj {
            position: static;
            margin-left: 8px;
            padding: 0 !important;
        }
        .btn-consultar-cnpj .button__text2 {
            display: none !important;
        }
        .btn-consultar-cnpj .button__icon {
            padding: 0 10px !important;
        }
    }

    @media (max-width: 1200px) {
        .geo-buttons {
            grid-template-columns: 1fr;
            margin: 10px 0 10px 0;
        }

        .geo-buttons .btn-selecionar-mapa,
        .geo-buttons .btn-geocodificar {
            margin: 10px 0 10px 0;
        }
    }

    @media (max-width: 768px) {
        .form-horizontal .control-label,
        .row-fluid > .span6,
        .form-actions .span6 {
            float: none !important;
            margin-left: 0 !important;
        }

        .form-horizontal .control-label {
            width: auto !important;
            padding-top: 10px;
        }

        .form-horizontal .controls {
            margin: 0 !important;
        }

        .row-fluid > .span6 {
            display: block !important;
            width: 100% !important;
        }

        .form-actions .span6 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100% !important;
            margin-left: 0 !important;
        }

        .form-actions .btn {
            margin: 5px 5px 0;
        }

        /* Geo Fields */
        .geo-buttons .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        form {
            display: contents !important;
        }

        .form-horizontal .control-label {
            margin-bottom: 5px;
            font-weight: bold;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .btn-xs {
            position: initial !important;
        }

        .accordion-footer {
            justify-content: center !important;
        }
    }

</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <h5>Cadastro de Cliente</h5>
            </div>

            <form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal">
                <div class="widget-content nopadding">
                    <?php if ($custom_error != '') { echo '<div class="alert alert-danger">' . $custom_error . '</div>'; } ?>

                    <!-- ============= ACCORDION: DADOS DO CLIENTE ============= -->
                    <div class="accordion-group" id="accordion-cliente">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-cliente', this)">
                                <i class="fas fa-chevron-down"></i> <strong>DADOS DO CLIENTE</strong>
                            </a>
                        </div>
                        <div id="collapse-cliente" class="accordion-body in">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group documento-group">
                                        <label for="documento" class="control-label">CPF/CNPJ</label>
                                        <div class="controls">
                                            <input id="documento" class="cpfcnpj" type="text" name="documento" value="<?php echo set_value('documento'); ?>" placeholder="Digite o CPF ou CNPJ" aria-label="Campo para CPF ou CNPJ" title="CPF/CNPJ: Opcional, mas se preenchido deve ser válido." />
                                            <button id="buscar_info_cnpj" class="button btn btn-mini btn-inverse btn-consultar-cnpj" type="button" aria-label="Botão para buscar informações do CNPJ">
                                                <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                                                <span class="button__text2">Buscar(CNPJ)</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="nomeCliente" class="control-label">Nome/Razão Social<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="nomeCliente" type="text" name="nomeCliente" value="<?php echo set_value('nomeCliente'); ?>" placeholder="Digite o nome completo ou razão social" aria-label="Campo obrigatório para nome ou razão social" aria-required="true" title="Campo obrigatório." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="ie" class="control-label">Inscrição Estadual (IE)</label>
                                        <div class="controls">
                                            <input id="ie" type="text" name="ie" value="<?php echo set_value('ie'); ?>" placeholder="Digite a Inscrição Estadual" aria-label="Campo para Inscrição Estadual" title="IE: Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="im" class="control-label">Inscrição Municipal (IM)</label>
                                        <div class="controls">
                                            <input id="im" type="text" name="im" value="<?php echo set_value('im'); ?>" placeholder="Digite a Inscrição Municipal" aria-label="Campo para Inscrição Municipal" title="IM: Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="fantasia" class="control-label">Nome Fantasia</label>
                                        <div class="controls">
                                            <input id="fantasia" type="text" name="fantasia" value="<?php echo set_value('fantasia'); ?>" placeholder="Digite o nome fantasia da empresa" aria-label="Campo para nome fantasia da empresa" title="Nome fantasia. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="tipo" class="control-label">Tipo</label>
                                        <div class="controls">
                                            <input id="tipo" type="text" name="tipo" value="<?php echo set_value('tipo'); ?>" placeholder="Ex: MATRIZ ou FILIAL" aria-label="Campo para tipo da empresa" title="Tipo (MATRIZ/FILIAL). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="porte" class="control-label">Porte</label>
                                        <div class="controls">
                                            <input id="porte" type="text" name="porte" value="<?php echo set_value('porte'); ?>" placeholder="Ex: micro, pequena, média" aria-label="Campo para porte da empresa" title="Porte da empresa (micro, pequena, média). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="natureza_juridica" class="control-label">Natureza Jurídica</label>
                                        <div class="controls">
                                            <input id="natureza_juridica" type="text" name="natureza_juridica" value="<?php echo set_value('natureza_juridica'); ?>" placeholder="Digite a natureza jurídica" aria-label="Campo para natureza jurídica da empresa" title="Natureza jurídica. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="sexo" class="control-label">Sexo</label>
                                        <div class="controls">
                                            <select id="sexo" name="sexo" aria-label="Seleção de sexo" title="Sexo. Opcional.">
                                                <option value="">Selecione...</option>
                                                <option value="Masculino" <?php echo set_select('sexo', 'Masculino'); ?>>Masculino</option>
                                                <option value="Feminino" <?php echo set_select('sexo', 'Feminino'); ?>>Feminino</option>
                                                <option value="Outro" <?php echo set_select('sexo', 'Outro'); ?>>Outro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="nascimento" class="control-label">Data de Nascimento</label>
                                        <div class="controls">
                                            <input id="nascimento" type="date" name="nascimento" value="<?php echo set_value('nascimento'); ?>" placeholder="Selecione a data de nascimento" aria-label="Campo para data de nascimento" title="Data de nascimento (DD/MM/AAAA). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="tratamento" class="control-label">Tratamento</label>
                                        <div class="controls">
                                            <select id="tratamento" name="tratamento" aria-label="Seleção de forma de tratamento" title="Forma de tratamento. Opcional.">
                                                <option value="">Selecione...</option>
                                                <option value="Sr." <?php echo set_select('tratamento', 'Sr.'); ?>>Sr.</option>
                                                <option value="Sra." <?php echo set_select('tratamento', 'Sra.'); ?>>Sra.</option>
                                                <option value="Sr.(a)" <?php echo set_select('tratamento', 'Sr.(a)'); ?>>Sr.(a)</option>
                                                <option value="Doutor" <?php echo set_select('tratamento', 'Doutor'); ?>>Doutor</option>
                                                <option value="Doutora" <?php echo set_select('tratamento', 'Doutora'); ?>>Doutora</option>
                                                <option value="Professor" <?php echo set_select('tratamento', 'Professor'); ?>>Professor</option>
                                                <option value="Professora" <?php echo set_select('tratamento', 'Professora'); ?>>Professora</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="contato" class="control-label">Contato</label>
                                        <div class="controls">
                                            <input class="contato" type="text" name="contato" value="<?php echo set_value('contato'); ?>" placeholder="Nome da pessoa de contato" aria-label="Campo para nome da pessoa de contato" title="Nome da pessoa de contato. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="telefone" class="control-label">Telefone</label>
                                        <div class="controls">
                                            <input id="telefone" type="text" name="telefone" value="<?php echo set_value('telefone'); ?>" placeholder="(11) 99999-9999" aria-label="Campo para telefone fixo" title="Telefone (fixo ou celular). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="celular" class="control-label">Celular</label>
                                        <div class="controls">
                                            <input id="celular" type="text" name="celular" value="<?php echo set_value('celular'); ?>" placeholder="(11) 99999-9999" aria-label="Campo para celular" title="Celular. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="buscar_usuario" class="control-label">Acesso do Cliente (Usuário)</label>
                                        <div class="controls">
                                            <input id="buscar_usuario" type="text" name="buscar_usuario" placeholder="Pesquise por nome ou e-mail de um usuário já cadastrado" title="Selecione um usuário existente ou deixe em branco para criar um novo acesso com o e-mail abaixo." />
                                            <input id="usuarios_clientes_id" type="hidden" name="usuarios_clientes_id" value="" />
                                            <span class="help-inline" id="info-usuario-existente" style="display:none; color: #28a745;"><i class="fas fa-check-circle"></i> Vinculando a usuário existente.</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="email" class="control-label">Email<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="email" type="email" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>" placeholder="exemplo@email.com" aria-label="Campo para endereço de email" autocomplete="off" title="Email obrigatório para o acesso do cliente." required />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="senha" class="control-label">Senha</label>
                                        <div class="controls">
                                            <div class="password-wrapper">
                                                <input class="form-control" id="senha" type="password" name="senha" autocomplete="new-password" value="<?php echo set_value('senha'); ?>" placeholder="Digite uma senha segura" aria-label="Campo para senha de acesso" title="Senha. Opcional para clientes." />
                                                <img id="imgSenha" src="<?php echo base_url() ?>assets/img/eye.svg" alt="" aria-label="Botão para mostrar/ocultar senha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tipo de Cliente</label>
                                        <div class="controls">
                                            <label for="fornecedor" class="btn btn-default tipo-cliente" aria-label="Checkbox para marcar se também é fornecedor">
                                                Fornecedor
                                                <input type="checkbox" id="fornecedor" name="fornecedor" class="badgebox" value="1" title="Também é fornecedor?">
                                                <span class="badge">&check;</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="span6">
                                    <div class="control-group">
                                        <label for="cep" class="control-label">CEP</label>
                                        <div class="controls">
                                            <input id="cep" type="text" name="cep" value="<?php echo set_value('cep'); ?>" placeholder="00000-000" aria-label="Campo para CEP" title="CEP. Opcional." />
                                        </div>
                                    </div>
                                    <input type="hidden" name="codigo_ibge" id="codigo_ibge" value="<?php echo set_value('codigo_ibge'); ?>">
                                    <div class="control-group">
                                        <label for="rua" class="control-label">Rua</label>
                                        <div class="controls">
                                            <input id="rua" type="text" name="rua" value="<?php echo set_value('rua'); ?>" placeholder="Nome da rua ou logradouro" aria-label="Campo para nome da rua" title="Rua. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="numero" class="control-label">Número</label>
                                        <div class="controls">
                                            <input id="numero" type="text" name="numero" value="<?php echo set_value('numero'); ?>" placeholder="Número do endereço" aria-label="Campo para número do endereço" title="Número. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="complemento" class="control-label">Complemento</label>
                                        <div class="controls">
                                            <input id="complemento" type="text" name="complemento" value="<?php echo set_value('complemento'); ?>" placeholder="Apartamento, bloco, etc." aria-label="Campo para complemento do endereço" title="Complemento. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="bairro" class="control-label">Bairro</label>
                                        <div class="controls">
                                            <input id="bairro" type="text" name="bairro" value="<?php echo set_value('bairro'); ?>" placeholder="Nome do bairro" aria-label="Campo para nome do bairro" title="Bairro. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="cidade" class="control-label">Cidade</label>
                                        <div class="controls">
                                            <select id="cidade" name="cidade_select" disabled>
                                                <option value="">Selecione um estado primeiro...</option>
                                            </select>
                                            <input type="hidden" name="cidade" id="cidade_nome" value="<?php echo set_value('cidade'); ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="estado" class="control-label">Estado</label>
                                        <div class="controls">
                                            <select id="estado" name="estado" aria-label="Seleção de estado" title="Estado. Opcional.">
                                                <option value="">Selecione...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="latitude" class="control-label">Latitude</label>
                                        <div class="controls">
                                            <input id="latitude" type="text" name="latitude" value="<?php echo set_value('latitude'); ?>" readonly placeholder="Preenchido automaticamente" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="longitude" class="control-label">Longitude</label>
                                        <div class="controls">
                                            <input id="longitude" type="text" name="longitude" value="<?php echo set_value('longitude'); ?>" readonly placeholder="Preenchido automaticamente" />
                                            <div class="geo-buttons">
                                                <button type="button" id="btn-geocodificar" class="button btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço">
                                                    <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                                                    <span class="button__text2"> Buscar</span>
                                                </button>
                                                <button type="button" id="btn-selecionar-mapa" class="button btn btn-mini btn-inverse" title="Selecionar local manualmente no mapa">
                                                    <span class="button__icon"><i class='bx bx-map-alt'></i></span>
                                                    <span class="button__text2"> Selecionar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="atividade_principal" class="control-label">Atividade Principal</label>
                                        <div class="controls">
                                            <textarea id="atividade_principal" name="atividade_principal" rows="2" placeholder="Descrição da atividade principal" aria-label="Campo para atividade principal da empresa" title="Atividade principal. Opcional."><?php echo set_value('atividade_principal'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="cnae" class="control-label">CNAE</label>
                                        <div class="controls">
                                            <select id="cnae" name="cnae" title="CNAE. Opcional."></select>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="atividades_secundarias" class="control-label">Atividades Secundárias</label>
                                        <div class="controls">
                                            <textarea id="atividades_secundarias" name="atividades_secundarias" rows="2" placeholder="Liste as atividades secundárias" aria-label="Campo para atividades secundárias da empresa" title="Atividades secundárias. Opcional."><?php echo set_value('atividades_secundarias'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="situacao" class="control-label">Situação</label>
                                        <div class="controls">
                                            <input id="situacao" type="text" name="situacao" value="<?php echo set_value('situacao'); ?>" placeholder="Situação atual da empresa" aria-label="Campo para situação da empresa" title="Situação. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="data_situacao" class="control-label">Data Situação</label>
                                        <div class="controls">
                                            <input id="data_situacao" type="text" name="data_situacao" value="<?php echo set_value('data_situacao'); ?>" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação" title="Data da situação (DD/MM/AAAA). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="motivo_situacao" class="control-label">Motivo Situação</label>
                                        <div class="controls">
                                            <input id="motivo_situacao" type="text" name="motivo_situacao" value="<?php echo set_value('motivo_situacao'); ?>" placeholder="Motivo da situação atual" aria-label="Campo para motivo da situação" title="Motivo da situação. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="situacao_especial" class="control-label">Situação Especial</label>
                                        <div class="controls">
                                            <input id="situacao_especial" type="text" name="situacao_especial" value="<?php echo set_value('situacao_especial'); ?>" placeholder="Situação especial, se aplicável" aria-label="Campo para situação especial" title="Situação especial. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="data_situacao_especial" class="control-label">Data Situação Especial</label>
                                        <div class="controls">
                                            <input id="data_situacao_especial" type="text" name="data_situacao_especial" value="<?php echo set_value('data_situacao_especial'); ?>" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação especial" title="Data da situação especial. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="capital_social" class="control-label">Capital Social</label>
                                        <div class="controls">
                                            <input id="capital_social" type="text" name="capital_social" value="<?php echo set_value('capital_social'); ?>" placeholder="Valor do capital social" aria-label="Campo para capital social da empresa" title="Capital social. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="qsa" class="control-label">QSA (Sócios)</label>
                                        <div class="controls">
                                            <textarea id="qsa" name="qsa" rows="2" placeholder="Lista dos sócios da empresa" aria-label="Campo para lista de sócios (QSA)" title="Lista de sócios (QSA). Opcional."><?php echo set_value('qsa'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============= ACCORDION: CONTATOS DO CLIENTE ============= -->
                    <div class="accordion-group" id="accordion-contatos">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-contatos', this)">
                                <i class="fas fa-chevron-right"></i> <strong>CONTATOS DO CLIENTE <span class="badge badge-info" id="badge-contatos">0</span></strong>
                            </a>
                        </div>
                        <div id="collapse-contatos" class="accordion-body">
                            <div id="msg-sem-contatos" class="alert alert-info">
                                <i class="fas fa-info-circle"></i> <strong>Nenhum contato adicionado ainda.</strong> Clique no botão abaixo para adicionar contatos.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-contatos" style="display: none; margin-bottom: 15px;">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Nome</th>
                                            <th style="width: 20%">Email</th>
                                            <th style="width: 15%">Telefone</th>
                                            <th style="width: 15%">Celular</th>
                                            <th style="width: 20%">Cargo</th>
                                            <th style="width: 10%">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contatos-table-body">
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" name="contatos_json" id="contatos-json" value="">

                            <?php $this->load->view('clientes/contatos/formContato', ['use_inline_index' => true]); ?>

                            <div class="accordion-footer" style="display: flex; justify-content: start; border-top: 1px solid #ccc; margin: 0 20px 0 20px;">
                                <button type="button" class="button btn btn-mini btn-primary" id="btn-add-contato" style="margin: 10px 20px;">
                                    <span class="button__icon"><i class="bx bx-plus-circle"></i></span>
                                    <span class="button__text2"> Adicionar Contato</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex; justify-content: center; gap: 10px;">
                            <button type="submit" class="button btn btn-mini btn-success" style="width: 120px;"><span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Salvar</span></button>
                            <a title="Voltar" class="button btn btn-warning" style="width: 120px;" href="<?php echo site_url() ?>/clientes"><span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para Selecionar no Mapa -->
<div id="modal-mapa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Selecionar Localização</h3>
    </div>
    <div class="modal-body">
        <p>Clique no mapa para marcar o local exato ou arraste o marcador.</p>
        <div id="map-selector" style="height: 400px; width: 100%;"></div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Confirmar Localização</button>
    </div>
</div>

<!-- Leaflet Assets -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">

    function toggleAccordion(id, element) {
        let accordion = document.getElementById(id);
        accordion.classList.toggle('in');
        let icon = element.querySelector('i');
        if (accordion.classList.contains('in')) {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-down');
        } else {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-right');
        }
    }

    $(document).ready(function() {

        // Função para detectar CPF/CNPJ e mostrar/ocultar campos de pessoa física
        function verificarCPFeCNPJ() {
            let documento = $('#documento').val().replace(/\D/g, ''); // Remove não-dígitos
            let campos_pessoa_fisica = $('.campos-pessoa-fisica');
            let campos_pessoa_juridica = $('.campos-pessoa-juridica');
            
            if (documento.length === 11) {
                // É CPF - mostrar campos de pessoa física e ocultar de pessoa jurídica
                campos_pessoa_fisica.addClass('visible');
                campos_pessoa_juridica.addClass('hidden');
            } else if (documento.length === 14) {
                // É CNPJ - ocultar campos de pessoa física e mostrar de pessoa jurídica
                campos_pessoa_fisica.removeClass('visible');
                campos_pessoa_juridica.removeClass('hidden');
            } else if (documento.length === 0) {
                // Vazio - ocultar campos de pessoa física, mostrar de pessoa jurídica
                campos_pessoa_fisica.removeClass('visible');
                campos_pessoa_juridica.removeClass('hidden');
            }
        }
        
        // Event listener para detectar mudança no campo documento
        $('#documento').on('input', function() {
            verificarCPFeCNPJ();
        });
        
        // Chamar função ao carregar a página
        verificarCPFeCNPJ();

        // Array para armazenar contatos
        let contatos = [];
        let indexEdicao = null;

        // Senha toggle
        let input = document.querySelector('#senha');
        let icon = document.querySelector('#imgSenha');
        if (icon) {
            icon.addEventListener('click', function() {
                if (input.type === 'password') {
                    icon.src = '<?php echo base_url() ?>assets/img/eye-off.svg';
                    input.type = 'text';
                } else {
                    icon.src = '<?php echo base_url() ?>assets/img/eye.svg';
                    input.type = 'password';
                }
            });
        }

        // Atualizar tabela de contatos
        function atualizarTabelaContatos() {
            FormContatoInline.renderTabelaContatos({
                contatos: contatos,
                escapeHtml: escapeHtml,
                getActionButtons: function (contato, index, helpers) {
                    return helpers.criarBotaoAcao('edit', {
                        'data-index': index
                    }) + helpers.criarBotaoAcao('delete', {
                        'data-index': index
                    });
                }
            });
        }

        // Botão: Adicionar Contato (Inline)
        $('#btn-add-contato').on('click', function() {
            indexEdicao = null;
            FormContatoInline.resetFormulario();
            $('#form-contato-titulo').text('Adicionar Contato');
            $('#form-contato-inline').slideDown(300);
            aplicarMascaras();
            $('#inline-nome').focus();
        });

        FormContatoInline.initListActions({
            aplicarMascaras: aplicarMascaras,
            escapeHtml: escapeHtml,
            onEditar: function ($button, abrirFormulario) {
                indexEdicao = parseInt($button.data('index'), 10);
                abrirFormulario(contatos[indexEdicao]);
            },
            onExcluir: function ($button) {
                let index = parseInt($button.data('index'), 10);

                if (confirm('Tem certeza que deseja remover este contato?')) {
                    contatos.splice(index, 1);
                    atualizarTabelaContatos();
                }
            }
        });

        // Inicializar handlers de save/cancel com modo array
        FormContatoInline.initArrayMode({
            getIndexEdicao: function () {
                return indexEdicao;
            },
            setIndexEdicao: function (value) {
                indexEdicao = value;
            },
            getContatos: function () {
                return contatos;
            },
            addContato: function (contato) {
                contatos.push(contato);
            },
            updateContato: function (index, contato) {
                contatos[index] = contato;
            },
            onContatoSalvo: function (isEditing) {
                atualizarTabelaContatos();
            },
            onErro: function (msg) {
                // Erros já são exibidos pela função initArrayMode
            },
            aplicarMascaras: aplicarMascaras
        });

        FormContatoInline.bindEventos(aplicarMascaras);


        // Máscaras de Entrada
        function aplicarMascaras() {
            $('#data_situacao').mask("00/00/0000");
            $('#data_situacao_especial').mask("00/00/0000");
            $('#inline-telefone, .mascara-telefone').mask("(00) 0000-0000");
            $('#inline-celular, .mascara-celular').mask("(00) 00000-0000");
        }

        // Variáveis para persistência em caso de erro de validação
        let curState = '<?php echo addslashes(set_value('estado')); ?>';
        let curCity = '<?php echo addslashes(set_value('cidade')); ?>';

        // Função para popular estados
        function popularEstados(data) {
            data.sort((a, b) => a.nome.localeCompare(b.nome));
            $('#estado').empty().append('<option value="">Selecione...</option>');
            for (let i in data) {
                $('#estado').append(new Option(data[i].nome, data[i].sigla));
            }
            if (curState) {
                $("#estado option[value=" + curState + "]").prop("selected", true);
                $("#estado").trigger("change");
            }
        }

        // Configuração do Select2 CNAE
        const cnaeSelect = $('#cnae');
        const initialCnaeValue = cnaeSelect.val();
        if (initialCnaeValue) {
            const formattedText = formatCnae(initialCnaeValue);
            const selectedOption = cnaeSelect.find('option[value="' + initialCnaeValue + '"]');
            if (selectedOption.length) {
                selectedOption.text(formattedText);
            }
        }

        cnaeSelect.select2({
            placeholder: 'Código ou descrição do CNAE',
            minimumInputLength: 1,
            ajax: {
                url: '<?php echo base_url('index.php/ibge/consultarCnae'); ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { term: params.term };
                },
                processResults: function (data) {
                    return { results: data.results };
                },
                cache: true
            },
            templateSelection: function(data) {
                if (!data.id) return data.text;
                // Se for um item já formatado (ex: carregamento inicial), retorna como está
                if (data.text.indexOf(' - ') === -1 && data.text.indexOf('-') > -1) return data.text;
                
                // Extrai apenas o código, limpa espaços e aplica a máscara
                const codeOnly = data.text.split('-')[0].trim();
                return formatCnae(codeOnly);
            }
        });

        cnaeSelect.on('select2:select', function (e) {
            const data = e.params.data;
            if (data && data.text) {
                const description = data.text.split(' - ').slice(1).join(' - ');
                if (description) {
                    $('#atividade_principal').val(description);
                }
            }
        });

        // Carregar Cidades com Select2 AJAX
        $('#estado').on('change', function() {
            const uf = $(this).val();
            const cidadeSelect = $('#cidade');

            // Reseta e desabilita o campo de cidade
            cidadeSelect.val(null).trigger('change').prop('disabled', true);
            $('#codigo_ibge').val('');

            if (uf) {
                // Habilita o campo e inicializa o Select2
                cidadeSelect.prop('disabled', false).select2({
                    placeholder: 'Digite para buscar uma cidade...',
                    minimumInputLength: 2,
                    ajax: {
                        url: `<?php echo base_url('index.php/ibge/search_cities'); ?>/${uf}`,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term // termo de pesquisa
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results
                            };
                        },
                        cache: true
                    }
                });
            } else {
                // Se nenhum estado for selecionado, mantém desabilitado
                cidadeSelect.select2('destroy').prop('disabled', true).empty().select2({
                    placeholder: "Selecione um estado primeiro"
                });
            }
        });

        // Quando uma cidade é selecionada, busca o código IBGE
        $('#cidade').on('select2:select', function(e) {
            const cityName = e.params.data.text || e.params.data.id;
            const ibgeCode = e.params.data.ibge || e.params.data.id;

            if (ibgeCode && /^\d+$/.test(ibgeCode)) {
                $('#codigo_ibge').val(ibgeCode);
            }
            $('#cidade_nome').val(cityName);
        });

        // Inicializa o Select2 para o campo de estado
        $('#estado').select2();

        $('#cidade').on('change', function() {
            let ibge = $(this).find('option:selected').data('ibge');
            $('#codigo_ibge').val(ibge || '');
        });

        // Carregar Estados com Cache e Fallback
        let estadosCache = localStorage.getItem('ibge_estados');
        if (estadosCache) {
            popularEstados(JSON.parse(estadosCache));
        } else {
            $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
                .done(function(data) {
                    localStorage.setItem('ibge_estados', JSON.stringify(data));
                    popularEstados(data);
                })
                .fail(function() {
                    $.getJSON('<?php echo base_url() ?>assets/json/estados.json', function(data) {
                        popularEstados(data.estados);
                    });
                });
        }

        // Validação do Formulário Principal
        $('#formCliente').validate({
            rules: {
                nomeCliente: { required: true }
            },
            messages: {
                nomeCliente: { required: 'Campo Requerido.' }
            },
            rules: {
                email: { required: true }
            },
            messages: {
                email: { required: 'Campo Requerido.' }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            submitHandler: function(form) {
                // Serializa contatos para JSON
                if (contatos.length > 0) {
                    $('#contatos-json').val(JSON.stringify(contatos));
                }

                var rua = $('#rua').val();
                var numero = $('#numero').val();
                var bairro = $('#bairro').val();
                var cidade = $('#cidade_nome').val() || ($('#cidade').select2('data')[0] ? $('#cidade').select2('data')[0].text : '');
                var estado = $('#estado').val();
                var lat = $('#latitude').val();
                var lon = $('#longitude').val();

                // Se os campos de endereço estiverem preenchidos mas as coordenadas não, geocodifica antes de submeter
                if (rua && numero && bairro && cidade && estado && (!lat || !lon)) {
                    // Mostra um indicador de carregamento
                    Swal.fire({
                        title: 'Aguarde!',
                        text: 'Estamos finalizando a geocodificação do endereço...',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    geocodeAddress(rua, numero, bairro, cidade, estado, $('#cep').val(),
                        function(coords) { // Success callback
                            $('#latitude').val(coords.lat);
                            $('#longitude').val(coords.lon);
                            Swal.close();
                            form.submit();
                        },
                        function(error) { // Error callback
                            console.log('Erro na geocodificação antes de submeter:', error);
                            Swal.close();
                            form.submit(); // Submete mesmo com erro na geocodificação
                        }
                    );
                } else {
                    form.submit(); // Submete diretamente se não precisar geocodificar
                }
            }
        });

        // Autocomplete para buscar usuários existentes
        $("#buscar_usuario").autocomplete({
            source: "<?php echo site_url('clientes/pesquisarUsuariosAjax'); ?>",
            minLength: 2,
            select: function(event, ui) {
                $("#usuarios_clientes_id").val(ui.item.id);
                $("#email").val(ui.item.email).attr('readonly', true);
                $("#senha").parents('.control-group').hide();
                $("#info-usuario-existente").show();
                $("#buscar_usuario").val(ui.item.label);
                return false;
            }
        });

        // Se o usuário limpar o campo de busca, libera os campos de email e senha
        $("#buscar_usuario").on('change', function() {
            if ($(this).val() == '') {
                $("#usuarios_clientes_id").val('');
                $("#email").attr('readonly', false);
                $("#senha").parents('.control-group').show();
                $("#info-usuario-existente").hide();
            }
        });

        // Inicializar
        aplicarMascaras();
        atualizarTabelaContatos();

        // Geocodificação e Mapa
        var mapSelector;
        var markerSelector;

        function updateGeocoding() {
            var rua = $('#rua').val();
            var numero = $('#numero').val();
            var bairro = $('#bairro').val();
            var cidade = $('#cidade_nome').val() || ($('#cidade').select2('data')[0] ? $('#cidade').select2('data')[0].text : '');
            var estado = $('#estado').val();
            var cep = $('#cep').val();

            if (!rua || !numero || !bairro || !cidade || !estado) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos Incompletos',
                    text: 'Por favor, preencha todos os campos de endereço (Rua, Número, Bairro, Cidade e Estado) antes de buscar as coordenadas.'
                });
                return;
            }

            if (rua === "..." || cidade === "...") {
                console.log('Aguardando preenchimento do ViaCEP...');
                return;
            }

            geocodeAddress(rua, numero, bairro, cidade, estado, cep, function(coords) {
                $('#latitude').val(coords.lat);
                $('#longitude').val(coords.lon);
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Coordenadas encontradas e preenchidas.'
                });
                
                if (markerSelector) {
                    markerSelector.setLatLng([coords.lat, coords.lon]);
                    if (mapSelector) mapSelector.setView([coords.lat, coords.lon], 15);
                }
            }, function(error) {
                console.log('Erro na geocodificação:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Não foi possível encontrar as coordenadas para o endereço fornecido.'
                });
            });
        }

        $('#btn-geocodificar').click(function() {
            updateGeocoding();
        });

        $('#btn-selecionar-mapa').click(function() {
            $('#modal-mapa').modal('show');
        });

        // Compatibilidade com Bootstrap 2 (shown) e 3+ (shown.bs.modal)
        $('#modal-mapa').on('shown shown.bs.modal', function() {
            var latField = $('#latitude').val();
            var lonField = $('#longitude').val();
            var cidade = $('#cidade').val();
            var estado = $('#estado').val();

            var lat = latField ? parseFloat(latField) : -15.7801;
            var lon = lonField ? parseFloat(lonField) : -47.9292;
            var zoom = latField ? 15 : 4;

            function renderMap(l, n, z) {
                if (!mapSelector) {
                    mapSelector = L.map('map-selector').setView([l, n], z);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(mapSelector);

                    markerSelector = L.marker([l, n], {draggable: true}).addTo(mapSelector);

                    mapSelector.on('click', function(e) {
                        markerSelector.setLatLng(e.latlng);
                        $('#latitude').val(e.latlng.lat.toFixed(8));
                        $('#longitude').val(e.latlng.lng.toFixed(8));
                    });

                    markerSelector.on('dragend', function(e) {
                        var position = markerSelector.getLatLng();
                        $('#latitude').val(position.lat.toFixed(8));
                        $('#longitude').val(position.lng.toFixed(8));
                    });
                } else {
                    mapSelector.invalidateSize();
                    mapSelector.setView([l, n], z);
                    markerSelector.setLatLng([l, n]);
                }
            }

            // Se não tem coordenada mas tem cidade, busca a cidade para centralizar
            if (!latField && cidade) {
                var searchCity = cidade + (estado ? ", " + estado : "") + ", Brasil";
                $.getJSON(`https://photon.komoot.io/api/?q=${encodeURIComponent(searchCity)}&limit=1`, function(data) {
                    if (data && data.features && data.features.length > 0) {
                        var coords = data.features[0].geometry.coordinates;
                        setTimeout(function() { renderMap(coords[1], coords[0], 12); }, 300);
                    } else {
                        setTimeout(function() { renderMap(lat, lon, zoom); }, 300);
                    }
                }).fail(function() {
                    setTimeout(function() { renderMap(lat, lon, zoom); }, 300);
                });
            } else {
                setTimeout(function() { renderMap(lat, lon, zoom); }, 300);
            }
        });
    });

</script>
