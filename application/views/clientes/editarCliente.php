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
                <h5>Editar Cliente: <?php echo $result->nomeCliente ?></h5>
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
                                            <input id="documento" class="cpfcnpj" type="text" name="documento" value="<?php echo $result->documento; ?>" placeholder="Digite o CPF ou CNPJ" aria-label="Campo para CPF ou CNPJ" title="CPF/CNPJ: Opcional, mas se preenchido deve ser válido." />
                                            <button id="buscar_info_cnpj" class="button btn btn-mini btn-inverse btn-consultar-cnpj" type="button" aria-label="Botão para buscar informações do CNPJ">
                                                <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                                                <span class="button__text2">Buscar(CNPJ)</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="nomeCliente" class="control-label">Nome/Razão Social<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="nomeCliente" type="text" name="nomeCliente" value="<?php echo $result->nomeCliente; ?>" placeholder="Digite o nome completo ou razão social" aria-label="Campo obrigatório para nome ou razão social" aria-required="true" title="Campo obrigatório." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="ie" class="control-label">Inscrição Estadual (IE)</label>
                                        <div class="controls">
                                            <input id="ie" type="text" name="ie" value="<?php echo $result->ie; ?>" placeholder="Digite a Inscrição Estadual" aria-label="Campo para Inscrição Estadual" title="IE: Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="im" class="control-label">Inscrição Municipal (IM)</label>
                                        <div class="controls">
                                            <input id="im" type="text" name="im" value="<?php echo $result->im; ?>" placeholder="Digite a Inscrição Municipal" aria-label="Campo para Inscrição Municipal" title="IM: Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="fantasia" class="control-label">Nome Fantasia</label>
                                        <div class="controls">
                                            <input id="fantasia" type="text" name="fantasia" value="<?php echo $result->fantasia; ?>" placeholder="Digite o nome fantasia da empresa" aria-label="Campo para nome fantasia da empresa" title="Nome fantasia. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="tipo" class="control-label">Tipo</label>
                                        <div class="controls">
                                            <input id="tipo" type="text" name="tipo" value="<?php echo $result->tipo; ?>" placeholder="Ex: MATRIZ ou FILIAL" aria-label="Campo para tipo da empresa" title="Tipo (MATRIZ/FILIAL). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="porte" class="control-label">Porte</label>
                                        <div class="controls">
                                            <input id="porte" type="text" name="porte" value="<?php echo $result->porte; ?>" placeholder="Ex: micro, pequena, média" aria-label="Campo para porte da empresa" title="Porte da empresa (micro, pequena, média). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="natureza_juridica" class="control-label">Natureza Jurídica</label>
                                        <div class="controls">
                                            <input id="natureza_juridica" type="text" name="natureza_juridica" value="<?php echo $result->natureza_juridica; ?>" placeholder="Digite a natureza jurídica" aria-label="Campo para natureza jurídica da empresa" title="Natureza jurídica. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="sexo" class="control-label">Sexo</label>
                                        <div class="controls">
                                            <select id="sexo" name="sexo" aria-label="Seleção de sexo" title="Sexo. Opcional.">
                                                <option value="">Selecione...</option>
                                                <option value="Masculino" <?php echo ($result->sexo == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                                <option value="Feminino" <?php echo ($result->sexo == 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                                                <option value="Outro" <?php echo ($result->sexo == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="nascimento" class="control-label">Data de Nascimento</label>
                                        <div class="controls">
                                            <input id="nascimento" type="date" name="nascimento" value="<?php echo $result->nascimento; ?>" placeholder="Selecione a data de nascimento" aria-label="Campo para data de nascimento" title="Data de nascimento (DD/MM/AAAA). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-fisica">
                                        <label for="tratamento" class="control-label">Tratamento</label>
                                        <div class="controls">
                                            <select id="tratamento" name="tratamento" aria-label="Seleção de forma de tratamento" title="Forma de tratamento. Opcional.">
                                                <option value="">Selecione...</option>
                                                <option value="Sr." <?php echo ($result->tratamento == 'Sr.') ? 'selected' : ''; ?>>Sr.</option>
                                                <option value="Sra." <?php echo ($result->tratamento == 'Sra.') ? 'selected' : ''; ?>>Sra.</option>
                                                <option value="Sr.(a)" <?php echo ($result->tratamento == 'Sr.(a)') ? 'selected' : ''; ?>>Sr.(a)</option>
                                                <option value="Doutor" <?php echo ($result->tratamento == 'Doutor') ? 'selected' : ''; ?>>Doutor</option>
                                                <option value="Doutora" <?php echo ($result->tratamento == 'Doutora') ? 'selected' : ''; ?>>Doutora</option>
                                                <option value="Professor" <?php echo ($result->tratamento == 'Professor') ? 'selected' : ''; ?>>Professor</option>
                                                <option value="Professora" <?php echo ($result->tratamento == 'Professora') ? 'selected' : ''; ?>>Professora</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="contato" class="control-label">Contato</label>
                                        <div class="controls">
                                            <input class="contato" type="text" name="contato" value="<?php echo $result->contato; ?>" placeholder="Nome da pessoa de contato" aria-label="Campo para nome da pessoa de contato" title="Nome da pessoa de contato. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="telefone" class="control-label">Telefone</label>
                                        <div class="controls">
                                            <input id="telefone" type="text" name="telefone" value="<?php echo $result->telefone; ?>" placeholder="(11) 99999-9999" aria-label="Campo para telefone fixo" title="Telefone (fixo ou celular). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="celular" class="control-label">Celular</label>
                                        <div class="controls">
                                            <input id="celular" type="text" name="celular" value="<?php echo $result->celular; ?>" placeholder="(11) 99999-9999" aria-label="Campo para celular" title="Celular. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="email" class="control-label">Email</label>
                                        <div class="controls">
                                            <input id="email" type="email" name="email" autocomplete="off" value="<?php echo $result->email; ?>" placeholder="exemplo@email.com" aria-label="Campo para endereço de email" autocomplete="off" title="Email. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="senha" class="control-label">Senha</label>
                                        <div class="controls">
                                            <div class="password-wrapper">
                                                <input class="form-control" id="senha" type="password" name="senha" autocomplete="new-password" value="" placeholder="Digite uma nova senha se desejar alterar" aria-label="Campo para senha de acesso" title="Senha: Deixe em branco para manter a senha atual. Para alterar, digite uma nova senha (mínimo 6 caracteres)." />
                                                <img id="imgSenha" src="<?php echo base_url() ?>assets/img/eye.svg" alt="" aria-label="Botão para mostrar/ocultar senha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tipo de Cliente</label>
                                        <div class="controls">
                                            <label for="fornecedor" class="btn btn-default tipo-cliente" aria-label="Checkbox para marcar se também é fornecedor">
                                                Fornecedor
                                                <input type="checkbox" id="fornecedor" name="fornecedor" class="badgebox" value="1" <?= ($result->fornecedor == 1) ? 'checked' : '' ?> title="Também é fornecedor?">
                                                <span class="badge">&check;</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="span6">
                                    <div class="control-group">
                                        <label for="cep" class="control-label">CEP</label>
                                        <div class="controls">
                                            <input id="cep" type="text" name="cep" value="<?php echo $result->cep; ?>" placeholder="00000-000" aria-label="Campo para CEP" title="CEP. Opcional." />
                                        </div>
                                    </div>
                                    <input type="hidden" name="codigo_ibge" id="codigo_ibge" value="<?php echo $result->codigo_ibge; ?>">
                                    <div class="control-group">
                                        <label for="rua" class="control-label">Rua</label>
                                        <div class="controls">
                                            <input id="rua" type="text" name="rua" value="<?php echo $result->rua; ?>" placeholder="Nome da rua ou logradouro" aria-label="Campo para nome da rua" title="Rua. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="numero" class="control-label">Número</label>
                                        <div class="controls">
                                            <input id="numero" type="text" name="numero" value="<?php echo $result->numero; ?>" placeholder="Número do endereço" aria-label="Campo para número do endereço" title="Número. Opcional" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="complemento" class="control-label">Complemento</label>
                                        <div class="controls">
                                            <input id="complemento" type="text" name="complemento" value="<?php echo $result->complemento; ?>" placeholder="Apartamento, bloco, etc." aria-label="Campo para complemento do endereço" title="Complemento. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="bairro" class="control-label">Bairro</label>
                                        <div class="controls">
                                            <input id="bairro" type="text" name="bairro" value="<?php echo $result->bairro; ?>" placeholder="Nome do bairro" aria-label="Campo para nome do bairro" title="Bairro. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="cidade" class="control-label">Cidade</label>
                                        <div class="controls">
                                            <select id="cidade" name="cidade_select">
                                                <option value="<?php echo $result->cidade; ?>" selected><?php echo $result->cidade; ?></option>
                                            </select>
                                            <input type="hidden" name="cidade" id="cidade_nome" value="<?php echo $result->cidade; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="estado" class="control-label">Estado</label>
                                        <div class="controls">
                                            <select id="estado" name="estado" aria-label="Seleção de estado" title="Estado. Opcional."></select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="latitude" class="control-label">Latitude</label>
                                        <div class="controls">
                                            <input id="latitude" type="text" name="latitude" value="<?php echo $result->latitude; ?>" readonly placeholder="Preenchido automaticamente" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="longitude" class="control-label">Longitude</label>
                                        <div class="controls">
                                            <input id="longitude" type="text" name="longitude" value="<?php echo $result->longitude; ?>" readonly placeholder="Preenchido automaticamente" />
                                            <div class="geo-buttons">
                                                <button type="button" id="btn-geocodificar" class="button btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço">
                                                    <span class="button__icon"><i class='bx bx-search'></i></span>
                                                    <span class="button__text2"> Buscar</span>
                                                </button>
                                                <button type="button" id="btn-selecionar-mapa" class="button btn btn-mini btn-inverse" title="Selecionar local manualmente no mapa">
                                                    <span class="button__icon"><i class='bx bx-map'></i></span>
                                                    <span class="button__text2"> Selecionar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="atividade_principal" class="control-label">Atividade Principal</label>
                                        <div class="controls">
                                            <textarea id="atividade_principal" name="atividade_principal" rows="2" placeholder="Descrição da atividade principal" aria-label="Campo para atividade principal da empresa" title="Atividade principal. Opcional."><?php echo $result->atividade_principal; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="cnae" class="control-label">CNAE</label>
                                        <div class="controls">
                                            <select id="cnae" name="cnae" title="CNAE. Opcional.">
                                                <?php if (!empty($result->cnae)) : ?>
                                                    <option value="<?php echo $result->cnae; ?>" selected><?php echo $result->cnae; ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="atividades_secundarias" class="control-label">Atividades Secundárias</label>
                                        <div class="controls">
                                            <textarea id="atividades_secundarias" name="atividades_secundarias" rows="2" placeholder="Liste as atividades secundárias" aria-label="Campo para atividades secundárias da empresa"><?php echo $result->atividades_secundarias; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="situacao" class="control-label">Situação</label>
                                        <div class="controls">
                                            <input id="situacao" type="text" name="situacao" value="<?php echo $result->situacao; ?>" placeholder="Situação atual da empresa" aria-label="Campo para situação da empresa" />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="data_situacao" class="control-label">Data Situação</label>
                                        <div class="controls">
                                            <input id="data_situacao" type="text" name="data_situacao" value="<?php echo (!empty($result->data_situacao) && $result->data_situacao != '0000-00-00') ? date('d/m/Y', strtotime($result->data_situacao)) : ''; ?>" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação" title="Data da situação (DD/MM/AAAA). Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="motivo_situacao" class="control-label">Motivo Situação</label>
                                        <div class="controls">
                                            <input id="motivo_situacao" type="text" name="motivo_situacao" value="<?php echo $result->motivo_situacao; ?>" placeholder="Motivo da situação atual" aria-label="Campo para motivo da situação" />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="situacao_especial" class="control-label">Situação Especial</label>
                                        <div class="controls">
                                            <input id="situacao_especial" type="text" name="situacao_especial" value="<?php echo $result->situacao_especial; ?>" placeholder="Situação especial, se aplicável" aria-label="Campo para situação especial" />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="data_situacao_especial" class="control-label">Data Situação Especial</label>
                                        <div class="controls">
                                            <input id="data_situacao_especial" type="text" name="data_situacao_especial" value="<?php echo (!empty($result->data_situacao_especial) && $result->data_situacao_especial != '0000-00-00') ? date('d/m/Y', strtotime($result->data_situacao_especial)) : ''; ?>" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação especial" title="Data da situação especial. Opcional." />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="capital_social" class="control-label">Capital Social</label>
                                        <div class="controls">
                                            <input id="capital_social" type="text" name="capital_social" value="<?php echo $result->capital_social; ?>" placeholder="Valor do capital social" aria-label="Campo para capital social da empresa" />
                                        </div>
                                    </div>
                                    <div class="control-group campos-pessoa-juridica">
                                        <label for="qsa" class="control-label">QSA (Sócios)</label>
                                        <div class="controls">
                                            <textarea id="qsa" name="qsa" rows="2" placeholder="Lista dos sócios da empresa" aria-label="Campo para lista de sócios (QSA)" title="Lista de sócios (QSA). Opcional."><?php echo $result->qsa; ?></textarea>
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
                            <div id="msg-sem-contatos" class="alert alert-info" style="display: none;">
                                <i class="fas fa-info-circle"></i> <strong>Nenhum contato cadastrado ainda.</strong> Clique no botão abaixo para adicionar contatos.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-contatos" style="display: none; margin-bottom: 15px;">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;">Nome</th>
                                            <th style="width: 20%;">Email</th>
                                            <th style="width: 15%;">Telefone</th>
                                            <th style="width: 15%;">Celular</th>
                                            <th style="width: 10%;">Cargo</th>
                                            <th style="width: 10%;">Data Cadastro</th>
                                            <th style="width: 10%;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contatos-table-body">
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" name="contatos_json" id="contatos-json" value='<?php echo htmlspecialchars(json_encode($contatos)); ?>'>

                            <?php $this->load->view('clientes/contatos/formContato'); ?>

                            <div class="accordion-footer" style="display: flex;justify-content: start; border-top: 1px solid #ccc; margin: 0 20px 0 20px;">
                                <button type="button" class="button btn btn-mini btn-primary" id="btn-add-contato" style="margin: 10px 20px;">
                                    <span class="button__icon"><i class="bx bx-plus-circle"></i></span>
                                    <span class="button__text2"> Adicionar Contato</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="idClientes" value="<?php echo $result->idClientes ?>" />

                    <!-- ============= ACCORDION: ACESSOS DO PORTAL ============= -->
                    <div class="accordion-group" id="accordion-acessos">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-acessos', this)">
                                <i class="fas fa-chevron-right"></i> <strong>ACESSOS DO PORTAL (USUÁRIOS) <span class="badge badge-info" id="badge-acessos"><?php echo count($usuarios_vinculados); ?></span></strong>
                            </a>
                        </div>
                        <div id="collapse-acessos" class="accordion-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> <strong>Gestão de Acessos:</strong> Aqui você define quais usuários cadastrados podem acessar este cliente no portal.
                            </div>

                            <div class="row-fluid" style="width: auto; margin: 10px; background: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #eee;">
                                <label><strong>Vincular Novo Usuário Existente:</strong></label>
                                <div style="display: flex; justify-content: flex-start; gap: 5px; margin-top: 10px;">
                                    <input type="text" id="buscar_usuario_vinculo" class="span10" placeholder="Digite o nome ou e-mail de um usuário para conceder acesso">
                                    <button class="button btn btn-mini btn-success" type="button" id="btn-vincular-usuario">
                                        <span class="button__icon"><i class="bx bx-plus-circle"></i></span>
                                        <span class="button__text2"> Vincular</span>
                                    </button>
                                </div>
                                <input type="hidden" id="usuario_id_vinculo">
                                <p><small class="text-muted">Pesquise por usuários que já possuem login no sistema.</small></p>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-acessos">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Permissão</th>
                                            <th style="width: 10%;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-acessos">
                                        <?php if (empty($usuarios_vinculados)): ?>
                                            <tr id="row-sem-acessos">
                                                <td colspan="4" class="text-center">Nenhum usuário vinculado a este cliente.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($usuarios_vinculados as $u): ?>
                                                <tr id="vinculo-<?php echo $u->idUsuariosClientes; ?>">
                                                    <td><strong><?php echo $u->nome; ?></strong></td>
                                                    <td><?php echo $u->email; ?></td>
                                                    <td><span class="badge badge-success"><?php echo ucfirst($u->tipo); ?></span></td>
                                                    <td>
                                                        <button type="button" class="button btn btn-xs btn-danger btn-remover-vinculo" 
                                                                data-id="<?php echo $u->idUsuariosClientes; ?>" 
                                                                data-nome="<?php echo $u->nome; ?>" title="Remover Acesso" style="margin-right: 5px; margin-bottom: 5px;">
                                                            <span class="button__icon"><i class="bx bx-trash"></i></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex; justify-content: center; gap: 10px;">
                            <button type="submit" class="button btn btn-mini btn-success" style="width: 120px;"><span class="button__icon"><i class='bx bx-save'></i></span><span class="button__text2">Salvar</span></button>
                            <a title="Voltar" class="button btn btn-warning" style="width: 120px;" href="<?php echo site_url('clientes') ?>"><span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modais para Confirmar Exclusão (mantido para editar cliente) -->
<!-- MODAL PARA CONFIRMAR EXCLUSÃO -->
<div class="modal hide fade" id="modal-delete-contato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Confirmar Exclusão</h4>
            </div>
            <div class="modal-body">
                <h5 style="text-align: center;">Tem certeza que deseja remover o contato <strong id="delete-contato-nome"></strong>?</h5>
                <h5 style="text-align: center;"><small style="color: red;">Esta ação não pode ser desfeita.</small></h5>
            </div>
            <div class="modal-footer" style="display: flex; justify-content: center;">
                <button type="button" class="button btn btn-mini btn-warning" data-dismiss="modal"><span class="button__icon"><i class='bx bx-x'></i></span><span class="button__text2">Cancelar</span></button>
                <button type="button" class="button btn btn-mini btn-danger" id="btn-confirm-delete"><span class="button__icon"><i class='bx bx-trash'></i></span><span class="button__text2">Deletar Contato</span></button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE CARREGAMENTO -->
<div class="modal hide fade" id="modal-loading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center" style="padding: 30px;">
                <i class="bx bx-loader bx-spin" style="font-size: 24px; color: #007bff;"></i>
                <p style="margin-top: 10px;" id="loading-text">Processando...</p>
            </div>
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

        $('#documento').trigger('input');

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

        const CLIENTE_ID = <?php echo $result->idClientes ?>;
        let idContatoEmEdicao = null;

        // Carregar contatos na inicialização
        carregarContatos();

        // Carregar Contatos (AJAX)
        function carregarContatos() {
            $.ajax({
                url: '<?php echo site_url('clientes/getContatos') ?>',
                type: 'POST',
                data: { 
                    cliente_id: CLIENTE_ID,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        preencherTabelaContatos(response.data);
                    } else {
                        $('#msg-sem-contatos').show();
                        $('#table-contatos').hide();
                        $('#badge-contatos').text('0');
                    }
                },
                error: function() {
                    alert('Erro ao carregar contatos.');
                }
            });
        }

        // Preencher Tabela de Contatos

                function preencherTabelaContatos(contatos) {

                    contatosList = contatos; // Armazena a lista de contatos

                    FormContatoInline.renderTabelaContatos({
                        contatos: contatos,
                        escapeHtml: escapeHtml,
                        renderExtraColumns: function (contato) {
                            let dataCadastro;

                            try {
                                if (contato.dataCadastro && contato.dataCadastro.trim() !== '' && new Date(contato.dataCadastro).toString() !== 'Invalid Date') {
                                    dataCadastro = new Date(contato.dataCadastro).toLocaleDateString('pt-BR');
                                } else {
                                    dataCadastro = '-';
                                }
                            } catch (e) {
                                dataCadastro = '-';
                            }

                            return '<td><small>' + dataCadastro + '</small></td>';
                        },
                        getActionButtons: function (contato, index, helpers) {
                            return helpers.criarBotaoAcao('edit', {
                                'data-id': contato.idContatos
                            }) + helpers.criarBotaoAcao('delete', {
                                'data-id': contato.idContatos,
                                'data-nome': helpers.escapeHtml(contato.nome)
                            });
                        }
                    });
                }

        // Botão: Adicionar Contato (Inline)
        $('#btn-add-contato').on('click', function() {
            idContatoEmEdicao = null;
            limparModal();
            $('#form-contato-titulo').text('Adicionar Contato');
            $('#form-contato-inline').slideDown(300);
        });

        FormContatoInline.initListActions({
            aplicarMascaras: aplicarMascaras,
            escapeHtml: escapeHtml,
            onEditar: function ($button, abrirFormulario) {
                let idContato = $button.data('id');

                $.ajax({
                    url: '<?php echo site_url('clientes/getContatoById') ?>',
                    type: 'POST',
                    data: {
                        idContatos: idContato,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let contato = response.data;

                            limparModal();
                            idContatoEmEdicao = contato.idContatos;
                            abrirFormulario(contato);
                        }
                    }
                });
            },
            onExcluir: function ($button) {
                let idContato = $button.data('id');
                let nome = $button.data('nome');

                $('#delete-contato-nome').text(nome);
                $('#btn-confirm-delete').data('id', idContato);
                $('#modal-delete-contato').modal('show');
            }
        });

        $('#btn-confirm-delete').on('click', function() {
            let idContato = $(this).data('id');

            $('#modal-delete-contato').modal('hide');
            $('#modal-loading').modal('show');

            $.ajax({
                url: '<?php echo site_url('clientes/deletarContato') ?>',
                type: 'POST',
                data: { 
                    idContatos: idContato,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                dataType: 'json',
                success: function(response) {
                    $('#modal-loading').modal('hide');

                    if (response.status === 'success') {
                        carregarContatos();
                        mostrarNotificacao('success', 'Contato deletado com sucesso!');
                    } else {
                        mostrarNotificacao('error', response.message || 'Erro ao deletar');
                    }
                },
                error: function() {
                    $('#modal-loading').modal('hide');
                    mostrarNotificacao('error', 'Erro ao deletar contato');
                }
            });
        });

        // Limpar Modal
        function limparModal() {
            FormContatoInline.resetFormulario();
            idContatoEmEdicao = null;
            aplicarMascaras();
        }

        FormContatoInline.bindEventos(aplicarMascaras);

        FormContatoInline.initAjax({
            getIdContato: function () { return idContatoEmEdicao; },
            getClienteId: function () { return CLIENTE_ID; },
            getContatosParaValidacao: function () {
                try {
                    return JSON.parse($('#contatos-json').val() || '[]');
                } catch (e) { return []; }
            },
            onSalvoComSucesso: function (isEditing) {
                carregarContatos();
                mostrarNotificacao('success', isEditing ? 'Contato atualizado com sucesso!' : 'Contato adicionado com sucesso!');
            },
            onErro: function (msg) {
                mostrarNotificacao('error', msg);
            }
        });



        // Notificação
        function mostrarNotificacao(tipo, mensagem) {
            let alertClass = tipo === 'success' ? 'alert-success' : 'alert-danger';
            let icon = tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

            let html = `<div class="alert ${alertClass} alert-dismissable alert-floating" 
                            style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fas ${icon}"></i> ${mensagem}
                        </div>`;

            $('body').append(html);

            setTimeout(() => {
                $('.alert-floating').fadeOut('fast', function() { $(this).remove(); });
            }, 4000);
        }

        // Máscaras de Entrada
        function aplicarMascaras() {
            $('#data_situacao').mask("00/00/0000");
            $('#data_situacao_especial').mask("00/00/0000");
            $('#inline-telefone, .mascara-telefone').mask("(00) 0000-0000");
            $('#inline-celular, .mascara-celular').mask("(00) 00000-0000");
        }

        // Variáveis globais para edição
        let curState = '<?php echo addslashes($result->estado); ?>';
        let curCity = '<?php echo addslashes($result->cidade); ?>';

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

                // Se já existe uma cidade selecionada (curCity), cria a option
                if (curCity) {
                    var option = new Option(curCity, curCity, true, true);
                    cidadeSelect.append(option).trigger('change');
                    curCity = ''; // Limpa para não interferir em seleções futuras
                }

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
                var rua = $('#rua').val();
                var numero = $('#numero').val();
                var bairro = $('#bairro').val();
                var cidade = $('#cidade_nome').val() || ($('#cidade').select2('data')[0] ? $('#cidade').select2('data')[0].text : '');
                var estado = $('#estado').val();
                var lat = $('#latitude').val();
                var lon = $('#longitude').val();

                // Se os campos de endereço estiverem preenchidos mas as coordenadas não, geocodifica antes de submeter
                if (rua && numero && bairro && cidade && estado && (!lat || !lon || lat.trim() === '0' || lat.trim() === '0.00000000')) {
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

        // Autocomplete para buscar usuários no vínculo (edição)
        $("#buscar_usuario_vinculo").autocomplete({
            source: "<?php echo site_url('clientes/pesquisarUsuariosAjax'); ?>",
            minLength: 1,
            select: function(event, ui) {
                $("#usuario_id_vinculo").val(ui.item.id);
                return true;
            }
        });

        // Botão Vincular Usuário
        $('#btn-vincular-usuario').on('click', function() {
            let usuarioId = $('#usuario_id_vinculo').val();
            let clienteId = CLIENTE_ID;

            if (!usuarioId) {
                mostrarNotificacao('error', 'Selecione um usuário na lista antes de vincular.');
                return;
            }

            $('#modal-loading').modal('show');

            $.ajax({
                url: '<?php echo site_url('clientes/adicionarVinculoAjax') ?>',
                type: 'POST',
                data: { 
                    usuario_id: usuarioId, 
                    cliente_id: clienteId,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                dataType: 'json',
                success: function(response) {
                    $('#modal-loading').modal('hide');
                    if (response.result) {
                        mostrarNotificacao('success', response.message);
                        location.reload(); // Recarrega para atualizar a lista
                    } else {
                        mostrarNotificacao('error', response.message);
                    }
                },
                error: function() {
                    $('#modal-loading').modal('hide');
                    mostrarNotificacao('error', 'Erro ao processar requisição.');
                }
            });
        });

        // Botão Remover Vínculo
        $(document).on('click', '.btn-remover-vinculo', function() {
            let usuarioId = $(this).data('id');
            let nome = $(this).data('nome');
            let clienteId = CLIENTE_ID;

            if (confirm('Tem certeza que deseja remover o acesso do usuário ' + nome + ' a este cliente?')) {
                $('#modal-loading').modal('show');

                $.ajax({
                    url: '<?php echo site_url('clientes/removerVinculoAjax') ?>',
                    type: 'POST',
                    data: { 
                        usuario_id: usuarioId, 
                        cliente_id: clienteId,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#modal-loading').modal('hide');
                        if (response.result) {
                            mostrarNotificacao('success', response.message);
                            $('#vinculo-' + usuarioId).remove();
                            let count = parseInt($('#badge-acessos').text()) - 1;
                            $('#badge-acessos').text(count);
                            if (count === 0) {
                                $('#tbody-acessos').append('<tr id="row-sem-acessos"><td colspan="4" class="text-center">Nenhum usuário vinculado a este cliente.</td></tr>');
                            }
                        } else {
                            mostrarNotificacao('error', response.message);
                        }
                    },
                    error: function() {
                        $('#modal-loading').modal('hide');
                        mostrarNotificacao('error', 'Erro ao processar requisição.');
                    }
                });
            }
        });

        // Inicializar
        aplicarMascaras();

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
