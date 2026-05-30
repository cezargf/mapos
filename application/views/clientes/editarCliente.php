<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
<style>
    #imgSenha {
        width: 18px;
        cursor: pointer;
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

    .form-horizontal .control-group {
        border-bottom: 1px solid #ffffff;
    }

    .form-horizontal .controls {
        margin-left: 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        margin-right: 20px;
    }

    .widget-title h5 {
        padding-bottom: 30px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    .accordion-group {
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
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
        padding: 15px;
    }

    .accordion-body.in {
        display: block;
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

    @media (max-width: 768px) {
        .form-horizontal .control-label,
        .form-horizontal .controls,
        .row-fluid > .span6,
        .form-actions .span6 {
            float: none !important;
            width: auto !important;
            margin-left: 0 !important;
        }

        .form-horizontal .control-label {
            width: auto !important;
            float: none !important;
            padding-top: 10px;
        }

        .form-horizontal .controls {
            margin-left: 0 !important;
            padding-bottom: 8px;
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
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        margin-bottom: 15px;
    }

    .accordion-body::after,
    .tab-pane::after,
    .widget-content::after {
        content: "";
        display: table;
        clear: both;
    }

    /* Correção para modal sobreposto e centralização no BS2 */
    #modal-mapa {
        width: 80%;
        max-width: 800px;
        margin-left: -40%; /* Centraliza baseado na largura de 80% */
        left: 50%;
        top: 5%;
        z-index: 1050 !important;
    }

    #map-selector {
        height: 400px;
        width: 100%;
        background-color: #eee; /* Fundo para indicar onde o mapa deveria estar */
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-user-edit"></i>
                </span>
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
                                    <div class="control-group">
                                        <label for="documento" class="control-label">CPF/CNPJ</label>
                                        <div class="controls">
                                            <input id="documento" class="cpfcnpj" type="text" name="documento" value="<?php echo $result->documento; ?>" tabindex="1" placeholder="Digite o CPF ou CNPJ" aria-label="Campo para CPF ou CNPJ" title="CPF/CNPJ: Opcional, mas se preenchido deve ser válido." />
                                            <button id="buscar_info_cnpj" class="btn btn-xs" type="button" tabindex="2" aria-label="Botão para buscar informações do CNPJ">Buscar(CNPJ)</button>
                                        </div>
                                    </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="ie" class="control-label">Inscrição Estadual (IE)</label>
                                    <div class="controls">
                                        <input id="ie" type="text" name="ie" value="<?php echo $result->ie; ?>" tabindex="3" placeholder="Digite a Inscrição Estadual" aria-label="Campo para Inscrição Estadual" title="IE: Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="im" class="control-label">Inscrição Municipal (IM)</label>
                                    <div class="controls">
                                        <input id="im" type="text" name="im" value="<?php echo $result->im; ?>" tabindex="4" placeholder="Digite a Inscrição Municipal" aria-label="Campo para Inscrição Municipal" title="IM: Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="fantasia" class="control-label">Nome Fantasia</label>
                                    <div class="controls">
                                        <input id="fantasia" type="text" name="fantasia" value="<?php echo $result->fantasia; ?>" tabindex="5" placeholder="Digite o nome fantasia da empresa" aria-label="Campo para nome fantasia da empresa" title="Nome fantasia. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="tipo" class="control-label">Tipo</label>
                                    <div class="controls">
                                        <input id="tipo" type="text" name="tipo" value="<?php echo $result->tipo; ?>" tabindex="6" placeholder="Ex: MATRIZ ou FILIAL" aria-label="Campo para tipo da empresa" title="Tipo (MATRIZ/FILIAL). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="porte" class="control-label">Porte</label>
                                    <div class="controls">
                                        <input id="porte" type="text" name="porte" value="<?php echo $result->porte; ?>" tabindex="7" placeholder="Ex: micro, pequena, média" aria-label="Campo para porte da empresa" title="Porte da empresa (micro, pequena, média). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="natureza_juridica" class="control-label">Natureza Jurídica</label>
                                    <div class="controls">
                                        <input id="natureza_juridica" type="text" name="natureza_juridica" value="<?php echo $result->natureza_juridica; ?>" tabindex="8" placeholder="Digite a natureza jurídica" aria-label="Campo para natureza jurídica da empresa" title="Natureza jurídica. Opcional." />
                                    </div>
                                </div>



                                <div class="control-group">
                                    <label for="nomeCliente" class="control-label">Nome/Razão Social<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="nomeCliente" type="text" name="nomeCliente" value="<?php echo $result->nomeCliente; ?>" tabindex="9" placeholder="Digite o nome completo ou razão social" aria-label="Campo obrigatório para nome ou razão social" aria-required="true" title="Campo obrigatório." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-fisica">
                                    <label for="sexo" class="control-label">Sexo</label>
                                    <div class="controls">
                                        <select id="sexo" name="sexo" tabindex="10" aria-label="Seleção de sexo" title="Sexo. Opcional.">
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
                                        <input id="nascimento" type="date" name="nascimento" value="<?php echo $result->nascimento; ?>" tabindex="11" placeholder="Selecione a data de nascimento" aria-label="Campo para data de nascimento" title="Data de nascimento (DD/MM/AAAA). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-fisica">
                                    <label for="tratamento" class="control-label">Tratamento</label>
                                    <div class="controls">
                                        <select id="tratamento" name="tratamento" tabindex="12" aria-label="Seleção de forma de tratamento" title="Forma de tratamento. Opcional.">
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
                                        <input class="contato" type="text" name="contato" value="<?php echo $result->contato; ?>" tabindex="13" placeholder="Nome da pessoa de contato" aria-label="Campo para nome da pessoa de contato" title="Nome da pessoa de contato. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="telefone" class="control-label">Telefone</label>
                                    <div class="controls">
                                        <input id="telefone" type="text" name="telefone" value="<?php echo $result->telefone; ?>" tabindex="14" placeholder="(11) 99999-9999" aria-label="Campo para telefone fixo" title="Telefone (fixo ou celular). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="celular" class="control-label">Celular</label>
                                    <div class="controls">
                                        <input id="celular" type="text" name="celular" value="<?php echo $result->celular; ?>" tabindex="15" placeholder="(11) 99999-9999" aria-label="Campo para celular" title="Celular. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="email" class="control-label">Email</label>
                                    <div class="controls">
                                        <input id="email" type="email" name="email" value="<?php echo $result->email; ?>" tabindex="16" placeholder="exemplo@email.com" aria-label="Campo para endereço de email" title="Email. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="senha" class="control-label">Senha</label>
                                    <div class="controls">
                                        <input class="form-control" id="senha" type="password" name="senha" autocomplete="new-password" value="" tabindex="17" placeholder="Digite uma nova senha se desejar alterar" aria-label="Campo para senha de acesso" title="Senha: Deixe em branco para manter a senha atual. Para alterar, digite uma nova senha (mínimo 6 caracteres)." />
                                        <img id="imgSenha" src="<?php echo base_url() ?>assets/img/eye.svg" alt="" style="cursor: pointer; margin-top: 5px;" aria-label="Botão para mostrar/ocultar senha">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Status de Prospecção</label>
                                    <div class="controls">
                                        <label for="prospectado" class="btn btn-default" tabindex="18">
                                            Prospectado
                                            <input type="checkbox" id="prospectado" name="prospectado" class="badgebox" value="1" <?= ($result->prospectado == 1) ? 'checked' : '' ?>>
                                            <span class="badge">&check;</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group" id="group-origem" style="display: none;">
                                    <label for="origem_prospeccao" class="control-label">Origem da Prospecção</label>
                                    <div class="controls">
                                        <select name="origem_prospeccao" id="origem_prospeccao" class="span11">
                                            <option value="">Selecione...</option>
                                            <option value="Receita Federal" <?= ($result->origem_prospeccao == 'Receita Federal') ? 'selected' : '' ?>>Receita Federal (BigQuery)</option>
                                            <option value="CNO" <?= ($result->origem_prospeccao == 'CNO') ? 'selected' : '' ?>>CNO (BigQuery)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Tipo de Cliente</label>
                                    <div class="controls">
                                        <label for="fornecedor" class="btn btn-default" tabindex="18" aria-label="Checkbox para marcar se também é fornecedor">
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
                                        <input id="cep" type="text" name="cep" value="<?php echo $result->cep; ?>" tabindex="19" placeholder="00000-000" aria-label="Campo para CEP" />
                                    </div>
                                </div>
                                <input type="hidden" name="codigo_ibge" id="codigo_ibge" value="<?php echo $result->codigo_ibge; ?>">
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
                                        <div style="margin-top: 5px;">
                                            <button type="button" id="btn-geocodificar" class="btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço"><i class='bx bx-search'></i> Buscar Coordenadas</button>
                                            <button type="button" id="btn-selecionar-mapa" class="btn btn-mini btn-inverse" title="Selecionar local manualmente no mapa"><i class='bx bx-map'></i> Selecionar no Mapa</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="rua" class="control-label">Rua</label>
                                    <div class="controls">
                                        <input id="rua" type="text" name="rua" value="<?php echo $result->rua; ?>" tabindex="20" placeholder="Nome da rua ou logradouro" aria-label="Campo para nome da rua" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="numero" class="control-label">Número</label>
                                    <div class="controls">
                                        <input id="numero" type="text" name="numero" value="<?php echo $result->numero; ?>" tabindex="21" placeholder="Número do endereço" aria-label="Campo para número do endereço" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="complemento" class="control-label">Complemento</label>
                                    <div class="controls">
                                        <input id="complemento" type="text" name="complemento" value="<?php echo $result->complemento; ?>" tabindex="22" placeholder="Apartamento, bloco, etc." aria-label="Campo para complemento do endereço" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="bairro" class="control-label">Bairro</label>
                                    <div class="controls">
                                        <input id="bairro" type="text" name="bairro" value="<?php echo $result->bairro; ?>" tabindex="23" placeholder="Nome do bairro" aria-label="Campo para nome do bairro" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="cidade" class="control-label">Cidade</label>
                                    <div class="controls">
                                        <input type="text" id="cidade" name="cidade" value="<?php echo $result->cidade; ?>" placeholder="Selecione um estado primeiro..." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="estado" class="control-label">Estado</label>
                                    <div class="controls">
                                        <select id="estado" name="estado" tabindex="25" aria-label="Seleção de estado" title="Estado. Opcional."></select>
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="atividade_principal" class="control-label">Atividade Principal</label>
                                    <div class="controls">
                                        <input id="atividade_principal" type="text" name="atividade_principal" value="<?php echo $result->atividade_principal; ?>" tabindex="26" placeholder="Descrição da atividade principal" aria-label="Campo para atividade principal da empresa" title="Atividade principal. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="cnae" class="control-label">CNAE</label>
                                    <div class="controls">
                                        <input id="cnae" type="text" name="cnae" value="<?php echo $result->cnae; ?>" tabindex="27" placeholder="99.99-9-99" aria-label="Campo para código CNAE" maxlength="11" title="Código CNAE (formato: 99.99-9-99). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="atividades_secundarias" class="control-label">Atividades Secundárias</label>
                                    <div class="controls">
                                        <textarea id="atividades_secundarias" name="atividades_secundarias" rows="2" tabindex="28" placeholder="Liste as atividades secundárias" aria-label="Campo para atividades secundárias da empresa"><?php echo $result->atividades_secundarias; ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="situacao" class="control-label">Situação</label>
                                    <div class="controls">
                                        <input id="situacao" type="text" name="situacao" value="<?php echo $result->situacao; ?>" tabindex="29" placeholder="Situação atual da empresa" aria-label="Campo para situação da empresa" />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="data_situacao" class="control-label">Data Situação</label>
                                    <div class="controls">
                                        <input id="data_situacao" type="text" name="data_situacao" value="<?php echo (!empty($result->data_situacao) && $result->data_situacao != '0000-00-00') ? date('d/m/Y', strtotime($result->data_situacao)) : ''; ?>" tabindex="30" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação" title="Data da situação (DD/MM/AAAA). Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="motivo_situacao" class="control-label">Motivo Situação</label>
                                    <div class="controls">
                                        <input id="motivo_situacao" type="text" name="motivo_situacao" value="<?php echo $result->motivo_situacao; ?>" tabindex="31" placeholder="Motivo da situação atual" aria-label="Campo para motivo da situação" />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="situacao_especial" class="control-label">Situação Especial</label>
                                    <div class="controls">
                                        <input id="situacao_especial" type="text" name="situacao_especial" value="<?php echo $result->situacao_especial; ?>" tabindex="32" placeholder="Situação especial, se aplicável" aria-label="Campo para situação especial" />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="data_situacao_especial" class="control-label">Data Situação Especial</label>
                                    <div class="controls">
                                        <input id="data_situacao_especial" type="text" name="data_situacao_especial" value="<?php echo (!empty($result->data_situacao_especial) && $result->data_situacao_especial != '0000-00-00') ? date('d/m/Y', strtotime($result->data_situacao_especial)) : ''; ?>" tabindex="33" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação especial" title="Data da situação especial. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="capital_social" class="control-label">Capital Social</label>
                                    <div class="controls">
                                        <input id="capital_social" type="text" name="capital_social" value="<?php echo $result->capital_social; ?>" tabindex="34" placeholder="Valor do capital social" aria-label="Campo para capital social da empresa" />
                                    </div>
                                </div>

                                <div class="control-group campos-pessoa-juridica">
                                    <label for="qsa" class="control-label">QSA (Sócios)</label>
                                    <div class="controls">
                                        <textarea id="qsa" name="qsa" rows="2" tabindex="35" placeholder="Lista dos sócios da empresa" aria-label="Campo para lista de sócios (QSA)" title="Lista de sócios (QSA). Opcional."><?php echo $result->qsa; ?></textarea>
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
                            <div class="alert alert-info" id="msg-sem-contatos" style="display: none;">
                                <i class="fas fa-info-circle"></i> <strong>Nenhum contato cadastrado ainda.</strong> Clique no botão abaixo para adicionar.
                            </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-contatos" style="display: none; margin-bottom: 15px;">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Celular</th>
                                        <th>Cargo</th>
                                        <th>Data Cadastro</th>
                                        <th style="width: 10%;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-contatos">
                                </tbody>
                            </table>
                        </div>

                        <!-- Formulário Inline Expandível para Adicionar/Editar Contato -->
                        <div id="form-contato-inline" class="panel panel-default" style="display: none; margin-bottom: 15px;">
                            <div class="panel-heading" style="background-color: #f5f5f5; padding: 15px; border-radius: 4px;">
                                <h4 id="form-contato-titulo" style="margin: 0; font-weight: bold;">Adicionar Contato</h4>
                            </div>
                            <div class="panel-body" style="padding: 15px;">
                                <div id="form-contato-erros" class="alert alert-danger" style="display: none;"></div>

                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="inline-nome" class="control-label">Nome <span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="inline-nome" maxlength="255" placeholder="Nome do contato">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                                <label class="control-label">Email <button type="button" id="add-inline-email" class="btn btn-mini btn-success" style="padding: 0 5px;"><i class="fas fa-plus"></i></button></label>
                                                <div class="controls" id="container-inline-email">
                                                    <div class="input-append linha-email" style="margin-bottom: 5px; display: block;">
                                                        <input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com">
                                                        <button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                                <label class="control-label">Telefone <button type="button" id="add-inline-telefone" class="btn btn-mini btn-success" style="padding: 0 5px;"><i class="fas fa-plus"></i></button></label>
                                                <div class="controls" id="container-inline-telefone">
                                                    <div class="input-append linha-telefone" style="margin-bottom: 5px; display: block;">
                                                        <input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000">
                                                        <button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div class="control-group">
                                                <label class="control-label">Celular <button type="button" id="add-inline-celular" class="btn btn-mini btn-success" style="padding: 0 5px;"><i class="fas fa-plus"></i></button></label>
                                                <div class="controls" id="container-inline-celular">
                                                    <div class="input-append linha-celular" style="margin-bottom: 5px; display: block;">
                                                        <input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000">
                                                        <button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="inline-cargo" class="control-label">Cargo</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="inline-cargo" maxlength="100" placeholder="Cargo ou função">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="inline-observacoes" class="control-label">Observações</label>
                                            <div class="controls">
                                                <textarea class="form-control" id="inline-observacoes" rows="2" maxlength="500" placeholder="Observações adicionais"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions" style="margin-top: 15px; text-align: right;">
                                    <button type="button" class="btn btn-secondary" id="btn-cancelar-contato">
                                        <i class="fas fa-times"></i> Cancelar
                                    </button>
                                    <button type="button" class="btn btn-primary" id="btn-save-contato" style="margin-left: 5px;">
                                        <i class="fas fa-save"></i> Salvar Contato
                                    </button>
                                </div>

                                <input type="hidden" id="inline-index" value="">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" id="btn-add-contato">
                                <i class="fas fa-plus"></i> Adicionar Contato
                        </button>
                    </div>
                </div>

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

                        <div class="row-fluid" style="margin-bottom: 20px; background: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #eee;">
                            <div class="span12">
                                <label><strong>Vincular Novo Usuário Existente:</strong></label>
                                <div class="input-append span12">
                                    <input type="text" id="buscar_usuario_vinculo" class="span10" placeholder="Digite o nome ou e-mail de um usuário para conceder acesso">
                                    <button class="btn btn-success" type="button" id="btn-vincular-usuario"><i class="fas fa-plus"></i> Vincular</button>
                                </div>
                                <input type="hidden" id="usuario_id_vinculo">
                                <p><small class="text-muted">Pesquise por usuários que já possuem login no sistema.</small></p>
                            </div>
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
                                                    <button type="button" class="btn btn-xs btn-danger btn-remover-vinculo" 
                                                            data-id="<?php echo $u->idUsuariosClientes; ?>" 
                                                            data-nome="<?php echo $u->nome; ?>" title="Remover Acesso">
                                                        <i class="fas fa-trash"></i>
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

                <input type="hidden" name="idClientes" value="<?php echo $result->idClientes ?>" />

                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex; justify-content: center; gap: 10px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar Cliente
                            </button>
                            <a title="Voltar" class="btn btn-warning" href="<?php echo site_url('clientes') ?>">
                                <i class="fas fa-undo"></i> Voltar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modais para Confirmar Exclusão (mantido para editar cliente) -->
<!-- MODAL PARA CONFIRMAR EXCLUSÃO -->
<div class="modal fade" id="modal-delete-contato" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Confirmar Exclusão</h4>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja remover o contato <strong id="delete-contato-nome"></strong>?</p>
                <p class="text-danger"><small>Esta ação não pode ser desfeita.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn-confirm-delete">Deletar Contato</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE CARREGAMENTO -->
<div class="modal fade" id="modal-loading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center" style="padding: 30px;">
                <i class="fas fa-spinner fa-spin" style="font-size: 24px; color: #007bff;"></i>
                <p style="margin-top: 10px;">Processando...</p>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para Selecionar no Mapa -->
    <div id="modal-mapa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 800px; left: 40%;">
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
    console.log('Script editarCliente.php carregado.');

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

    $('#prospectado').on('change', function() {
        if ($(this).is(':checked')) {
            $('#group-origem').fadeIn();
        } else {
            $('#group-origem').fadeOut();
            $('#origem_prospeccao').val('');
        }
    }).trigger('change');
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
        let tbody = $('#tbody-contatos');
        tbody.empty();

        if (contatos.length === 0) {
            $('#msg-sem-contatos').show();
            $('#table-contatos').hide();
            $('#badge-contatos').text('0');
            return;
        }

        $('#msg-sem-contatos').hide();
        $('#table-contatos').show();
        $('#badge-contatos').text(contatos.length);

        let parseJsonOrArray = function(val) {
            if (!val || val === 'null') return [];
            if (Array.isArray(val)) return val;
            if (typeof val === 'string') {
                try { 
                    let parsed = JSON.parse(val); 
                    if (parsed === null) return [];
                    if (typeof parsed === 'string') {
                        try {
                            let innerParsed = JSON.parse(parsed);
                            if (Array.isArray(innerParsed)) return innerParsed;
                        } catch(e) {}
                    }
                    return Array.isArray(parsed) ? parsed : [parsed];
                } catch(e) { 
                    if (val.includes(',')) return val.split(',').map(s => s.trim()).filter(s => s !== '');
                    return [val]; 
                }
            }
            return [val];
        };

        contatos.forEach(function(contato) {
            let dataCadastro = contato.dataCadastro ? new Date(contato.dataCadastro).toLocaleDateString('pt-BR') : '-';
            
            let telefonesArray = parseJsonOrArray(contato.telefone);
            let celularesArray = parseJsonOrArray(contato.celular);
            let emailsArray = parseJsonOrArray(contato.email);
            
            let telLink = telefonesArray.map(function(tel) {
                let telClean = String(tel).replace(/[^0-9]/g, '');
                return `<a href="tel:${telClean}" title="Ligar" style="color: inherit; text-decoration: none;">${escapeHtml(String(tel))} <i class="fas fa-phone" style="margin-left: 3px;"></i></a> <a href="https://wa.me/55${telClean}" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>`;
            }).join('<br>');
            if(!telLink) telLink = '-';
            
            let celLink = celularesArray.map(function(cel) {
                let celClean = String(cel).replace(/[^0-9]/g, '');
                return `<a href="https://wa.me/55${celClean}" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;">${escapeHtml(String(cel))} <i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>`;
            }).join('<br>');
            if(!celLink) celLink = '-';

            let emailLink = emailsArray.map(function(em) {
                return `<a href="mailto:${em}" title="Enviar E-mail" style="color: inherit; text-decoration: none;">${escapeHtml(String(em))} <i class="fas fa-envelope" style="margin-left: 3px;"></i></a>`;
            }).join('<br>');
            if(!emailLink) emailLink = '-';
            
            let row = `
                <tr>
                    <td><strong>${escapeHtml(contato.nome)}</strong></td>
                    <td>${emailLink}</td>
                    <td>${telLink}</td>
                    <td>${celLink}</td>
                    <td>${escapeHtml(contato.cargo || '-')}</td>
                    <td><small>${dataCadastro}</small></td>
                    <td>
                        <button type="button" class="btn btn-xs btn-info btn-edit-contato" 
                                data-id="${contato.idContatos}" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-danger btn-delete-contato" 
                                data-id="${contato.idContatos}" data-nome="${escapeHtml(contato.nome)}" 
                                title="Deletar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Botão: Adicionar Contato (Inline)
    $('#btn-add-contato').on('click', function() {
        idContatoEmEdicao = null;
        limparModal();
        $('#form-contato-titulo').text('Adicionar Contato');
        $('#form-contato-inline').slideDown(300);
    });

    // Editar Contato
    $(document).on('click', '.btn-edit-contato', function() {
        let idContato = $(this).data('id');

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
                    $('#inline-nome').val(contato.nome);
                        
                        let parseJsonOrArray = function(val) {
                            if (!val || val === 'null') return [];
                            if (Array.isArray(val)) return val;
                            if (typeof val === 'string') {
                                try { 
                                    let parsed = JSON.parse(val); 
                                    if (parsed === null) return [];
                                    if (typeof parsed === 'string') {
                                        try {
                                            let innerParsed = JSON.parse(parsed);
                                            if (Array.isArray(innerParsed)) return innerParsed;
                                        } catch(e) {}
                                    }
                                    return Array.isArray(parsed) ? parsed : [parsed];
                                } catch(e) { 
                                    if (val.includes(',')) return val.split(',').map(s => s.trim()).filter(s => s !== '');
                                    return [val]; 
                                }
                            }
                            return [val];
                        };
                
                        let emails = parseJsonOrArray(contato.email);
                        if(emails.length > 0) {
                            $('#container-inline-email').empty();
                            emails.forEach(e => { $('#container-inline-email').append('<div class="input-append linha-email" style="margin-bottom: 5px; display: block;"><input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com" value="' + escapeHtml(String(e)) + '"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>'); });
                        }
                        let telefones = parseJsonOrArray(contato.telefone);
                        if(telefones.length > 0) {
                            $('#container-inline-telefone').empty();
                            telefones.forEach(e => { $('#container-inline-telefone').append('<div class="input-append linha-telefone" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000" value="' + escapeHtml(String(e)) + '"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>'); });
                        }
                        let celulares = parseJsonOrArray(contato.celular);
                        if(celulares.length > 0) {
                            $('#container-inline-celular').empty();
                            celulares.forEach(e => { $('#container-inline-celular').append('<div class="input-append linha-celular" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000" value="' + escapeHtml(String(e)) + '"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>'); });
                        }

                    $('#inline-cargo').val(contato.cargo);
                    $('#inline-observacoes').val(contato.observacoes);
                    $('#inline-index').val(contato.idContatos);

                    $('#form-contato-titulo').text('Editar Contato');
                    $('#form-contato-inline').slideDown(300);
                    aplicarMascaras();
                }
            }
        });
    });

    // Botão: Cancelar Contato
    $('#btn-cancelar-contato').on('click', function() {
        $('#form-contato-inline').slideUp(300);
    });

    // Salvar Contato (AJAX)
    $('#btn-save-contato').on('click', function() {
        if (validarModal()) {
                let emails = $("input[name='inline_emails[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');
                let telefones = $("input[name='inline_telefones[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');
                let celulares = $("input[name='inline_celulares[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');

            let dados = {
                idContatos: idContatoEmEdicao,
                cliente_id: CLIENTE_ID,
                nome: $('#inline-nome').val().trim(),
                    email: JSON.stringify(emails),
                    telefone: JSON.stringify(telefones),
                    celular: JSON.stringify(celulares),
                cargo: $('#inline-cargo').val().trim(),
                observacoes: $('#inline-observacoes').val().trim(),
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            };

            let url = idContatoEmEdicao ? 
                '<?php echo site_url('clientes/editarContato') ?>' : 
                '<?php echo site_url('clientes/adicionarContato') ?>';

            $('#modal-loading').modal('show');

            $.ajax({
                url: url,
                type: 'POST',
                data: dados,
                dataType: 'json',
                success: function(response) {
                    $('#modal-loading').modal('hide');

                    if (response.status === 'success') {
                        carregarContatos();
                        $('#form-contato-inline').slideUp(300);

                        let msg = idContatoEmEdicao ? 
                            'Contato atualizado com sucesso!' : 
                            'Contato adicionado com sucesso!';
                        mostrarNotificacao('success', msg);

                    } else {
                        mostrarNotificacao('error', response.message || 'Erro ao processar');
                    }
                },
                error: function() {
                    $('#modal-loading').modal('hide');
                    mostrarNotificacao('error', 'Erro ao processar requisição');
                }
            });
        }
    });

    // Deletar Contato
    $(document).on('click', '.btn-delete-contato', function() {
        let idContato = $(this).data('id');
        let nome = $(this).data('nome');

        $('#delete-contato-nome').text(nome);
        $('#btn-confirm-delete').data('id', idContato);
        $('#modal-delete-contato').modal('show');
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

    // Validar Modal
    function validarModal() {
        let erros = [];
        let nome = $('#inline-nome').val().trim();
            let emails = $("input[name='inline_emails[]']").map(function(){return $(this).val().trim();}).get().filter(e => e !== '');

        if (!nome) {
            erros.push('Nome é obrigatório.');
        }

            emails.forEach(function(email) {
                if (!isValidEmail(email)) {
                    erros.push('Email inválido: ' + email);
                }
            });

        if (erros.length > 0) {
            let html = '<strong>Erros:</strong><ul><li>' + 
                      erros.join('</li><li>') + '</li></ul>';
            $('#form-contato-erros').html(html).show();
            return false;
        }

        $('#form-contato-erros').hide();
        return true;
    }

    // Verificar Email Válido
    function isValidEmail(email) {
        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Limpar Modal
    function limparModal() {
            $('#inline-nome').val('');
            $('#container-inline-email').html('<div class="input-append linha-email" style="margin-bottom: 5px; display: block;"><input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
            $('#container-inline-telefone').html('<div class="input-append linha-telefone" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
            $('#container-inline-celular').html('<div class="input-append linha-celular" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
            $('#inline-cargo').val('');
            $('#inline-observacoes').val('');
        $('#form-contato-erros').hide();
        idContatoEmEdicao = null;
            aplicarMascaras();
    }

        // Adicionar/Remover campos dinâmicos
        $('#add-inline-email').click(function() {
            $('#container-inline-email').append('<div class="input-append linha-email" style="margin-bottom: 5px; display: block;"><input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
        });
        $('#add-inline-telefone').click(function() {
            $('#container-inline-telefone').append('<div class="input-append linha-telefone" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
            $('.mascara-telefone').mask("(00) 0000-0000");
        });
        $('#add-inline-celular').click(function() {
            $('#container-inline-celular').append('<div class="input-append linha-celular" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
            $('.mascara-celular').mask("(00) 00000-0000");
        });
        $(document).on('click', '.remover-campo', function() {
            var container = $(this).closest('.controls');
            if (container.children('.input-append').length > 1) {
                $(this).closest('.input-append').remove();
            } else {
                $(this).siblings('input').val('');
            }
        });

    // Escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/&/g, "&amp;")
                  .replace(/</g, "&lt;")
                  .replace(/>/g, "&gt;")
                  .replace(/"/g, "&quot;")
                  .replace(/'/g, "&#039;");
    }

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
        // Campo telefone agora aceita números de celular (9 dígitos)
        $('#telefone').mask("(00) 00000-0000");
        $('#celular').mask("(00) 00000-0000");
        $('#cep').mask("00000-000");
        $('#cnae').mask("00.00-0-00");
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

    // Carregar Cidades com Select2 AJAX
    $('#estado').on('change', function() {
        const uf = $(this).val();
        const cidadeInput = $('#cidade');

        // Reseta e desabilita o campo de cidade
        cidadeInput.val(null).trigger('change').prop('disabled', true);
        $('#codigo_ibge').val('');

        if (uf) {
            // Habilita o campo e inicializa o Select2
            cidadeInput.prop('disabled', false).select2({
                placeholder: 'Digite para buscar uma cidade...',
                minimumInputLength: 2,
                ajax: {
                    url: `<?php echo base_url('ibge/search_cities'); ?>/${uf}`,
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
                cidadeInput.append(option).trigger('change');
                curCity = ''; // Limpa para não interferir em seleções futuras
            }

        } else {
            // Se nenhum estado for selecionado, mantém desabilitado
            cidadeInput.select2('destroy').prop('disabled', true).val('');
        }
    });

    // Quando uma cidade é selecionada, busca o código IBGE
    $('#cidade').on('select2:select', function(e) {
        const cityName = e.params.data.id;
        const uf = $('#estado').val();

        if (uf && cityName) {
            // Busca na lista completa de cidades do estado para encontrar o IBGE
            $.getJSON(`<?php echo base_url('ibge/cidades'); ?>/${uf}`, function(data) {
                const cityData = data.find(city => city.nome === cityName);
                if (cityData) {
                    $('#codigo_ibge').val(cityData.id);
                }
            });
        }
    });

    // Inicializa o Select2 para o campo de estado
    $('#estado').select2();

    // Gatilhos de Geocodificação
    $('#rua, #numero, #bairro').on('blur', function() {
        geocodeClient();
    });

    $(document).on('change', '#cidade', function() {
        let ibge = $(this).find('option:selected').data('ibge');
        $('#codigo_ibge').val(ibge || '');
        geocodeClient();
    });

    // Monitora o botão de busca de CNPJ para sincronizar endereço
    $('#buscar_info_cnpj').on('click', function() {
        let checkExist = setInterval(function() {
            let rua = $('#rua').val();
            if (rua && rua !== "...") {
                console.log('Busca de CNPJ finalizada (Edição), sincronizando localidade...');
                clearInterval(checkExist);
                
                // Armazena a cidade e dispara carregamento do IBGE
                curCity = $('#cidade').val();
                let uf = $('#estado').val();
                if (uf) {
                    $('#estado').trigger('change');
                }
            }
        }, 500);
        // Timeout de segurança após 10 segundos
        setTimeout(function() { clearInterval(checkExist); }, 10000);
    });

    // Desvincula o comportamento padrão do CEP e define um customizado
    $('#cep').off('blur').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "" && /^[0-9]{8}$/.test(cep)) {
            console.log('Iniciando busca de CEP customizada (Edição)...');
            
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#estado").val("");

            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    console.log('Dados do CEP recebidos (Edição):', dados);
                    
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    
                    // Armazena a cidade para ser selecionada quando o IBGE carregar
                    curCity = dados.localidade;
                    
                    // Dispara o carregamento das cidades do IBGE
                    $("#estado").val(dados.uf).trigger('change');
                    
                    // Se o estado já era o mesmo, o trigger('change') não fará nada, então forçamos geocode
                    if ($('#estado').val() == dados.uf) {
                        setTimeout(geocodeClient, 500);
                    }
                } else {
                    console.log('CEP não encontrado (Edição).');
                    $("#rua, #bairro").val("");
                    $("#estado").val("").trigger('change');
                }
            });
        }
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
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
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
    $("#documento").focus();

    // Geocodificação e Mapa
    var mapSelector;
    var markerSelector;

    function geocodeClient() {
        var rua = $('#rua').val();
        var numero = $('#numero').val();
        var bairro = $('#bairro').val();
        var cidade = $('#cidade').val();
        var estado = $('#estado').val();

        console.log('Iniciando geocodificação (Edição):', {rua, numero, bairro, cidade, estado});

        if (rua === "..." || cidade === "...") {
            console.log('Aguardando preenchimento do ViaCEP...');
            return;
        }

        if (rua && cidade && estado) {
            var queries = [
                `${rua}, ${numero}, ${bairro}, ${cidade}, ${estado}, Brasil`,
                `${rua}, ${numero}, ${cidade}, ${estado}, Brasil`,
                `${rua}, ${cidade}, ${estado}, Brasil`,
                `${cidade}, ${estado}, Brasil`
            ];

            function tryQuery(index) {
                if (index >= queries.length) {
                    console.log('Fim das tentativas: Nenhuma query retornou resultados.');
                    return;
                }

                var q = queries[index];
                console.log(`Tentativa ${index + 1}: ${q}`);

                $.getJSON(`https://photon.komoot.io/api/?q=${encodeURIComponent(q)}&limit=1`)
                    .done(function(data) {
                        if (data && data.features && data.features.length > 0) {
                            var coords = data.features[0].geometry.coordinates;
                            console.log('Encontrado via Photon:', coords);
                            fillCoords(coords[1], coords[0]);
                        } else {
                            console.log('Photon falhou, tentando Nominatim...');
                            $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&limit=1`)
                                .done(function(data) {
                                    if (data && data.length > 0) {
                                        console.log('Encontrado via Nominatim:', data[0]);
                                        fillCoords(data[0].lat, data[0].lon);
                                    } else {
                                        tryQuery(index + 1);
                                    }
                                })
                                .fail(function() { tryQuery(index + 1); });
                        }
                    })
                    .fail(function() { tryQuery(index + 1); });
            }
            tryQuery(0);
        } else {
            console.log('Dados insuficientes para geocodificação.');
        }
    }

    function fillCoords(lat, lon) {
        $('#latitude').val(parseFloat(lat).toFixed(8));
        $('#longitude').val(parseFloat(lon).toFixed(8));
        
        if (markerSelector) {
            markerSelector.setLatLng([lat, lon]);
            if (mapSelector) mapSelector.setView([lat, lon], 15);
        }
    }

    $('#btn-geocodificar').click(function() {
        geocodeClient();
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
