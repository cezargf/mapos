<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .modal {
        overflow-y: auto !important;
        max-height: 90vh !important;
        top: 2.5% !important;
    }
    /* .modal-body {
        padding: 20px;
    } */

    .form-horizontal .controls {
        margin-left: 20px;
    }

    .form-horizontal .control-label {
        padding-top: 9px;
        width: 160px;
    }

    h5 {
        padding-bottom: 15px;
        font-size: 1.5em;
        font-weight: 500;
        line-height: 1.5;
    }

    .form-horizontal .control-group {
        border-top: 0 solid #ffffff;
        border-bottom: 0 solid #eeeeee;
        margin-bottom: 0;
    }

    .widget-content {
        padding: 0 16px 15px;
    }

    @media (max-width: 480px) {
        .modal-body {
            padding: 20px;
            overflow-x: hidden !important;
            grid-template-columns: 1fr !important;
        }

        form {
            display: block !important;
        }

        .form-horizontal .control-label {
            margin-bottom: -6px;
        }

        .btn-xs {
            position: initial !important;
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
            <div class="modal-body" style="display: grid;grid-template-columns: 1fr 1fr">
                <div class="control-group">
                    <label for="nomeEmitente" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="nomeEmitente" placeholder="Razão Social*" type="text" name="nome" value="" title="Razão Social: Nome completo da empresa ou pessoa jurídica. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="documento" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input class="cnpjEmitente" placeholder="CNPJ*" id="documento" type="text" name="cnpj" value="" title="CNPJ: Cadastro Nacional da Pessoa Jurídica. Campo obrigatório, formato: 00.000.000/0000-00. Para ocultar o CNPJ digite 00.000.000/000-00" />
                        <button style="top:34px;right:40px;position:absolute" id="buscar_info_cnpj" class="btn btn-xs" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="control-group">
                    <label for="ie" class="control-label"></label>
                    <div class="controls">
                        <input id="ie" type="text" placeholder="Inscrição Estadual" name="ie" value="" title="Inscrição Estadual: Número de identificação fiscal estadual para empresas. Opcional, 8-14 dígitos." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="im" class="control-label"></label>
                    <div class="controls">
                        <input id="im" type="text" placeholder="Inscrição Municipal" name="im" value="" title="Inscrição Municipal: Número de identificação fiscal municipal para empresas. Opcional, 8-20 dígitos." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="cep" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="cep" type="text" placeholder="CEP*" name="cep" value="" title="CEP: Código de Endereçamento Postal. Campo obrigatório, formato: 00000-000." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="estado" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <select id="estado" name="uf" title="UF: Unidade Federativa (Estado). Campo obrigatório.">
                            <option value="">Selecione o Estado...</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="cidade" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <select id="cidade" name="cidade" title="Cidade: Nome da cidade. Campo obrigatório.">
                            <option value="">Selecione o Estado primeiro</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="codigo_ibge" class="control-label"></label>
                    <div class="controls">
                        <input id="codigo_ibge" type="text" placeholder="Código IBGE" name="codigo_ibge" value="" title="Código IBGE: Preenchimento automático ao selecionar a cidade." readonly />
                    </div>
                </div>
                <div class="control-group">
                    <label for="rua" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="rua" type="text" placeholder="Logradouro*" name="logradouro" value="" title="Logradouro: Nome da rua, avenida, etc. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="numero" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input type="text" id="numero" placeholder="Número*" name="numero" value="" title="Número: Número do endereço. Campo obrigatório, máximo 10 caracteres." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="complemento" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="complemento" placeholder="Complemento" name="complemento" value="" title="Complemento: Informações adicionais do endereço (apartamento, bloco, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="bairro" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="bairro" type="text" placeholder="Bairro*" name="bairro" value="" title="Bairro: Nome do bairro. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="latitude" class="control-label">Latitude</label>
                    <div class="controls">
                        <input id="latitude" type="text" name="latitude" value="" placeholder="Latitude" title="Latitude: Coordenada geográfica de latitude. Preenchido automaticamente." readonly />
                    </div>
                </div>
                <div class="control-group">
                    <label for="longitude" class="control-label">Longitude</label>
                    <div class="controls">
                        <input id="longitude" type="text" name="longitude" value="" placeholder="Longitude" title="Longitude: Coordenada geográfica de longitude. Preenchido automaticamente." readonly />
                        <div style="margin-top: 5px;">
                            <button type="button" id="buscar_coords" class="btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço"><i class="fas fa-search"></i> Buscar Coordenadas</button>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="telefone" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="telefone" type="text" placeholder="Telefone*" name="telefone" value="" title="Telefone: Número de telefone fixo ou comercial. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="email" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="email" type="text" placeholder="E-mail*" name="email" value="" title="E-mail: Endereço de correio eletrônico. Campo obrigatório, deve ser válido." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="email_contador" class="control-label"></label>
                    <div class="controls">
                        <input id="email_contador" type="text" placeholder="E-mail do Contador" name="email_contador" value="" title="E-mail do Contador: Endereço de e-mail do contador para envio automático dos arquivos XMLs. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="cnae" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="cnae" placeholder="Código CNAE" name="cnae" value="" maxlength="7" title="Código CNAE: Código Nacional de Atividade Econômica (formato: XXXX-XX). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="atividade_principal" class="control-label"></label>
                    <div class="controls">
                        <textarea id="atividade_principal" placeholder="Descrição da Atividade Principal" name="atividade_principal" title="Descrição da Atividade Principal: Descrição da atividade econômica principal da empresa. Opcional."></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="situacao" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="situacao" placeholder="Situação" name="situacao" value="" title="Situação: Status cadastral da empresa (ativa, inativa, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="data_situacao" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="data_situacao" placeholder="Data da Situação" name="data_situacao" value="" title="Data da Situação: Data da última alteração na situação cadastral. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="data_abertura" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="data_abertura" placeholder="Data da Abertura" name="data_abertura" value="" title="Data da Abertura: Data de constituição da empresa. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="natureza_juridica" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="natureza_juridica" placeholder="Natureza Jurídica" name="natureza_juridica" value="" title="Natureza Jurídica: Tipo de empresa (Ltda, S.A., etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="porte" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="porte" placeholder="Porte" name="porte" value="" title="Porte: Porte da empresa (micro, pequena, média, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="capital_social" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="capital_social" placeholder="Capital Social" name="capital_social" value="" title="Capital Social: Valor do capital social da empresa. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="qsa" class="control-label"></label>
                    <div class="controls">
                        <textarea id="qsa" placeholder="Quadro de Sócios e Administradores" name="qsa" title="Quadro de Sócios e Administradores: Lista dos sócios e administradores da empresa. Opcional."></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="userfile" class="control-label"><span class="required">Logotipo*</span></label>
                    <div class="controls">
                        <input id="userfile" type="file" name="userfile" value="" title="Logotipo: Imagem do logotipo da empresa. Campo obrigatório, tamanho recomendado: 130x130 pixels." />
                    </div>
                </div>
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
            <div class="modal-body" style="display: grid;grid-template-columns: 1fr 1fr">
                <div class="control-group">
                    <label for="edit_nomeEmitente" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="edit_nomeEmitente" type="text" name="nome" value="<?= $dados->nome; ?>" placeholder="Razão Social*" title="Razão Social: Nome completo da empresa ou pessoa jurídica. Campo obrigatório." />
                        <input id="edit_id" type="hidden" name="id" value="<?= $dados->id; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_documento" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input class="cnpjEmitente" type="text" id="edit_documento" name="cnpj" value="<?= $dados->cnpj; ?>" placeholder="CNPJ*" title="CNPJ: Cadastro Nacional da Pessoa Jurídica. Campo obrigatório, formato: 00.000.000/0000-00. Para ocultar o CNPJ digite 00.000.000/000-00" />
                        <button style="top:34px;right:40px;position:absolute" id="edit_buscar_info_cnpj" class="btn btn-xs" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_ie" class="control-label"></label>
                    <div class="controls">
                        <input id="edit_ie" type="text" name="ie" value="<?= $dados->ie; ?>" placeholder="Inscrição Estadual" title="Inscrição Estadual: Número de identificação fiscal estadual para empresas. Opcional, 8-14 dígitos." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_im" class="control-label"></label>
                    <div class="controls">
                        <input id="edit_im" type="text" name="im" value="<?= $dados->im; ?>" placeholder="Inscrição Municipal" title="Inscrição Municipal: Número de identificação fiscal municipal para empresas. Opcional, 8-20 dígitos." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_cep" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="edit_cep" type="text" name="cep" value="<?= $dados->cep; ?>" placeholder="CEP*" title="CEP: Código de Endereçamento Postal. Campo obrigatório, formato: 00000-000." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_estado" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <select id="edit_estado" name="uf" title="UF: Unidade Federativa (Estado). Campo obrigatório.">
                            <option value="">Selecione o Estado...</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_cidade" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <select id="edit_cidade" name="cidade" title="Cidade: Nome da cidade. Campo obrigatório.">
                            <option value="">Selecione o Estado primeiro</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_codigo_ibge" class="control-label"></label>
                    <div class="controls">
                        <input id="edit_codigo_ibge" type="text" name="codigo_ibge" value="<?= $dados->codigo_ibge ?? ''; ?>" placeholder="Código IBGE" title="Código IBGE: Preenchimento automático ao selecionar a cidade." readonly />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_rua" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input type="text" id="edit_rua" name="logradouro" value="<?= $dados->rua; ?>"
                            placeholder="Logradouro*" title="Logradouro: Nome da rua, avenida, etc. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_numero" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input type="text" id="edit_numero" name="numero" value="<?= $dados->numero; ?>" placeholder="Número*" title="Número: Número do endereço. Campo obrigatório, máximo 10 caracteres." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_complemento" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_complemento" name="complemento" value="<?= $dados->complemento ?? ''; ?>" placeholder="Complemento" title="Complemento: Informações adicionais do endereço (apartamento, bloco, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_bairro" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input type="text" id="edit_bairro" name="bairro" value="<?= $dados->bairro; ?>" placeholder="Bairro*" title="Bairro: Nome do bairro. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_latitude" class="control-label">Latitude</label>
                    <div class="controls">
                        <input id="edit_latitude" type="text" name="latitude" value="<?= $dados->latitude ?? ''; ?>" placeholder="Latitude" title="Latitude: Coordenada geográfica de latitude. Preenchido automaticamente." readonly />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_longitude" class="control-label">Longitude</label>
                    <div class="controls">
                        <input id="edit_longitude" type="text" name="longitude" value="<?= $dados->longitude ?? ''; ?>" placeholder="Longitude" title="Longitude: Coordenada geográfica de longitude. Preenchido automaticamente." readonly />
                        <div style="margin-top: 5px;">
                            <button type="button" id="edit_buscar_coords" class="btn btn-mini btn-info" title="Tentar encontrar automaticamente pelo endereço"><i class="fas fa-search"></i> Buscar Coordenadas</button>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_telefone" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input type="text" id="edit_telefone" name="telefone" value="<?= $dados->telefone; ?>"
                            placeholder="Telefone*" title="Telefone: Número de telefone fixo ou comercial. Campo obrigatório." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_email" class="control-label"><span class="required"></span></label>
                    <div class="controls">
                        <input id="edit_email" type="text" name="email" value="<?= $dados->email; ?>" placeholder="E-mail*" title="E-mail: Endereço de correio eletrônico. Campo obrigatório, deve ser válido." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_email_contador" class="control-label"></label>
                    <div class="controls">
                        <input id="edit_email_contador" type="text" name="email_contador" value="<?= $dados->email_contador ?? ''; ?>" placeholder="E-mail do Contador" title="E-mail do Contador: Endereço de e-mail do contador para envio automático dos arquivos XMLs. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_cnae" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_cnae" name="cnae" value="<?= $dados->cnae ?? ''; ?>" placeholder="Código CNAE" maxlength="7" title="Código CNAE: Código Nacional de Atividade Econômica (formato: XXXX-XX). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_atividade_principal" class="control-label"></label>
                    <div class="controls">
                        <textarea id="edit_atividade_principal" placeholder="Descrição da Atividade Principal" name="atividade_principal" title="Descrição da Atividade Principal: Descrição da atividade econômica principal da empresa. Opcional."><?= $dados->atividade_principal ?? ''; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_situacao" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_situacao" name="situacao" value="<?= $dados->situacao ?? ''; ?>" placeholder="Situação" title="Situação: Status cadastral da empresa (ativa, inativa, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_data_situacao" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_data_situacao" name="data_situacao" value="<?= (!empty($dados->data_situacao) && $dados->data_situacao != '0000-00-00') ? date('d/m/Y', strtotime($dados->data_situacao)) : ''; ?>" placeholder="Data da Situação" title="Data da Situação: Data da última alteração na situação cadastral. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_data_abertura" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_data_abertura" name="data_abertura" value="<?= (!empty($dados->data_abertura) && $dados->data_abertura != '0000-00-00') ? date('d/m/Y', strtotime($dados->data_abertura)) : ''; ?>" placeholder="Data da Abertura" title="Data da Abertura: Data de constituição da empresa. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_natureza_juridica" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_natureza_juridica" name="natureza_juridica" value="<?= $dados->natureza_juridica ?? ''; ?>" placeholder="Natureza Jurídica" title="Natureza Jurídica: Tipo de empresa (Ltda, S.A., etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_porte" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_porte" name="porte" value="<?= $dados->porte ?? ''; ?>" placeholder="Porte" title="Porte: Porte da empresa (micro, pequena, média, etc.). Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_capital_social" class="control-label"></label>
                    <div class="controls">
                        <input type="text" id="edit_capital_social" name="capital_social" value="<?= $dados->capital_social ?? ''; ?>" placeholder="Capital Social" title="Capital Social: Valor do capital social da empresa. Opcional." />
                    </div>
                </div>
                <div class="control-group">
                    <label for="edit_qsa" class="control-label"></label>
                    <div class="controls">
                        <textarea id="edit_qsa" placeholder="Quadro de Sócios e Administradores" name="qsa" title="Quadro de Sócios e Administradores: Lista dos sócios e administradores da empresa. Opcional."><?= $dados->qsa ?? ''; ?></textarea>
                    </div>
                </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function initializeEmitenteForm(modalSelector) {
            const modal = $(modalSelector);
            if (modal.data('select2-initialized')) return; // Previne re-inicialização

            const stateSelect = modal.find('select[name="uf"]');
            const citySelect = modal.find('select[name="cidade"]');
            const ibgeInput = modal.find('input[name="codigo_ibge"]');

            let curState = (modal.attr('id') === 'modalAlterar') ? '<?= $dados->uf ?? '' ?>' : '';
            let curCity = (modal.attr('id') === 'modalAlterar') ? '<?= $dados->cidade ?? '' ?>' : '';        
            stateSelect.select2({ dropdownParent: modal, placeholder: "Selecione um estado" });
            citySelect.select2({ dropdownParent: modal, placeholder: "Selecione um estado primeiro" });
        
            // Moved this handler to be before the state loading logic
            stateSelect.on('change', function() {
                const uf = $(this).val();
                citySelect.val(null).trigger('change').prop('disabled', true);
                ibgeInput.val('');

                if (uf) {
                    citySelect.prop('disabled', false).select2({
                        dropdownParent: modal,
                        placeholder: 'Digite para buscar uma cidade...',
                        minimumInputLength: 2,
                        ajax: {
                            url: `<?= base_url('index.php/ibge/search_cities'); ?>/${uf}`,
                            dataType: 'json',
                            delay: 250,
                            data: params => ({ term: params.term }),
                            processResults: data => ({ results: data.results }),
                            cache: true
                        }
                    });

                    // Restored this block for the "edit" mode
                    if (curCity) {
                        const cityToLoad = curCity;
                        curCity = null;

                        $.ajax({
                            type: 'GET',
                            url: `<?= base_url('index.php/ibge/search_cities'); ?>/${uf}`,
                            data: { term: cityToLoad },
                            dataType: 'json'
                        }).done(function(data) {
                            if (data.results && data.results.length > 0) {
                                const cityData = data.results.find(c => c.text.trim().toLowerCase() === cityToLoad.trim().toLowerCase());
                                if (cityData) {
                                    const option = new Option(cityData.text, cityData.id, true, true);
                                    citySelect.append(option).trigger('change');
                                    citySelect.trigger({ type: 'select2:select', params: { data: cityData } });
                                }
                            }
                        });
                    }
                } else {
                    citySelect.select2('destroy').prop('disabled', true).empty().select2({ dropdownParent: modal, placeholder: "Selecione um estado primeiro" });
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

            citySelect.on('select2:select', function(e) {
                const ibgeCode = e.params.data.ibge;
                if (ibgeCode) ibgeInput.val(ibgeCode);
                geocodeEmitente(modal);
            });

            modal.find('input[name="cep"]').on('blur', function() {
                const cep = $(this).val().replace(/\D/g, '');
                if (cep.length === 8) {
                    modal.find("input[name='logradouro'], input[name='bairro']").val("...").prop('readonly', true);
                    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(dados) {
                        modal.find("input[name='logradouro'], input[name='bairro']").prop('readonly', false);
                        if (!("erro" in dados)) {
                            modal.find("input[name='logradouro']").val(dados.logradouro);
                            modal.find("input[name='bairro']").val(dados.bairro);
                            
                            stateSelect.val(dados.uf).trigger('change');

                            // Cria e seleciona a cidade retornada pelo ViaCEP
                            if (dados.localidade) {
                                const option = new Option(dados.localidade, dados.localidade, true, true);
                                citySelect.append(option).trigger('change');
                                citySelect.trigger({
                                    type: 'select2:select',
                                    params: {
                                        data: {
                                            id: dados.localidade,
                                            text: dados.localidade,
                                            ibge: dados.ibge
                                        }
                                    }
                                });
                                if(dados.ibge) ibgeInput.val(dados.ibge);
                            }
                        } else {
                            modal.find("input[name='logradouro'], input[name='bairro']").val("");
                            stateSelect.val('').trigger('change');
                        }
                    });
                }
            });
        
            function geocodeEmitente(modal) {
                const q = `${modal.find('input[name="logradouro"]').val()}, ${modal.find('input[name="numero"]').val()}, ${modal.find('input[name="bairro"]').val()}, ${citySelect.val()}, ${stateSelect.val()}, Brasil`;
                if (modal.find('input[name="logradouro"]').val() && citySelect.val() && stateSelect.val()) {
                    $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&limit=1`)
                        .done(data => {
                            if (data && data.length > 0) {
                                modal.find('input[name="latitude"]').val(parseFloat(data[0].lat).toFixed(8));
                                modal.find('input[name="longitude"]').val(parseFloat(data[0].lon).toFixed(8));
                            }
                        });
                }
            }
            modal.find('#buscar_coords').on('click', () => geocodeEmitente(modal));
            modal.find('input[name="logradouro"], input[name="numero"], input[name="bairro"]').on('blur', () => geocodeEmitente(modal));
            
            modal.data('select2-initialized', true);
        }

        $('#modalCadastrar, #modalAlterar').on('shown.bs.modal shown', function() {
            initializeEmitenteForm(this);
        });

        $('.cnpjEmitente').mask("00.000.000/0000-00");
        $('input[name="cep"]').mask("00000-000");
        $('input[name="telefone"]').mask("(00) 0000-0000");
        $('input[name="cnae"]').mask("0000-00");
        $('input[name="data_abertura"], input[name="data_situacao"]').mask("00/00/0000");

        const validationRules = {
            nome: { required: true },
            cnpj: { required: true },
            logradouro: { required: true },
            numero: { required: true },
            bairro: { required: true },
            cidade: { required: true },
            uf: { required: true },
            telefone: { required: true },
            email: { required: true, email: true }
        };
        const validationOptions = {
            errorClass: "help-inline",
            errorElement: "span",
            highlight: el => $(el).closest('.control-group').addClass('error'),
            unhighlight: el => $(el).closest('.control-group').removeClass('error')
        };

        $("#formLogo").validate({ ...validationOptions, rules: { userfile: { required: true } } });
        $("#formCadastrar").validate({ ...validationOptions, rules: { ...validationRules, userfile: { required: true } } });
        $("#edit_formAlterar").validate({ ...validationOptions, rules: validationRules });


        $('#buscar_info_cnpj, #edit_buscar_info_cnpj').on('click', function(e) {
            e.preventDefault();
            const modal = $(this).closest('.modal');
            const cnpjField = modal.find('input[name="cnpj"]');
            const cnpj = cnpjField.val().replace(/\D/g, '');

            if (cnpj.length !== 14) {
                Swal.fire({ icon: 'error', title: 'Atenção', text: 'CNPJ inválido!' });
                return;
            }

            modal.find('input[name="nome"], input[name="cep"], input[name="logradouro"], input[name="numero"], input[name="bairro"], input[name="email"], input[name="telefone"]').val('...');
            modal.find('input, select').prop('readonly', true);

            $.ajax({
                url: `https://www.receitaws.com.br/v1/cnpj/${cnpj}`,
                dataType: 'jsonp',
                crossDomain: true,
                timeout: 10000
            }).done(function(data) {
                modal.find('input, select, textarea').prop('readonly', false);
                if (data.status === 'OK') {
                    // Preenche campos simples
                    modal.find('input[name="nome"]').val(data.nome);
                    modal.find('input[name="cep"]').val(data.cep.replace(/\./g, ''));
                    modal.find('input[name="logradouro"]').val(data.logradouro);
                    modal.find('input[name="numero"]').val(data.numero);
                    modal.find('input[name="bairro"]').val(data.bairro);
                    modal.find('input[name="complemento"]').val(data.complemento);
                    modal.find('input[name="telefone"]').val(data.telefone.split('/')[0].replace(/\s/g, ''));
                    modal.find('input[name="email"]').val(data.email.toLowerCase());
                    modal.find('input[name="situacao"]').val(data.situacao);
                    modal.find('input[name="porte"]').val(data.porte);
                    modal.find('input[name="data_abertura"]').val(data.abertura);
                    modal.find('input[name="data_situacao"]').val(data.data_situacao);
                    modal.find('input[name="natureza_juridica"]').val(data.natureza_juridica);
                    modal.find('input[name="capital_social"]').val(data.capital_social);

                    // Preenche Atividade Principal e CNAE
                    if (data.atividade_principal && data.atividade_principal.length > 0) {
                        modal.find('textarea[name="atividade_principal"]').val(data.atividade_principal[0].text);
                        modal.find('input[name="cnae"]').val(data.atividade_principal[0].code.replace(/[^0-9]/g, ''));
                    }

                    // Preenche Quadro de Sócios e Administradores (QSA)
                    if (data.qsa && data.qsa.length > 0) {
                        const qsaText = data.qsa.map(socio => `Sócio: ${socio.nome}\nQualificação: ${socio.qual}`).join('\n\n');
                        modal.find('textarea[name="qsa"]').val(qsaText);
                    }

                    // Trata os campos complexos de Estado e Cidade
                    const stateSelect = modal.find('select[name="uf"]');
                    const citySelect = modal.find('select[name="cidade"]');

                    if (data.uf) {
                        stateSelect.val(data.uf).trigger('change');
                        if (data.municipio) {
                            $.ajax({
                                type: 'GET',
                                url: `<?= base_url('index.php/ibge/search_cities'); ?>/${data.uf}`,
                                data: { term: data.municipio },
                                dataType: 'json'
                            }).done(function(cityResponse) {
                                if (cityResponse.results && cityResponse.results.length > 0) {
                                    const cityData = cityResponse.results.find(c => c.text.toLowerCase() === data.municipio.toLowerCase());
                                    if (cityData) {
                                        const option = new Option(cityData.text, cityData.id, true, true);
                                        citySelect.append(option).trigger('change');
                                        citySelect.trigger({ type: 'select2:select', params: { data: cityData } });
                                    }
                                }
                            });
                        }
                    }
                } else {
                    Swal.fire({ icon: 'error', title: 'Atenção', text: `CNPJ não encontrado: ${data.message}` });
                    modal.find('input[name="nome"], input[name="cep"], input[name="logradouro"], input[name="numero"], input[name="bairro"], input[name="email"], input[name="telefone"]').val('');
                }
            }).fail(function() {
                modal.find('input, select, textarea').prop('readonly', false);
                modal.find('input[name="nome"], input[name="cep"], input[name="logradouro"], input[name="numero"], input[name="bairro"], input[name="email"], input[name="telefone"], textarea[name="atividade_principal"], input[name="cnae"], textarea[name="qsa"]').val('');
                Swal.fire({ icon: 'error', title: 'Atenção', text: 'Não foi possível consultar o CNPJ. Verifique sua conexão ou tente novamente.' });
            });
        });
    });
</script>
