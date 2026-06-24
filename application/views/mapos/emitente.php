<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    /* --- General Modal & Form Styles --- */
    .modal {
        overflow-y: auto !important;
        max-height: 90vh !important;
        top: 2.5% !important;
    }
    .modal-body {
        max-height: calc(90vh - 160px);
        overflow-y: auto !important;
        padding: 20px;
    }
    .form-horizontal .control-group {
        display: flex;
        align-items: flex-start;
    }
    .form-horizontal .control-label {
        width: 180px;
        text-align: right;
        padding-right: 20px;
    }
    .form-horizontal .controls {
        display: inline-flex;
        flex: 1;
        max-width: 100%;
        margin-left: 0;
        margin-right: 20px;
    }
    .form-horizontal .controls input,
    .form-horizontal .controls select,
    .form-horizontal .controls .select2-container--default,
    .form-horizontal .controls textarea {
        max-width: none;
        width: 100% !important;
    }
    .modal-body .required {
        color: red;
        margin-left: 5px;
    }
    h5 {
        padding-bottom: 15px;
        font-size: 1.5em;
        font-weight: 500;
        line-height: 1.5;
    }
    .widget-content {
        padding: 0 16px 15px;
    }

    /* --- Fieldset Grouping --- */
    fieldset.form-section {
        border: 1px solid #e5e5e5;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }
    fieldset.form-section legend {
        font-size: 1.1em;
        font-weight: 600;
        padding: 0 10px;
        width: auto;
        border-bottom: none;
        margin-bottom: 0px; /* Reduced margin */
    }
    legend + .control-group {
        margin-top: -10px !important; /* Added to remove space */
    }

    /* --- Font-Size Standardization --- */
    .form-horizontal .controls select,
    .select2-container--default,
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-results__option {
        font-size: 14px !important;
    }
    .select2-container--default {
        height: 30px;
    }
    .select2-container--default .select2-selection--single {
        height: auto;
    }
    .select2-search__field {
        height: 28px !important;
    }

    /* --- CNPJ/Document Field --- */
    .control-group.documento-group .controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .cnpjEmitente {
        flex: 1;
    }
    .btn-consultar-cnpj {
        position: relative;
        margin: 0 0 0 8px !important;
    }

    /* --- Geo Group --- */
    .control-group.geo-group {
        display: block;
    }
    .control-group.geo-group .controls {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    
    /* --- Geo Location Buttons --- */
    .geo-buttons {
        display:flex;
        justify-content: right;
        gap: 5px;
        margin: 0 20px 0 0;
    }

    /* --- Loading State --- */
    .modal-body.loading {
        position: relative;
        pointer-events: none; /* Impede a interação */
    }
    .modal-body.loading::after {
        content: 'Buscando dados...';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    /* --- Mobile-First Responsive Styles --- */
    @media (max-width: 768px) {
        .modal-body {
            padding: 10px;
            overflow-x: hidden !important;
        }
        .form-horizontal .control-group {
            flex-direction: column;
        }
        .form-horizontal .control-group .controls {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }
        .form-horizontal .control-label {
            display: block;
            width: auto;
            text-align: left;
            margin-bottom: -6px;
        }
    }
</style>

<?php if (!isset($dados) || $dados == null) { ?>
    <div class="row-fluid" style="margin-top:0">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <h5>Dados do Emitente</h5>
                </div>
                <div class="widget-content ">
                    <div class="alert alert-danger">Nenhum dado foi cadastrado até o momento. Essas informações estarão disponíveis na tela de impressão de OS.</div>
                    <a href="#modalCadastrar" data-toggle="modal" role="button" class="button btn btn-success" style="max-width: 150px"> <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Cadastrar Dados</span></a>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCadastrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?= site_url('mapos/cadastrarEmitente'); ?>" id="formCadastrar" enctype="multipart/form-data" method="post" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 id="myModalLabel" style="text-align-last:center">Cadastrar Dados do Emitente</h5>
            </div>
            <div class="modal-body">
                <fieldset class="form-section">
                    <legend>Dados Principais</legend>
                    <div class="control-group">
                        <label for="nomeEmitente" class="control-label">Razão Social<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeEmitente" placeholder="Nome completo da empresa ou pessoa jurídica" type="text" name="nome" value="" title="Razão Social: Nome completo da empresa ou pessoa jurídica. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group documento-group">
                        <label for="documento" class="control-label">CNPJ<span class="required">*</span></label>
                        <div class="controls">
                            <input class="cnpjEmitente" placeholder="00.000.000/0000-00" id="documento" type="text" name="cnpj" value="" title="CNPJ: Cadastro Nacional da Pessoa Jurídica. Campo obrigatório, formato: 00.000.000/0000-00. Para ocultar o CNPJ digite 00.000.000/000-00" />
                            <button class="button btn btn-mini btn-inverse btn-consultar-cnpj" type="button">
                                <span class="button__icon"><i class="fas fa-search"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="ie" class="control-label">Inscrição Estadual</label>
                        <div class="controls">
                            <input id="ie" type="text" placeholder="Número de identificação fiscal estadual" name="ie" value="" title="Inscrição Estadual: Número de identificação fiscal estadual para empresas. Opcional, 8-14 dígitos." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="im" class="control-label">Inscrição Municipal</label>
                        <div class="controls">
                            <input id="im" type="text" placeholder="Número de identificação fiscal municipal" name="im" value="" title="Inscrição Municipal: Número de identificação fiscal municipal para empresas. Opcional, 8-20 dígitos." />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Endereço</legend>
                    <div class="control-group">
                        <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cep" type="text" placeholder="00000-000" name="cep" value="" class="cep" title="CEP: Código de Endereçamento Postal. Campo obrigatório, formato: 00000-000." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <select id="estado" name="uf" title="UF: Unidade Federativa (Estado). Campo obrigatório.">
                                <option value="">Selecione o Estado...</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <select id="cidade" name="cidade_select" title="Cidade: Nome da cidade. Campo obrigatório.">
                                <option value="">Selecione o Estado primeiro</option>
                            </select>
                            <input type="hidden" name="cidade" id="cidade_nome" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="codigo_ibge" class="control-label">Código IBGE</label>
                        <div class="controls">
                            <input id="codigo_ibge" type="text" placeholder="Preenchimento automático" name="codigo_ibge" value="" title="Código IBGE: Preenchimento automático ao selecionar a cidade." readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="rua" class="control-label">Logradouro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="rua" type="text" placeholder="Nome da rua, avenida, etc." name="logradouro" value="" title="Logradouro: Nome da rua, avenida, etc. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="numero" class="control-label">Número<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="numero" placeholder="Número do endereço" name="numero" value="" title="Número: Número do endereço. Campo obrigatório, máximo 10 caracteres." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="complemento" class="control-label">Complemento</label>
                        <div class="controls">
                            <input type="text" id="complemento" placeholder="Apartamento, bloco, etc." name="complemento" value="" title="Complemento: Informações adicionais do endereço (apartamento, bloco, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="bairro" type="text" placeholder="Nome do bairro" name="bairro" value="" title="Bairro: Nome do bairro. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group geo-group">
                        <label for="latitude" class="control-label">Latitude</label>
                        <div class="controls">
                            <input id="latitude" type="text" name="latitude" value="" placeholder="Latitude" title="Latitude: Coordenada geográfica de latitude. Preenchido automaticamente." readonly />
                        </div>
                        <label for="longitude" class="control-label">Longitude</label>
                        <div class="controls">
                            <input id="longitude" type="text" name="longitude" value="" placeholder="Longitude" title="Longitude: Coordenada geográfica de longitude. Preenchido automaticamente." readonly />
                        </div>
                        <div class="geo-buttons">
                            <button type="button" id="buscar_coords" class="button btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço">
                                <span class="button__icon"><i class="bx bx-search-alt"></i></span>
                                <span class="button__text2">Buscar</span>
                            </button>
                            <button type="button" class="button btn btn-mini btn-primary open-map-button" title="Definir localização no mapa">
                                <span class="button__icon"><i class="bx bx-map-alt"></i></span>
                                <span class="button__text2">Definir</span>
                            </button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Contato</legend>
                    <div class="control-group">
                        <label for="telefone" class="control-label">Telefone/Celular<span class="required">*</span></label>
                        <div class="controls">
                            <input id="telefone" type="text" placeholder="(00) 0000-0000" name="telefone" value="" class="telefone" title="Telefone: Número de telefone fixo ou comercial. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email" class="control-label">E-mail<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" type="text" placeholder="email@exemplo.com" name="email" value="" title="E-mail: Endereço de correio eletrônico. Campo obrigatório, deve ser válido." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email_contador" class="control-label">E-mail do Contador</label>
                        <div class="controls">
                            <input id="email_contador" type="text" placeholder="E-mail do contador para XMLs" name="email_contador" value="" title="E-mail do Contador: Endereço de e-mail do contador para envio automático dos arquivos XMLs. Opcional." />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section info-empresa-fieldset">
                    <legend>Informações da Empresa</legend>
                    <div class="control-group">
                        <label for="cnae" class="control-label">CNAE</label>
                        <div class="controls">
                            <select id="cnae" name="cnae" aria-placeholder="Selecione o CNAE" title="CNAE: Classificação Nacional de Atividades Econômicas. Selecione o código CNAE correspondente à atividade principal da empresa. Opcional, mas recomendado para emissão de notas fiscais.">
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="atividade_principal" class="control-label">Atividade Principal</label>
                        <div class="controls">
                            <textarea id="atividade_principal" placeholder="Descrição da Atividade Principal" name="atividade_principal" title="Descrição da Atividade Principal: Descrição da atividade econômica principal da empresa. Opcional."></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="situacao" class="control-label">Situação</label>
                        <div class="controls">
                            <input type="text" id="situacao" placeholder="Status cadastral da empresa" name="situacao" value="" title="Situação: Status cadastral da empresa (ativa, inativa, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="data_situacao" class="control-label">Data da Situação</label>
                        <div class="controls">
                            <input type="text" id="data_situacao" placeholder="DD/MM/AAAA" name="data_situacao" value="" title="Data da Situação: Data da última alteração na situação cadastral. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="data_abertura" class="control-label">Data da Abertura</label>
                        <div class="controls">
                            <input type="text" id="data_abertura" placeholder="DD/MM/AAAA" name="data_abertura" value="" title="Data da Abertura: Data de constituição da empresa. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="natureza_juridica" class="control-label">Natureza Jurídica</label>
                        <div class="controls">
                            <input type="text" id="natureza_juridica" placeholder="Tipo de empresa (Ltda, S.A., etc.)" name="natureza_juridica" value="" title="Natureza Jurídica: Tipo de empresa (Ltda, S.A., etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="porte" class="control-label">Porte</label>
                        <div class="controls">
                            <input type="text" id="porte" placeholder="Porte da empresa (micro, pequena, etc.)" name="porte" value="" title="Porte: Porte da empresa (micro, pequena, média, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="capital_social" class="control-label">Capital Social</label>
                        <div class="controls">
                            <input type="text" id="capital_social" placeholder="Valor do capital social" name="capital_social" value="" title="Capital Social: Valor do capital social da empresa. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="qsa" class="control-label">Quadro de Sócios e Administradores</label>
                        <div class="controls">
                            <textarea id="qsa" placeholder="Lista dos sócios e administradores" name="qsa" title="Quadro de Sócios e Administradores: Lista dos sócios e administradores da empresa. Opcional."></textarea>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Logotipo</legend>
                    <div class="control-group">
                        <label for="userfile" class="control-label">Logotipo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="userfile" type="file" name="userfile" value="" title="Logotipo: Imagem do logotipo da empresa. Campo obrigatório, tamanho recomendado: 130x130 pixels." />
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-success"><span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Cadastrar</span></button>
            </div>
        </form>
    </div>

    <?php } else { ?>
    <div class="row-fluid" style="margin-top:0">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title" style="margin: -20px 0 0">
                    <span class="icon">
                        <i class="fas fa-align-justify"></i>
                    </span>
                    <h5>Dados do Emitente</h5>
                </div>
                <div class="widget-content ">
                    <div class="alert alert-info">Os dados abaixo serão utilizados no cabeçalho das telas de impressão.</div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width: 25%"><img src="<?= $dados->url_logo; ?>"></td>
                                <td>
                                    <span style="font-size: 20px; "><b><?= $dados->nome; ?></b></span></br>
                                    <i class="fas fa-fingerprint" style="margin:5px 1px"></i> <?= $dados->cnpj; ?> <?php if (!empty($dados->ie)) {
                                        echo ' - IE:' . $dados->ie;
                                    } ?><?php if (!empty($dados->im)) {
                                        echo ' - IM:' . $dados->im;
                                    } ?></br>
                                    <i class="fas fa-map-marker-alt" style="margin:4px 3px"></i> <?= $dados->rua . ', ' . $dados->numero . ', ' . $dados->bairro . ' - ' . $dados->cep . ', ' . $dados->cidade . '/' . $dados->uf; ?></br>
                                    <i class="fas fa-phone" style="margin:5px 1px"></i> <?= $dados->telefone; ?></br>
                                    <i class="fas fa-envelope" style="margin:5px 1px"></i> <?= $dados->email; ?></br>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="display:flex">
                        <a href="#modalAlterar" data-toggle="modal" role="button" class="button btn btn-success"><span class="button__icon"><i class='bx bx-edit'></i></span><span class="button__text2">Atualizar Dados</span></a>
                        <a href="#modalLogo" data-toggle="modal" role="button" class="button btn btn-inverse"><span class="button__icon"><i class='bx bx-upload'></i></span> <span class="button__text2">Alterar Logo</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalAlterar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="<?= site_url('mapos/editarEmitente'); ?>" id="edit_formAlterar" enctype="multipart/form-data" method="post" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="">Editar Dados do Emitente</h3>
            </div>
            <div class="modal-body">
                <fieldset class="form-section">
                    <legend>Dados Principais</legend>
                    <div class="control-group">
                        <label for="edit_nomeEmitente" class="control-label">Razão Social<span class="required">*</span></label>
                        <div class="controls">
                            <input id="edit_nomeEmitente" type="text" name="nome" value="<?= $dados->nome; ?>" placeholder="Nome completo da empresa ou pessoa jurídica" title="Razão Social: Nome completo da empresa ou pessoa jurídica. Campo obrigatório." />
                            <input id="edit_id" type="hidden" name="id" value="<?= $dados->id; ?>" />
                        </div>
                    </div>
                    <div class="control-group documento-group">
                        <label for="edit_documento" class="control-label">CNPJ<span class="required">*</span></label>
                        <div class="controls">
                            <input class="cnpjEmitente" type="text" id="edit_documento" name="cnpj" value="<?= $dados->cnpj; ?>" placeholder="00.000.000/0000-00" title="CNPJ: Cadastro Nacional da Pessoa Jurídica. Campo obrigatório, formato: 00.000.000/0000-00. Para ocultar o CNPJ digite 00.000.000/000-00" />
                            <button class="button btn btn-mini btn-inverse btn-consultar-cnpj" type="button">
                                <span class="button__icon"><i class="bx bx-search-alt"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_ie" class="control-label">Inscrição Estadual</label>
                        <div class="controls">
                            <input id="edit_ie" type="text" name="ie" value="<?= $dados->ie; ?>" placeholder="Número de identificação fiscal estadual" title="Inscrição Estadual: Número de identificação fiscal estadual para empresas. Opcional, 8-14 dígitos." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_im" class="control-label">Inscrição Municipal</label>
                        <div class="controls">
                            <input id="edit_im" type="text" name="im" value="<?= $dados->im; ?>" placeholder="Número de identificação fiscal municipal" title="Inscrição Municipal: Número de identificação fiscal municipal para empresas. Opcional, 8-20 dígitos." />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Endereço</legend>
                    <div class="control-group">
                        <label for="edit_cep" class="control-label">CEP<span class="required">*</span></label>
                        <div class="controls">
                            <input id="edit_cep" type="text" name="cep" value="<?= $dados->cep; ?>" placeholder="00000-000" class="cep" title="CEP: Código de Endereçamento Postal. Campo obrigatório, formato: 00000-000." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <select id="edit_estado" name="uf" title="UF: Unidade Federativa (Estado). Campo obrigatório.">
                                <option value="">Selecione o Estado...</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <select id="edit_cidade" name="cidade_select" title="Cidade: Nome da cidade. Campo obrigatório.">
                                <option value="">Selecione o Estado primeiro</option>
                            </select>
                            <input type="hidden" name="cidade" id="edit_cidade_nome" value="<?= $dados->cidade ?? ''; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_codigo_ibge" class="control-label">Código IBGE</label>
                        <div class="controls">
                            <input id="edit_codigo_ibge" type="text" name="codigo_ibge" value="<?= $dados->codigo_ibge ?? ''; ?>" placeholder="Preenchimento automático" title="Código IBGE: Preenchimento automático ao selecionar a cidade." readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_rua" class="control-label">Logradouro<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="edit_rua" name="logradouro" value="<?= $dados->rua; ?>"
                                placeholder="Nome da rua, avenida, etc." title="Logradouro: Nome da rua, avenida, etc. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_numero" class="control-label">Número<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="edit_numero" name="numero" value="<?= $dados->numero; ?>" placeholder="Número do endereço" title="Número: Número do endereço. Campo obrigatório, máximo 10 caracteres." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_complemento" class="control-label">Complemento</label>
                        <div class="controls">
                            <input type="text" id="edit_complemento" name="complemento" value="<?= $dados->complemento ?? ''; ?>" placeholder="Apartamento, bloco, etc." title="Complemento: Informações adicionais do endereço (apartamento, bloco, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="edit_bairro" name="bairro" value="<?= $dados->bairro; ?>" placeholder="Nome do bairro" title="Bairro: Nome do bairro. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group geo-group">
                        <label for="edit_latitude" class="control-label">Latitude</label>
                        <div class="controls">
                            <input id="edit_latitude" type="text" name="latitude" value="<?= $dados->latitude ?? ''; ?>" placeholder="Latitude" title="Latitude: Coordenada geográfica de latitude. Preenchido automaticamente." readonly />
                        </div>
                        <label for="edit_longitude" class="control-label">Longitude</label>
                        <div class="controls">
                            <input id="edit_longitude" type="text" name="longitude" value="<?= $dados->longitude ?? ''; ?>" placeholder="Longitude" title="Longitude: Coordenada geográfica de longitude. Preenchido automaticamente." readonly />
                        </div>
                        <div class="geo-buttons">
                            <button type="button" id="edit_buscar_coords" class="button btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço">
                                <span class="button__icon"><i class="bx bx-search-alt"></i></span>
                                <span class="button__text2">Buscar</span>
                            </button>
                            <button type="button" class="button btn btn-mini btn-primary open-map-button" title="Definir localização no mapa">
                                <span class="button__icon"><i class="bx bx-map-alt"></i></span>
                                <span class="button__text2">Definir</span>
                            </button>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Contato</legend>
                    <div class="control-group">
                        <label for="edit_telefone" class="control-label">Telefone/Celular<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" id="edit_telefone" name="telefone" value="<?= $dados->telefone; ?>"
                                placeholder="(00) 0000-0000" class="telefone" title="Telefone: Número de telefone fixo ou comercial. Campo obrigatório." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_email" class="control-label">E-mail<span class="required">*</span></label>
                        <div class="controls">
                            <input id="edit_email" type="text" name="email" value="<?= $dados->email; ?>" placeholder="email@exemplo.com" title="E-mail: Endereço de correio eletrônico. Campo obrigatório, deve ser válido." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_email_contador" class="control-label">E-mail do Contador</label>
                        <div class="controls">
                            <input id="edit_email_contador" type="text" name="email_contador" value="<?= $dados->email_contador ?? ''; ?>" placeholder="E-mail do contador para XMLs" title="E-mail do Contador: Endereço de e-mail do contador para envio automático dos arquivos XMLs. Opcional." />
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section info-empresa-fieldset">
                    <legend>Informações da Empresa</legend>
                    <div class="control-group">
                        <label for="edit_cnae" class="control-label">CNAE</label>
                        <div class="controls">
                            <select id="edit_cnae" name="cnae">
                                <?php if (isset($dados->cnae) && !empty($dados->cnae)) : ?>
                                    <option value="<?= $dados->cnae ?>" selected><?= $dados->cnae ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_atividade_principal" class="control-label">Atividade Principal</label>
                        <div class="controls">
                            <textarea id="edit_atividade_principal" placeholder="Descrição da Atividade Principal" name="atividade_principal" title="Descrição da Atividade Principal: Descrição da atividade econômica principal da empresa. Opcional."><?= $dados->atividade_principal ?? ''; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_situacao" class="control-label">Situação</label>
                        <div class="controls">
                            <input type="text" id="edit_situacao" name="situacao" value="<?= $dados->situacao ?? ''; ?>" placeholder="Status cadastral da empresa" title="Situação: Status cadastral da empresa (ativa, inativa, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_data_situacao" class="control-label">Data da Situação</label>
                        <div class="controls">
                            <input type="text" id="edit_data_situacao" name="data_situacao" value="<?= (!empty($dados->data_situacao) && $dados->data_situacao != '0000-00-00') ? date('d/m/Y', strtotime($dados->data_situacao)) : ''; ?>" placeholder="DD/MM/AAAA" title="Data da Situação: Data da última alteração na situação cadastral. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_data_abertura" class="control-label">Data da Abertura</label>
                        <div class="controls">
                            <input type="text" id="edit_data_abertura" name="data_abertura" value="<?= (!empty($dados->data_abertura) && $dados->data_abertura != '0000-00-00') ? date('d/m/Y', strtotime($dados->data_abertura)) : ''; ?>" placeholder="DD/MM/AAAA" title="Data da Abertura: Data de constituição da empresa. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_natureza_juridica" class="control-label">Natureza Jurídica</label>
                        <div class="controls">
                            <input type="text" id="edit_natureza_juridica" name="natureza_juridica" value="<?= $dados->natureza_juridica ?? ''; ?>" placeholder="Tipo de empresa (Ltda, S.A., etc.)" title="Natureza Jurídica: Tipo de empresa (Ltda, S.A., etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_porte" class="control-label">Porte</label>
                        <div class="controls">
                            <input type="text" id="edit_porte" name="porte" value="<?= $dados->porte ?? ''; ?>" placeholder="Porte da empresa (micro, pequena, etc.)" title="Porte: Porte da empresa (micro, pequena, média, etc.). Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_capital_social" class="control-label">Capital Social</label>
                        <div class="controls">
                            <input type="text" id="edit_capital_social" name="capital_social" value="<?= $dados->capital_social ?? ''; ?>" placeholder="Valor do capital social" title="Capital Social: Valor do capital social da empresa. Opcional." />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="edit_qsa" class="control-label">Quadro de Sócios e Administradores</label>
                        <div class="controls">
                            <textarea id="edit_qsa" placeholder="Lista dos sócios e administradores" name="qsa" title="Quadro de Sócios e Administradores: Lista dos sócios e administradores da empresa. Opcional."><?= $dados->qsa ?? ''; ?></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-mini btn-danger" data-dismiss="modal" aria-hidden="true" id="edit_btnCancelExcluir"><span class="button__icon"><i class='bx bx-x'></i></span> <span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
            </div>
        </form>
    </div>

    <div id="modalLogo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?= site_url('mapos/editarLogo'); ?>" id="formLogo" enctype="multipart/form-data" method="post" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="">MapOS - Atualizar Logotipo</h3>
            </div>
            <div class="modal-body">
                <div class="span12 alert alert-info">Selecione uma nova imagem da logotipo. Tamanho indicado (130 X 130).</div>
                <div class="control-group">
                    <label for="userfile" class="control-label"><span class="required">Logotipo*</span></label>
                    <div class="controls">
                        <input type="file" name="userfile" value="" />
                        <input id="nome" type="hidden" name="id" value="<?= $dados->id; ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:flex;justify-content: center">
                <button class="button btn btn-mini btn-danger" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir"><span class="button__icon"><i class='bx bx-x'></i></span> <span class="button__text2">Cancelar</span></button>
                <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
            </div>
        </form>
    </div>
<?php } ?>

<!-- Modal Mapa -->
<div id="modalMapa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 id="myModalLabel">Selecione a Localização no Mapa</h5>
    </div>
    <div class="modal-body">
        <p>Clique no mapa para definir um marcador ou arraste um marcador existente.</p>
        <div id="map-picker" style="height: 400px; width: 100%; border-radius: 10px;"></div>
    </div>
    <div class="modal-footer" style="display:flex;justify-content: center">
        <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
        <button id="btn-confirmar-localizacao" class="button btn btn-success"><span class="button__icon"><i class='bx bx-check'></i></span><span class="button__text2">Confirmar</span></button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const validationRules = {
            nome: { required: true },
            cnpj: { required: true },
            cep: { required: true },
            logradouro: { required: true },
            numero: { required: true },
            bairro: { required: true },
            cidade_select: { required: true }, // Rule updated to target the select
            uf: { required: true },
            telefone: { required: true },
            email: { required: true, email: true }
        };

        const validationOptions = {
            errorClass: "help-inline",
            errorElement: "span",
            ignore: ":hidden:not(select.select2-hidden-accessible)", // More specific ignore selector for Select2
            errorPlacement: function (error, element) {
                // Position error message correctly for Select2
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
                $(element).parents('.control-group').removeClass('success');
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').addClass('error');
                    $(element).next('.select2-container').removeClass('success');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').removeClass('error');
                    $(element).next('.select2-container').addClass('success');
                }
            }
        };

        $("#formCadastrar").validate({
            ...validationOptions,
            rules: { ...validationRules,
                userfile: {
                    required: true
                }
            }
        });
        $("#edit_formAlterar").validate({ ...validationOptions,
            rules: validationRules
        });
        $("#formLogo").validate({ ...validationOptions,
            rules: {
                userfile: {
                    required: true
                }
            }
        });

        function initializeEmitenteForm(modalSelector) {
            const normalize = (str) => str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
            const modal = $(modalSelector);
            if (modal.data('select2-initialized')) return; // Previne re-inicialização

            const stateSelect = modal.find('select[name="uf"]');
            const citySelect = modal.find('select[name="cidade_select"]');
            const ibgeInput = modal.find('input[name="codigo_ibge"]');

            const cnaeSelect = modal.find('select[name="cnae"]');

            // Se houver um CNAE pré-selecionado via PHP, formata o texto para exibição ANTES de inicializar o select2
            const initialCnaeValue = cnaeSelect.val();
            if (initialCnaeValue) {
                const formattedText = formatCnae(initialCnaeValue);
                const selectedOption = cnaeSelect.find('option[value="' + initialCnaeValue + '"]');
                if (selectedOption.length) {
                    selectedOption.text(formattedText);
                }
            }

            cnaeSelect.select2({
                dropdownParent: modal,
                placeholder: 'Digite o código ou a descrição do CNAE',
                minimumInputLength: 1,
                ajax: {
                    url: '<?= base_url('index.php/ibge/consultarCnae'); ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term // Termo da busca
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        };
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
                const modal = $(this).closest('.modal');
                const atividadeTextarea = modal.find('textarea[name="atividade_principal"]');

                if (data && data.text) {
                    // O texto vem no formato "CODIGO - DESCRICAO"
                    // Extrai apenas a descrição.
                    const description = data.text.split(' - ').slice(1).join(' - ');
                    if (description) {
                        atividadeTextarea.val(description);
                    }
                }
            });

            let curState = (modal.attr('id') === 'modalAlterar') ? <?= json_encode($dados->uf ?? '') ?> : '';
            let curCity = (modal.attr('id') === 'modalAlterar') ? <?= json_encode($dados->cidade ?? '') ?> : '';        
            stateSelect.select2({ dropdownParent: modal, placeholder: "Selecione um estado" });
            citySelect.select2({ dropdownParent: modal, placeholder: "Selecione um estado primeiro" });
        
            // Moved this handler to be before the state loading logic
            stateSelect.on('change', function() {
                const uf = $(this).val();
                citySelect.val(null).trigger('change').prop('disabled', true);
                ibgeInput.val('');

                if (uf) {
                    citySelect.select2('destroy');
                    citySelect.prop('disabled', false).select2({
                        dropdownParent: modal,
                        placeholder: 'Digite para buscar uma cidade...',
                        minimumInputLength: 2,
                        ajax: {
                            url: `<?= base_url('index.php/ibge/search_cities'); ?>/${uf}`,
                            dataType: 'json',
                            delay: 250,
                            data: params => ({
                                term: params.term
                            }),
                            processResults: data => ({
                                results: data.results
                            }),
                            cache: true
                        }
                    });

                    // Check for a city to load, either from the initial PHP variable or from a dynamic data attribute
                    let cityToLoad = modal.data('cidade-a-carregar') || (curCity ? curCity : null);
                    if (modal.data('cidade-a-carregar')) {
                        modal.removeData('cidade-a-carregar'); // Clear after use
                    }
                    if (curCity) {
                        curCity = null; // Clear after use
                    }

                    if (cityToLoad) {
                        $.ajax({
                            type: 'GET',
                            url: `<?= base_url('index.php/ibge/search_cities'); ?>/${uf}`,
                            data: {
                                term: cityToLoad
                            },
                            dataType: 'json'
                        }).done(function(data) {
                            if (data.results && data.results.length > 0) {
                                const cityData = data.results[0];

                                if (cityData) {
                                    // 1. Adiciona a nova opção ao select
                                    const option = new Option(cityData.text, cityData.id, true, true);
                                    citySelect.append(option);

                                    // 2. Define explicitamente o valor no select
                                    citySelect.val(cityData.id);

                                    // 3. Dispara o evento para preencher os outros campos (ex: IBGE)
                                    citySelect.trigger({
                                        type: 'select2:select',
                                        params: {
                                            data: cityData
                                        }
                                    });
                                    
                                    // 4. Dispara o evento change para o Select2 atualizar a sua UI
                                    citySelect.trigger('change');
                                }
                            }
                        });
                    }
                } else {
                    citySelect.select2('destroy').prop('disabled', true).empty().select2({
                        dropdownParent: modal,
                        placeholder: "Selecione um estado primeiro"
                    });
                }
            });
        
            function popularEstados(data) {
                data.sort((a, b) => a.nome.localeCompare(b.nome));
                stateSelect.empty().append('<option value="">Selecione...</option>');
                data.forEach(estado => stateSelect.append(new Option(estado.nome, estado.sigla)));
                if (curState) {
                    stateSelect.val(curState).trigger('change');
                }
            }

            let estadosCache = localStorage.getItem('ibge_estados');
            if (estadosCache) {
                popularEstados(JSON.parse(estadosCache));
            } else {
                $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
                    .done(data => {
                        localStorage.setItem('ibge_estados', JSON.stringify(data));
                        popularEstados(data);
                    })
                    .fail(() => $.getJSON('<?= base_url() ?>assets/json/estados.json', data => popularEstados(data.estados)));
            }

            function handleGeocode(modal) {
                const street = modal.find('input[name="logradouro"]').val();
                const number = modal.find('input[name="numero"]').val();
                const neighborhood = modal.find('input[name="bairro"]').val();
                const city = modal.find('select[name="cidade_select"]').select2('data')[0]?.text;
                const state = modal.find('select[name="uf"]').val();
                const cep = modal.find('input[name="cep"]').val();

                geocodeAddress(street, number, neighborhood, city, state, cep,
                    (coords) => {
                        modal.find('input[name="latitude"]').val(coords.lat);
                        modal.find('input[name="longitude"]').val(coords.lon);
                    },
                    (errorMsg) => {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Atenção',
                            text: errorMsg
                        });
                    }
                );
            }

            citySelect.on('select2:select', function(e) {
                const selectedData = e.params.data;
                const ibgeCode = selectedData.ibge || selectedData.id;
                const cityName = selectedData.text || selectedData.id;

                if (ibgeCode && /^\d+$/.test(ibgeCode)) {
                    ibgeInput.val(ibgeCode);
                }
                modal.find('input[name="cidade"]').val(cityName || '');

                handleGeocode(modal);
            });

            modal.find('#buscar_coords, #edit_buscar_coords').on('click', () => handleGeocode(modal));
            
            modal.data('select2-initialized', true);

            // Move masking and validation inside here
            modal.find('.cnpjEmitente').mask("00.000.000/0000-00").focus().select();
            modal.find('input[name="cep"]').mask("00000-000");
            modal.find('input[name="data_abertura"], input[name="data_situacao"]').mask("00/00/0000");
            modal.find('input[name="capital_social"]').mask("#.##0,00", { reverse: true });
            modal.find('input[name="ie"]').mask("000.000.000.000");

            // Trigger validation on select2 change to provide immediate feedback
            modal.on('change', 'select.select2-hidden-accessible', function () {
                $(this).valid();
            });

        }

        $('#modalCadastrar, #modalAlterar').on('shown.bs.modal shown', function() {
            initializeEmitenteForm(this);
        });

        let mapPicker;
        let markerPicker;
        let selectedCoords;
        let activeModal;

        // Salva a função original enforceFocus
        const originalEnforceFocus = $.fn.modal.Constructor.prototype.enforceFocus;

        $(document).on('click', '.open-map-button', function() {
            activeModal = $(this).closest('.modal');
            // Temporariamente desabilita enforceFocus antes de mostrar o modal do mapa
            $.fn.modal.Constructor.prototype.enforceFocus = function () {};
            $('#modalMapa').modal('show');
        });

        $('#modalMapa').on('shown.bs.modal', function() {
            // Inicializa o mapa dentro de um setTimeout para garantir que o modal esteja visível e dimensionado
            setTimeout(function() {
                if (!mapPicker) {
                    mapPicker = L.map('map-picker').setView([-15.7801, -47.9292], 4);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(mapPicker);

                    mapPicker.on('click', function(e) {
                        if (markerPicker) {
                            markerPicker.setLatLng(e.latlng);
                        } else {
                            markerPicker = L.marker(e.latlng, { draggable: true }).addTo(mapPicker);
                        }
                        selectedCoords = e.latlng;
                    });
                }
                
                const lat = activeModal.find('input[name="latitude"]').val();
                const lon = activeModal.find('input[name="longitude"]').val();

                if (lat && lon && !isNaN(lat) && !isNaN(lon)) {
                    const initialCoords = L.latLng(lat, lon);
                    if (markerPicker) {
                        markerPicker.setLatLng(initialCoords);
                    } else {
                        markerPicker = L.marker(initialCoords, { draggable: true }).addTo(mapPicker);
                    }
                    mapPicker.setView(initialCoords, 15);
                    selectedCoords = initialCoords;
                } else {
                     mapPicker.setView([-15.7801, -47.9292], 4);
                     if(markerPicker) {
                        mapPicker.removeLayer(markerPicker);
                        markerPicker = null;
                     }
                }
                mapPicker.invalidateSize(); // Garante que o mapa seja renderizado corretamente
            }, 100); // Pequeno atraso para garantir que o modal esteja totalmente visível
        }).on('hidden.bs.modal', function () {
            // Restaura enforceFocus quando o modal é fechado
            $.fn.modal.Constructor.prototype.enforceFocus = originalEnforceFocus;
        });

        $('#btn-confirmar-localizacao').on('click', function() {
            if (markerPicker) {
                selectedCoords = markerPicker.getLatLng();
            }
            if (selectedCoords && activeModal) {
                activeModal.find('input[name="latitude"]').val(selectedCoords.lat.toFixed(8));
                activeModal.find('input[name="longitude"]').val(selectedCoords.lng.toFixed(8));
            }
            $('#modalMapa').modal('hide');
        });
    });
</script>
