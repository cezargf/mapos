<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
<style>
    .ui-autocomplete {
        z-index: 9999 !important;
    }
    #imgSenha {
        z-index: 9999 !important;
    }
    #imgSenha {
        width: 18px;
        cursor: pointer;
    }

    .badgebox {
        opacity: 0;
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
        padding: 15px;
    }

    .accordion-body.in {
        display: block;
    }

    #msg-sem-contatos {
        margin-bottom: 15px;
    }

    #table-contatos {
        margin-bottom: 15px;
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
                    <i class="fas fa-user-plus"></i>
                </span>
                <h5>Cadastro de Cliente</h5>
            </div>
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            } ?>
            <form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal">
                <div class="widget-content nopadding">

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
                                        <input id="documento" class="cpfcnpj" type="text" name="documento" value="<?php echo set_value('documento'); ?>" tabindex="1" placeholder="Digite o CPF ou CNPJ" aria-label="Campo para CPF ou CNPJ" title="CPF/CNPJ: Opcional, mas se preenchido deve ser válido." />
                                        <button id="buscar_info_cnpj" class="btn btn-xs" type="button" tabindex="2" aria-label="Botão para buscar informações do CNPJ">Buscar(CNPJ)</button>
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="ie" class="control-label">Inscrição Estadual (IE)</label>
                                    <div class="controls">
                                        <input id="ie" type="text" name="ie" value="<?php echo set_value('ie'); ?>" tabindex="3" placeholder="Digite a Inscrição Estadual" aria-label="Campo para Inscrição Estadual" title="IE: Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="im" class="control-label">Inscrição Municipal (IM)</label>
                                    <div class="controls">
                                        <input id="im" type="text" name="im" value="<?php echo set_value('im'); ?>" tabindex="4" placeholder="Digite a Inscrição Municipal" aria-label="Campo para Inscrição Municipal" title="IM: Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="fantasia" class="control-label">Nome Fantasia</label>
                                    <div class="controls">
                                        <input id="fantasia" type="text" name="fantasia" value="<?php echo set_value('fantasia'); ?>" tabindex="5" placeholder="Digite o nome fantasia da empresa" aria-label="Campo para nome fantasia da empresa" title="Nome fantasia. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="tipo" class="control-label">Tipo</label>
                                    <div class="controls">
                                        <input id="tipo" type="text" name="tipo" value="<?php echo set_value('tipo'); ?>" tabindex="6" placeholder="Ex: MATRIZ ou FILIAL" aria-label="Campo para tipo da empresa" title="Tipo (MATRIZ/FILIAL). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="porte" class="control-label">Porte</label>
                                    <div class="controls">
                                        <input id="porte" type="text" name="porte" value="<?php echo set_value('porte'); ?>" tabindex="7" placeholder="Ex: micro, pequena, média" aria-label="Campo para porte da empresa" title="Porte da empresa (micro, pequena, média). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="natureza_juridica" class="control-label">Natureza Jurídica</label>
                                    <div class="controls">
                                        <input id="natureza_juridica" type="text" name="natureza_juridica" value="<?php echo set_value('natureza_juridica'); ?>" tabindex="8" placeholder="Digite a natureza jurídica" aria-label="Campo para natureza jurídica da empresa" title="Natureza jurídica. Opcional." />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="nomeCliente" class="control-label">Nome/Razão Social<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="nomeCliente" type="text" name="nomeCliente" value="<?php echo set_value('nomeCliente'); ?>" tabindex="9" placeholder="Digite o nome completo ou razão social" aria-label="Campo obrigatório para nome ou razão social" aria-required="true" title="Campo obrigatório." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-fisica">
                                    <label for="sexo" class="control-label">Sexo</label>
                                    <div class="controls">
                                        <select id="sexo" name="sexo" tabindex="10" aria-label="Seleção de sexo" title="Sexo. Opcional.">
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
                                        <input id="nascimento" type="date" name="nascimento" value="<?php echo set_value('nascimento'); ?>" tabindex="11" placeholder="Selecione a data de nascimento" aria-label="Campo para data de nascimento" title="Data de nascimento (DD/MM/AAAA). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-fisica">
                                    <label for="tratamento" class="control-label">Tratamento</label>
                                    <div class="controls">
                                        <select id="tratamento" name="tratamento" tabindex="12" aria-label="Seleção de forma de tratamento" title="Forma de tratamento. Opcional.">
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
                                        <input class="contato" type="text" name="contato" value="<?php echo set_value('contato'); ?>" tabindex="13" placeholder="Nome da pessoa de contato" aria-label="Campo para nome da pessoa de contato" title="Nome da pessoa de contato. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Telefone</label>
                                    <div class="controls">
                                        <input id="telefone" type="text" name="telefone" value="<?php echo set_value('telefone'); ?>" tabindex="14" placeholder="(11) 99999-9999" aria-label="Campo para telefone fixo" title="Telefone (fixo ou celular). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="celular" class="control-label">Celular</label>
                                    <div class="controls">
                                        <input id="celular" type="text" name="celular" value="<?php echo set_value('celular'); ?>" tabindex="15" placeholder="(11) 99999-9999" aria-label="Campo para celular" title="Celular. Opcional." />
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
                                        <input id="email" type="email" name="email" value="<?php echo set_value('email'); ?>" tabindex="16" placeholder="exemplo@email.com" aria-label="Campo para endereço de email" autocomplete="off" title="Email obrigatório para o acesso do cliente." required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="senha" class="control-label">Senha</label>
                                    <div class="controls">
                                        <input class="form-control" id="senha" type="password" name="senha" autocomplete="new-password" value="<?php echo set_value('senha'); ?>" tabindex="17" placeholder="Digite uma senha segura" aria-label="Campo para senha de acesso" title="Senha. Opcional para clientes." />
                                        <img id="imgSenha" src="<?php echo base_url() ?>assets/img/eye.svg" alt="" style="cursor: pointer; margin-top: 5px;" aria-label="Botão para mostrar/ocultar senha">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Status de Prospecção</label>
                                    <div class="controls">
                                        <label for="prospectado" class="btn btn-default" tabindex="18">
                                            Prospectado
                                            <input type="checkbox" id="prospectado" name="prospectado" class="badgebox" value="1" <?php echo set_checkbox('prospectado', '1'); ?>>
                                            <span class="badge">&check;</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="control-group" id="group-origem" style="display: none;">
                                    <label for="origem_prospeccao" class="control-label">Origem da Prospecção</label>
                                    <div class="controls">
                                        <select name="origem_prospeccao" id="origem_prospeccao" class="span11">
                                            <option value="">Selecione...</option>
                                            <option value="Receita Federal" <?php echo set_select('origem_prospeccao', 'Receita Federal'); ?>>Receita Federal (BigQuery)</option>
                                            <option value="CNO" <?php echo set_select('origem_prospeccao', 'CNO'); ?>>CNO (BigQuery)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tipo de Cliente</label>
                                    <div class="controls">
                                        <label for="fornecedor" class="btn btn-default" tabindex="18" aria-label="Checkbox para marcar se também é fornecedor">
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
                                        <input id="cep" type="text" name="cep" value="<?php echo set_value('cep'); ?>" tabindex="19" placeholder="00000-000" aria-label="Campo para CEP" title="CEP. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="codigo_ibge" class="control-label">Código IBGE</label>
                                    <div class="controls">
                                        <input id="codigo_ibge" type="text" name="codigo_ibge" value="<?php echo set_value('codigo_ibge'); ?>" tabindex="19" placeholder="Preenchimento automático" readonly required />
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
                                        <div style="margin-top: 5px;">
                                            <button type="button" id="btn-geocodificar" class="btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço"><i class='bx bx-search'></i> Buscar Coordenadas</button>
                                            <button type="button" id="btn-selecionar-mapa" class="btn btn-mini btn-inverse" title="Selecionar local manualmente no mapa"><i class='bx bx-map'></i> Selecionar no Mapa</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="rua" class="control-label">Rua</label>
                                    <div class="controls">
                                        <input id="rua" type="text" name="rua" value="<?php echo set_value('rua'); ?>" tabindex="20" placeholder="Nome da rua ou logradouro" aria-label="Campo para nome da rua" title="Rua. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="numero" class="control-label">Número</label>
                                    <div class="controls">
                                        <input id="numero" type="text" name="numero" value="<?php echo set_value('numero'); ?>" tabindex="21" placeholder="Número do endereço" aria-label="Campo para número do endereço" title="Número. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="complemento" class="control-label">Complemento</label>
                                    <div class="controls">
                                        <input id="complemento" type="text" name="complemento" value="<?php echo set_value('complemento'); ?>" tabindex="22" placeholder="Apartamento, bloco, etc." aria-label="Campo para complemento do endereço" title="Complemento. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="bairro" class="control-label">Bairro</label>
                                    <div class="controls">
                                        <input id="bairro" type="text" name="bairro" value="<?php echo set_value('bairro'); ?>" tabindex="23" placeholder="Nome do bairro" aria-label="Campo para nome do bairro" title="Bairro. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="cidade" class="control-label">Cidade</label>
                                    <div class="controls">
                                        <input type="text" id="cidade" name="cidade" value="<?php echo set_value('cidade'); ?>" disabled placeholder="Selecione um estado primeiro..." />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="estado" class="control-label">Estado</label>
                                    <div class="controls">
                                        <select id="estado" name="estado" tabindex="25" aria-label="Seleção de estado" title="Estado. Opcional.">
                                            <option value="">Selecione...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="atividade_principal" class="control-label">Atividade Principal</label>
                                    <div class="controls">
                                        <input id="atividade_principal" type="text" name="atividade_principal" value="<?php echo set_value('atividade_principal'); ?>" tabindex="26" placeholder="Descrição da atividade principal" aria-label="Campo para atividade principal da empresa" title="Atividade principal. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="cnae" class="control-label">CNAE</label>
                                    <div class="controls">
                                        <input id="cnae" type="text" name="cnae" value="<?php echo set_value('cnae'); ?>" tabindex="27" placeholder="99.99-9-99" aria-label="Campo para código CNAE" maxlength="11" title="Código CNAE (formato: 99.99-9-99). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="atividades_secundarias" class="control-label">Atividades Secundárias</label>
                                    <div class="controls">
                                        <textarea id="atividades_secundarias" name="atividades_secundarias" rows="2" tabindex="28" placeholder="Liste as atividades secundárias" aria-label="Campo para atividades secundárias da empresa" title="Atividades secundárias. Opcional."><?php echo set_value('atividades_secundarias'); ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="situacao" class="control-label">Situação</label>
                                    <div class="controls">
                                        <input id="situacao" type="text" name="situacao" value="<?php echo set_value('situacao'); ?>" tabindex="29" placeholder="Situação atual da empresa" aria-label="Campo para situação da empresa" title="Situação. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="data_situacao" class="control-label">Data Situação</label>
                                    <div class="controls">
                                        <input id="data_situacao" type="text" name="data_situacao" value="<?php echo set_value('data_situacao'); ?>" tabindex="30" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação" title="Data da situação (DD/MM/AAAA). Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="motivo_situacao" class="control-label">Motivo Situação</label>
                                    <div class="controls">
                                        <input id="motivo_situacao" type="text" name="motivo_situacao" value="<?php echo set_value('motivo_situacao'); ?>" tabindex="31" placeholder="Motivo da situação atual" aria-label="Campo para motivo da situação" title="Motivo da situação. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="situacao_especial" class="control-label">Situação Especial</label>
                                    <div class="controls">
                                        <input id="situacao_especial" type="text" name="situacao_especial" value="<?php echo set_value('situacao_especial'); ?>" tabindex="32" placeholder="Situação especial, se aplicável" aria-label="Campo para situação especial" title="Situação especial. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="data_situacao_especial" class="control-label">Data Situação Especial</label>
                                    <div class="controls">
                                        <input id="data_situacao_especial" type="text" name="data_situacao_especial" value="<?php echo set_value('data_situacao_especial'); ?>" tabindex="33" placeholder="DD/MM/AAAA" aria-label="Campo para data da situação especial" title="Data da situação especial. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="capital_social" class="control-label">Capital Social</label>
                                    <div class="controls">
                                        <input id="capital_social" type="text" name="capital_social" value="<?php echo set_value('capital_social'); ?>" tabindex="34" placeholder="Valor do capital social" aria-label="Campo para capital social da empresa" title="Capital social. Opcional." />
                                    </div>
                                </div>
                                <div class="control-group campos-pessoa-juridica">
                                    <label for="qsa" class="control-label">QSA (Socios)</label>
                                    <div class="controls">
                                        <textarea id="qsa" name="qsa" rows="2" tabindex="35" placeholder="Lista dos sócios da empresa" aria-label="Campo para lista de sócios (QSA)" title="Lista de sócios (QSA). Opcional."><?php echo set_value('qsa'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============= ACCORDION: CONTATOS DO CLIENTE ============= -->
                    <div class="accordion-group" id="accordion-contatos">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-contatos', this)">
                                <i class="fas fa-chevron-right"></i> <strong>CONTATOS DO CLIENTE <span class="badge badge-info" id="count-contatos">0</span></strong>
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
                                    <tbody id="tbody-contatos">
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" name="contatos_json" id="contatos-json" value="">

                            <!-- Formulário Inline Expandível para Adicionar/Editar Contto -->
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

                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display:flex;justify-content: center">
                            <button type="submit" class="button btn btn-mini btn-success"><span class="button__icon"><i class='bx bx-save'></i></span> <span class="button__text2">Salvar Cliente e Contatos</span></button>
                            <a title="Voltar" class="button btn btn-warning" href="<?php echo site_url() ?>/clientes"><span class="button__icon"><i class="bx bx-undo"></i></span> <span class="button__text2">Voltar</span></a>
                        </div>
                    </div>
                </div>
            </form>
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
    console.log('Script adicionarCliente.php carregado.');
    
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

    // Máscaras
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

    $('#cidade').on('change', function() {
        let ibge = $(this).find('option:selected').data('ibge');
        $('#codigo_ibge').val(ibge || '');
        geocodeClient();
    });

    // Monitora o botão de busca de CNPJ para sincronizar endereço
    $('#buscar_info_cnpj').on('click', function() {
        var selectCidade = $('#cidade');
        var inputCidade = $('<input type="text" id="cidade" name="cidade" style="display:none;">');
        selectCidade.after(inputCidade);
        selectCidade.hide();

        let checkExist = setInterval(function() {
            let rua = $('#rua').val();
            if (rua && rua !== "..." && $('#cidade').is('input')) {
                console.log('Busca de CNPJ finalizada, sincronizando localidade...');
                clearInterval(checkExist);
                
                curCity = inputCidade.val();
                inputCidade.remove();
                selectCidade.show();

                let uf = $('#estado').val();
                if (uf) {
                    $('#estado').trigger('change');
                }
            }
        }, 500);
        // Timeout de segurança após 10 segundos
        setTimeout(function() { 
            clearInterval(checkExist); 
            if($('#cidade').is('input')) {
                inputCidade.remove();
                selectCidade.show();
            }
        }, 10000);
    });

    // Desvincula o comportamento padrão do CEP e define um customizado
    $('#cep').off('blur').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "" && /^[0-9]{8}$/.test(cep)) {
            console.log('Iniciando busca de CEP customizada...');
            
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#estado").val("");
            $('#cidade').empty().append('<option value="">Carregando...</option>');
            $('#codigo_ibge').val('');

            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    console.log('Dados do CEP recebidos:', dados);
                    
                    $("#rua").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    
                    // Armazena a cidade para ser selecionada quando o IBGE carregar
                    curCity = dados.localidade;
                    
                    // Dispara o carregamento das cidades do IBGE
                    if ($('#estado').val() !== dados.uf) {
                        $("#estado").val(dados.uf).trigger('change');
                    } else {
                        $("#estado").trigger('change');
                    }
                } else {
                    console.log('CEP não encontrado.');
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

    // Validação formulário principal
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
        },
        submitHandler: function(form) {
            // Serializa contatos para JSON
            if (contatos.length > 0) {
                $('#contatos-json').val(JSON.stringify(contatos));
            }
            form.submit();
        }
    });

    // Botão: Adicionar Contato
    $('#btn-add-contato').on('click', function() {
        indexEdicao = null;
        limparFormularioInline();
        $('#form-contato-titulo').text('Adicionar Contato');
        $('#form-contato-inline').slideDown(300);
        $('#inline-nome').focus();
    });

    // Botão: Cancelar Contato
    $('#btn-cancelar-contato').on('click', function() {
        $('#form-contato-inline').slideUp(300);
        limparFormularioInline();
    });

    // Botão: Salvar Contato (Inline)
    $('#btn-save-contato').on('click', function() {
        if (validarContatoInline()) {
            let emails = $("input[name='inline_emails[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');
            let telefones = $("input[name='inline_telefones[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');
            let celulares = $("input[name='inline_celulares[]']").map(function(){return $(this).val();}).get().filter(e => e.trim() !== '');

            let contato = {
                nome: $('#inline-nome').val(),
                email: JSON.stringify(emails),
                telefone: JSON.stringify(telefones),
                celular: JSON.stringify(celulares),
                cargo: $('#inline-cargo').val(),
                observacoes: $('#inline-observacoes').val()
            };

            if (indexEdicao !== null) {
                contatos[indexEdicao] = contato;
            } else {
                contatos.push(contato);
            }

            atualizarTabelaContatos();
            $('#form-contato-inline').slideUp(300);
            limparFormularioInline();
        }
    });

    // Validar contato inline
    function validarContatoInline() {
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

        for (let i = 0; i < contatos.length; i++) {
            if (i !== indexEdicao && contatos[i].nome.toLowerCase() === nome.toLowerCase()) {
                erros.push('Já existe um contato com este nome.');
                break;
            }
        }

        if (erros.length > 0) {
            $('#form-contato-erros').html('<strong>Erros:</strong><ul><li>' + 
                                  erros.join('</li><li>') + '</li></ul>')
                            .show();
            return false;
        }

        $('#form-contato-erros').hide();
        return true;
    }

    // Validar email
    function isValidEmail(email) {
        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Atualizar tabela de contatos
    function atualizarTabelaContatos() {
        let tbody = $('#tbody-contatos');
        tbody.empty();

        if (contatos.length === 0) {
            $('#table-contatos').hide();
            $('#msg-sem-contatos').show();
            $('#count-contatos').text('0');
            return;
        }

        $('#table-contatos').show();
        $('#msg-sem-contatos').hide();
        $('#count-contatos').text(contatos.length);

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

        contatos.forEach(function(contato, index) {
            
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
                    <td>
                        <button type="button" class="btn btn-xs btn-info btn-edit-contato" 
                                data-index="${index}" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-xs btn-danger btn-delete-contato" 
                                data-index="${index}" title="Deletar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Editar contato
    $(document).on('click', '.btn-edit-contato', function() {
        indexEdicao = parseInt($(this).data('index'));
        let contato = contatos[indexEdicao];

        limparFormularioInline();
        
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

        $('#form-contato-titulo').text('Editar Contato');
        $('#form-contato-inline').slideDown(300);
        $('#inline-nome').focus();
        aplicarMascaras();
    });

    // Deletar contato
    $(document).on('click', '.btn-delete-contato', function() {
        let index = parseInt($(this).data('index'));

        if (confirm('Tem certeza que deseja remover este contato?')) {
            contatos.splice(index, 1);
            atualizarTabelaContatos();
        }
    });

    // Limpar formulário inline
    function limparFormularioInline() {
        $('#inline-nome').val('');
        $('#container-inline-email').html('<div class="input-append linha-email" style="margin-bottom: 5px; display: block;"><input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
        $('#container-inline-telefone').html('<div class="input-append linha-telefone" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
        $('#container-inline-celular').html('<div class="input-append linha-celular" style="margin-bottom: 5px; display: block;"><input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000"><button type="button" class="btn btn-danger remover-campo"><i class="fas fa-trash"></i></button></div>');
        $('#inline-cargo').val('');
        $('#inline-observacoes').val('');
        $('#inline-index').val('');
        $('#form-contato-erros').hide();
        indexEdicao = null;
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

        console.log('Iniciando geocodificação:', {rua, numero, bairro, cidade, estado});

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
