<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<style>
    .badgebox {
        opacity: 0;
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

    .form-horizontal .control-label {
        text-align: left;
    }

    .required {
        color: red;
        margin-left: 5px;
    }

    .nopadding {
        padding: 0 20px !important;
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
        border: none !important;
    }

    .accordion-heading a {
        padding: 12px 15px;
        display: block;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
    }

    .accordion-body {
        display: none;
        padding: 20px;
    }

    .accordion-body.in {
        display: block;
    }

    .img-container {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .img-controls {
        position: absolute;
        top: 5px;
        right: 5px;
        display: flex;
        gap: 5px;
        background: rgba(255, 255, 255, 0.7);
        padding: 2px;
        border-radius: 3px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .img-container:hover .img-controls {
        opacity: 1;
    }

    .img-main-label {
        position: absolute;
        top: 5px;
        left: 5px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 3px;
        padding: 2px;
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .img-container:hover .img-main-label {
        opacity: 1;
    }

    .img-main-label input[type="radio"],
    .img-main-label input[type="checkbox"] {
        margin: 0;
    }

    #image-preview > li {
        width: 220px;
        margin-right: 12px;
        margin-bottom: 12px;
    }

    #image-preview .thumbnail {
        margin-bottom: 0;
    }

    #galeria-atual > li {
        width: 220px;
        margin-right: 12px;
        margin-bottom: 12px;
    }

    #galeria-atual .thumbnail {
        margin-bottom: 0;
    }

    .image-landscape-frame {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f7f7f7;
    }

    .image-landscape-frame img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center center;
        image-orientation: from-image;
    }

    .galeria-item-clickable {
        cursor: zoom-in;
    }

    .image-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .image-modal-overlay.open {
        display: flex;
    }

    .image-modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-modal-content img {
        max-width: 90vw;
        max-height: 90vh;
        width: auto;
        height: auto;
        object-fit: contain;
        image-orientation: from-image;
        border-radius: 4px;
        background: #111;
    }

    .image-modal-close {
        position: absolute;
        top: -12px;
        right: -12px;
        min-width: 88px;
        height: 34px;
        padding: 0 14px;
        border: 1px solid #922b21;
        border-radius: 8px;
        background: #c0392b;
        color: #fff;
        font-size: 14px;
        line-height: 34px;
        text-align: center;
        cursor: pointer;
        font-weight: 600;
    }

    .image-modal-close:hover {
        background: #a93226;
    }

    #add-image-button {
        cursor: pointer;
    }

    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 9999 !important;
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
    }

    @media (max-width: 480px) {
        .form-horizontal .control-label {
            margin-bottom: 0;
            font-weight: bold;
            display: block !important;
        }

        #buscar_info_gtin .button__text2 {
            display: none;
        }
    }
</style>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <h5>Editar Produto</h5>
            </div>

            <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="widget-content nopadding">
                    <?php if ($custom_error != '') { echo '<div class="alert alert-danger">' . $custom_error . '</div>'; } ?>
                    <?php if(isset($result->idProdutos)) echo form_hidden('idProdutos', $result->idProdutos) ?>

                    <!-- ============= ACCORDION: DADOS DO PRODUTO ============= -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-produto', this)">
                                <i class="fas fa-chevron-down"></i> <strong>DADOS DO PRODUTO</strong>
                            </a>
                        </div>
                        <div id="collapse-produto" class="accordion-body in">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="codDeBarra" class="control-label">Código de Barra</label>
                                        <div class="controls code_barra" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="codDeBarra" type="text" name="codDeBarra" style="flex: 1;" value="<?php echo isset($result->codDeBarra) ? $result->codDeBarra : ''; ?>" placeholder="Código de Barra" aria-label="Código de Barra" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="codDeFabrica" class="control-label">Código de Fábrica</label>
                                        <div class="controls code_fabrica" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="codDeFabrica" type="text" name="codDeFabrica" value="<?php echo isset($result->codDeFabrica) ? $result->codDeFabrica : ''; ?>" placeholder="Código de Fábrica" aria-label="Código de Fábrica" style="margin-bottom: 0; flex: 1;" />
                                            <button id="buscar_info_gtin" class="button btn btn-mini btn-warning" type="button" title="Consultar GTIN (Cosmos)" style="flex-shrink: 0; margin-right: 0;"><span class="button__icon"><i class="bx bx-search-alt"></i></span><span class="button__text2">Consultar</span></button>
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="nome" class="control-label">Nome do Produto<span class="required">*</span></label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="nome" type="text" name="nome" maxlength="255" style="width: 100%;" value="<?php echo isset($result->nome) ? $result->nome : ''; ?>" placeholder="Nome do produto" aria-label="Nome do produto" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                                        <div class="controls" style="display: flex; gap: 8px; height: 100%;">
                                            <textarea id="descricao" name="descricao" style="display: flex; flex: 1;" placeholder="Descrição do produto" aria-label="Descrição do produto" aria-required="true"><?php echo isset($result->descricao) ? $result->descricao : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="modelo" class="control-label">Modelo</label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="modelo" type="text" name="modelo" style="width: 100%;" value="<?php echo isset($result->modelo) ? $result->modelo : ''; ?>" placeholder="Modelo do produto" aria-label="Modelo do produto" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="fabricante" class="control-label">Fabricante</label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="fabricante" type="text" name="fabricante" style="width: 100%;" value="<?php echo isset($result->fabricante) ? $result->fabricante : ''; ?>" placeholder="Fabricante do produto" aria-label="Fabricante do produto" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tipo de Movimento</label>
                                        <div class="controls" style="display: flex; gap: 20px; align-items: center;">
                                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                                <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" <?= (isset($result->entrada) && $result->entrada == 1) ? 'checked' : '' ?> aria-label="Tipo de Movimento: Entrada" style="position: absolute; opacity: 0;" />
                                                <span class="badge">&check;</span>
                                            </label>
                                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                                <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" <?= (isset($result->saida) && $result->saida == 1) ? 'checked' : '' ?> aria-label="Tipo de Movimento: Saída" style="position: absolute; opacity: 0;" />
                                                <span class="badge">&check;</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="precoCompra" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo isset($result->precoCompra) ? $result->precoCompra : ''; ?>" placeholder="0.00" aria-label="Preço de Compra" aria-required="true" />
                                            <strong><span style="color: red" id="errorAlert"></span></strong>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="Lucro" class="control-label">Lucro</label>
                                        <div class="controls" style="display: flex; gap: 10px; align-items: center; max-width: 325px;">
                                            <select id="selectLucro" name="selectLucro" style="width: auto; flex: 1;" aria-label="Tipo de Lucro">
                                                <option value="markup">Markup</option>
                                                <option value="margemLucro">Margem de Lucro</option>
                                            </select>
                                            <input style="width: 4em;" id="Lucro" name="Lucro" type="text" placeholder="%" maxlength="3" size="2" aria-label="Porcentagem de Lucro" />
                                            <i class="icon-info-sign tip-left" title="Markup: Porcentagem aplicada ao valor de compra | Margem de Lucro: Porcentagem aplicada ao valor de venda"></i>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="<?php echo isset($result->precoVenda) ? $result->precoVenda : ''; ?>" placeholder="0.00" aria-label="Preço de Venda" aria-required="true" />
                                        </div>
                                    </div>
                                </div>

                                <div class="span6">
                                    <div class="control-group">
                                        <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                                        <div class="controls">
                                            <select id="unidade" name="unidade" aria-label="Unidade de medida" aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="estoque" type="text" name="estoque" value="<?php echo isset($result->estoque) ? $result->estoque : ''; ?>" placeholder="0" aria-label="Quantidade em estoque" aria-required="true" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                                        <div class="controls">
                                            <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="<?php echo isset($result->estoqueMinimo) ? $result->estoqueMinimo : ''; ?>" placeholder="0" aria-label="Estoque Mínimo" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="url_pagina" class="control-label">Página do Produto (URL)</label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="url_pagina" type="text" name="url_pagina" style="flex: 1;" value="<?php echo isset($result->url_pagina) ? $result->url_pagina : ''; ?>" placeholder="https://..." aria-label="Página do Produto (URL)" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="url_especificacoes" class="control-label">Especificações (URL)</label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="url_especificacoes" type="text" name="url_especificacoes" style="flex: 1;" value="<?php echo isset($result->url_especificacoes) ? $result->url_especificacoes : ''; ?>" placeholder="https://..." aria-label="Especificações (URL)" />
                                        </div>
                                    </div>
                                    <div class="control-group" style="max-width: 600px;">
                                        <label for="url_manual" class="control-label">Manual (URL)</label>
                                        <div class="controls" style="display: flex; gap: 8px; max-height: 30px;">
                                            <input id="url_manual" type="text" name="url_manual" style="flex: 1;" value="<?php echo isset($result->url_manual) ? $result->url_manual : ''; ?>" placeholder="https://..." aria-label="Manual (URL)" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Adicionar Imagens</label>
                                        <div class="controls">
                                            <label id="add-image-button" for="userfile" class="button btn btn-mini btn-info" style="max-width: 160px;"><span class="button__icon"><i class='bx bx-image-add'></i></span><span class="button__text2">Adicionar Imagens</span></label>
                                            <input id="userfile" type="file" name="userfile[]" multiple accept="image/*" style="display: none;" />
                                            <p class="help-block" style="width: 100%; margin-top: 5px;">Tamanho máximo: 2MB. Resolução máxima: 2000x2000px.</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Pré-visualização</label>
                                        <div class="controls">
                                            <ul id="image-preview" class="thumbnails" style="width: 100%;">
                                                <!-- Pré-visualizações aparecerão aqui -->
                                            </ul>
                                            <input type="hidden" name="principal_index" id="principal_index" value="">
                                            <input type="hidden" name="temp_principal_id" id="temp_principal_id" value="<?php echo set_value('temp_principal_id', ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============= ACCORDION: DADOS FISCAIS ============= -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-fiscal', this)">
                                <i class="fas fa-chevron-down"></i> <strong>DADOS FISCAIS</strong>
                            </a>
                        </div>
                        <div id="collapse-fiscal" class="accordion-body in">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="ncm" class="control-label">NCM</label>
                                        <div class="controls">
                                            <input id="ncm" type="text" name="ncm" value="<?php echo isset($result->ncm) ? $result->ncm : ''; ?>" placeholder="Ex: 84713012" maxlength="8" aria-label="NCM" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="cest" class="control-label">CEST</label>
                                        <div class="controls">
                                            <input id="cest" type="text" name="cest" value="<?php echo isset($result->cest) ? $result->cest : ''; ?>" placeholder="Ex: 21.040.00" maxlength="9" aria-label="CEST" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="origem" class="control-label">Origem</label>
                                        <div class="controls">
                                            <select id="origem" name="origem" aria-label="Origem do produto">
                                                <option value="">Selecione...</option>
                                                <option value="0" <?= (isset($result->origem) && $result->origem == '0') ? 'selected' : '' ?>>0 - Nacional</option>
                                                <option value="1" <?= (isset($result->origem) && $result->origem == '1') ? 'selected' : '' ?>>1 - Estrangeira - Importação direta</option>
                                                <option value="2" <?= (isset($result->origem) && $result->origem == '2') ? 'selected' : '' ?>>2 - Estrangeira - Adquirida no mercado interno</option>
                                                <option value="3" <?= (isset($result->origem) && $result->origem == '3') ? 'selected' : '' ?>>3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40%</option>
                                                <option value="4" <?= (isset($result->origem) && $result->origem == '4') ? 'selected' : '' ?>>4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam o Decreto-Lei nº 288/67</option>
                                                <option value="5" <?= (isset($result->origem) && $result->origem == '5') ? 'selected' : '' ?>>5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%</option>
                                                <option value="6" <?= (isset($result->origem) && $result->origem == '6') ? 'selected' : '' ?>>6 - Estrangeira - Importação direta, sem similar nacional, constante em lista de Resolução CAMEX</option>
                                                <option value="7" <?= (isset($result->origem) && $result->origem == '7') ? 'selected' : '' ?>>7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução CAMEX</option>
                                                <option value="8" <?= (isset($result->origem) && $result->origem == '8') ? 'selected' : '' ?>>8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70%</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label for="cst_csosn" class="control-label">CST/CSOSN<span class="required">*</span></label>
                                        <div class="controls">
                                            <select id="cst_csosn" name="cst_csosn" aria-label="CST/CSOSN" aria-required="true">
                                                <optgroup label="Simples Nacional (CSOSN)">
                                                    <option value="101" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '101') ? 'selected' : ''; ?>>101 - Tributada com permissão de crédito</option>
                                                    <option value="102" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '102') ? 'selected' : ''; ?>>102 - Tributada sem permissão de crédito</option>
                                                    <option value="103" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '103') ? 'selected' : ''; ?>>103 - Isenção do ICMS para faixa de receita bruta</option>
                                                    <option value="201" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '201') ? 'selected' : ''; ?>>201 - Tributada com permissão de crédito e com ST</option>
                                                    <option value="202" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '202') ? 'selected' : ''; ?>>202 - Tributada sem permissão de crédito e com ST</option>
                                                    <option value="203" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '203') ? 'selected' : ''; ?>>203 - Isenção do ICMS e com cobrança do ICMS por ST</option>
                                                    <option value="300" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '300') ? 'selected' : ''; ?>>300 - Imune</option>
                                                    <option value="400" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '400') ? 'selected' : ''; ?>>400 - Não tributada</option>
                                                    <option value="500" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '500') ? 'selected' : ''; ?>>500 - ICMS cobrado anteriormente por ST</option>
                                                    <option value="900" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '900') ? 'selected' : ''; ?>>900 - Outros</option>
                                                </optgroup>
                                                <optgroup label="Regime Normal (CST)">
                                                    <option value="00" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '00') ? 'selected' : ''; ?>>00 - Tributada integralmente</option>
                                                    <option value="10" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '10') ? 'selected' : ''; ?>>10 - Tributada e com cobrança do ICMS por ST</option>
                                                    <option value="20" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '20') ? 'selected' : ''; ?>>20 - Com redução de base de cálculo</option>
                                                    <option value="30" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '30') ? 'selected' : ''; ?>>30 - Isenta ou não tributada e com cobrança do ICMS por ST</option>
                                                    <option value="40" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '40') ? 'selected' : ''; ?>>40 - Isenta</option>
                                                    <option value="41" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '41') ? 'selected' : ''; ?>>41 - Não tributada</option>
                                                    <option value="50" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '50') ? 'selected' : ''; ?>>50 - Suspensão</option>
                                                    <option value="51" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '51') ? 'selected' : ''; ?>>51 - Diferimento</option>
                                                    <option value="60" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '60') ? 'selected' : ''; ?>>60 - ICMS cobrado anteriormente por ST</option>
                                                    <option value="70" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '70') ? 'selected' : ''; ?>>70 - Com redução de BC e cobrança do ICMS por ST</option>
                                                    <option value="90" <?php echo (isset($result->cst_csosn) && $result->cst_csosn == '90') ? 'selected' : ''; ?>>90 - Outras</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="ibs_cbs" class="control-label">IBS/CBS</label>
                                        <div class="controls" style="flex-direction: column; align-items: flex-start;">
                                            <input id="ibs_cbs" type="text" name="ibs_cbs" value="<?php echo isset($result->ibs_cbs) && !empty($result->ibs_cbs) ? $result->ibs_cbs : 'CBS: 0.90% | IBS: 0.10%'; ?>" readonly aria-label="IBS/CBS" />
                                            <span class="help-inline">Fixo informativo conforme NT 2025.002 (Transição).</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="aliquota_icms" class="control-label">Alíquota ICMS (%)</label>
                                        <div class="controls" style="flex-direction: column; align-items: flex-start;">
                                            <input id="aliquota_icms" class="money" type="text" name="aliquota_icms" value="<?php echo set_value('aliquota_icms', isset($result->aliquota_icms) ? $result->aliquota_icms : ''); ?>" placeholder="Ex: 18.00" aria-label="Alíquota ICMS" />
                                            <span class="help-inline">Informe a porcentagem do imposto (Apenas para produtos de Regime Normal).</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============= ACCORDION: IMAGENS ============= -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" href="javascript:void(0)" onclick="toggleAccordion('collapse-imagens', this)">
                                <i class="fas fa-chevron-down"></i> <strong>IMAGENS ATUAIS</strong>
                            </a>
                        </div>
                        <div id="collapse-imagens" class="accordion-body in">
                            <div class="control-group">
                                <label class="control-label">Galeria Atual</label>
                                <div class="controls">
                                    <?php if (isset($images) && is_array($images)) : ?>
                                    <ul id="galeria-atual" class="thumbnails" style="width: 100%;">
                                        <?php foreach ($images as $img) : ?>
                                            <li class="span2" id="img-<?php echo $img->idImagens; ?>">
                                                <div class="thumbnail img-container">
                                                    <div class="image-landscape-frame">
                                                        <img class="galeria-item-clickable" src="<?php echo !empty($img->url) ? $img->url : $img->thumb; ?>" data-full-src="<?php echo !empty($img->url) ? $img->url : $img->thumb; ?>" alt="Imagem do produto">
                                                    </div>
                                                    <div class="img-main-label">
                                                         <input type="checkbox" class="marcar-principal tip-top" title="Marcar como Principal" data-id="<?php echo $img->idImagens; ?>" data-produto="<?php echo isset($result->idProdutos) ? $result->idProdutos : ''; ?>" <?php echo ($img->principal == 1) ? 'checked' : ''; ?>>
                                                    </div>
                                                    <div class="img-controls">
                                                        <button type="button" class="btn btn-danger btn-mini btn-excluir-imagem tip-top" title="Excluir imagem do servidor" data-id="<?php echo $img->idImagens; ?>"><i class="bx bx-trash"></i></button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php else : ?>
                                    <p class="help-block">Nenhuma imagem cadastrada para este produto.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3" style="display: flex; justify-content: center; gap: 10px;">
                            <button type="submit" class="button btn btn-mini btn-success" style="width: 120px;">
                                <span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span>
                            </button>
                            <a href="<?php echo base_url() ?>index.php/produtos" id="btn-voltar-produtos" class="button btn btn-mini btn-warning" style="width: 120px;">
                                <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="image-modal" class="image-modal-overlay" aria-hidden="true">
    <div class="image-modal-content">
        <button type="button" id="image-modal-close" class="image-modal-close" aria-label="Fechar">Fechar</button>
        <img id="image-modal-img" src="" alt="Imagem ampliada">
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
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

    const csrfTokenName = "<?php echo $this->security->get_csrf_token_name(); ?>";
    let csrfTokenValue = "<?php echo $this->security->get_csrf_hash(); ?>";
    const produtoId = <?php echo isset($result->idProdutos) ? (int) $result->idProdutos : 0; ?>;
    let tempImages = <?php echo json_encode(isset($temp_images) ? $temp_images : []); ?>;
    const imageModal = $('#image-modal');
    const imageModalImg = $('#image-modal-img');

    function abrirModalImagem(src) {
        if (!src) {
            return;
        }

        imageModalImg.attr('src', src);
        imageModal.addClass('open').attr('aria-hidden', 'false');
        $('body').css('overflow', 'hidden');
    }

    function fecharModalImagem() {
        imageModal.removeClass('open').attr('aria-hidden', 'true');
        imageModalImg.attr('src', '');
        $('body').css('overflow', '');
    }

    function renderPreviews() {
        const previewContainer = document.getElementById('image-preview');
        const tempPrincipalInput = document.getElementById('temp_principal_id');
        let currentPrincipal = tempPrincipalInput.value;
        const hasExistingPrincipalImage = $('.marcar-principal:checked').length > 0;

        if (currentPrincipal === '' && tempImages.length > 0 && !hasExistingPrincipalImage) {
            currentPrincipal = tempImages[0].temp_id;
            tempPrincipalInput.value = currentPrincipal;
        }

        previewContainer.innerHTML = '';

        tempImages.forEach((img) => {
            const li = document.createElement('li');
            li.className = 'span2';
            li.id = 'preview-' + img.temp_id;
            li.innerHTML = `
                <div class="thumbnail img-container">
                    <div class="image-landscape-frame">
                        <img src="${img.url || img.thumb}" alt="${img.name || ''}">
                    </div>
                    <div class="img-main-label">
                         <input type="radio" name="temp_principal" class="set-principal-temp tip-top" title="Marcar como Principal" value="${img.temp_id}" ${currentPrincipal == img.temp_id ? 'checked' : ''}>
                    </div>
                    <div class="img-controls">
                        <button type="button" class="btn btn-danger btn-mini remove-image-temp tip-top" title="Remover da lista" data-temp-id="${img.temp_id}"><i class="bx bx-trash"></i></button>
                    </div>
                </div>
            `;
            previewContainer.appendChild(li);
        });

        $('.tip-top').tooltip({placement: 'top'});
    }

    function uploadTempImages(files) {
        if (!files.length) {
            return;
        }

        const uploads = files
            .filter(file => file.type.startsWith('image/'))
            .map(file => {
                const formData = new FormData();
                formData.append('userfile', file);
                formData.append('idProduto', produtoId);
                formData.append(csrfTokenName, csrfTokenValue);

                return $.ajax({
                    url: "<?php echo site_url('produtos/uploadImagemTemporaria'); ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json'
                }).done(function(response) {
                    if (response && response.result && response.image) {
                        tempImages.push(response.image);
                        if (response.csrfHash) {
                            csrfTokenValue = response.csrfHash;
                        }
                    } else {
                        swal('Erro', (response && response.message) ? response.message : 'Não foi possível enviar a imagem.', 'error');
                    }
                }).fail(function(xhr) {
                    let message = 'Não foi possível enviar a imagem.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    swal('Erro', message, 'error');
                });
            });

        Promise.all(uploads).then(function() {
            renderPreviews();
            document.getElementById('userfile').value = '';
        });
    }

    document.getElementById('userfile').addEventListener('change', function(e) {
        uploadTempImages(Array.from(e.target.files || []));
    });

    $(document).on('change', '.set-principal-temp', function() {
        document.getElementById('temp_principal_id').value = $(this).val();
        document.getElementById('principal_index').value = '';
        $('.marcar-principal').prop('checked', false);
    });

    $(document).on('click', '.remove-image-temp', function() {
        const tempId = $(this).data('temp-id');
        $.ajax({
            url: '<?php echo site_url('produtos/removerImagemTemporaria'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                idProduto: produtoId,
                temp_id: tempId,
                [csrfTokenName]: csrfTokenValue
            },
            success: function(response) {
                if (response && response.csrfHash) {
                    csrfTokenValue = response.csrfHash;
                }
                if (response && response.result) {
                    tempImages = tempImages.filter(img => img.temp_id !== tempId);
                    if (document.getElementById('temp_principal_id').value === String(tempId)) {
                        document.getElementById('temp_principal_id').value = '';
                    }
                    renderPreviews();
                } else {
                    swal('Erro', (response && response.message) ? response.message : 'Erro ao remover imagem temporária.', 'error');
                }
            },
            error: function() {
                swal('Erro', 'Erro ao remover imagem temporária.', 'error');
            }
        });
    });

    function calcLucro(precoCompra, Lucro) {
        var lucroTipo = $('#selectLucro').val();
        var precoVenda;

        if (lucroTipo === 'markup') {
            precoVenda = (precoCompra * (1 + Lucro / 100)).toFixed(2);
        } else if (lucroTipo === 'margemLucro') {
            precoVenda = (precoCompra / (1 - (Lucro / 100))).toFixed(2);
        }

        return precoVenda;
    }

    function atualizarPrecoVenda() {
        var precoCompra = Number($("#precoCompra").val());
        var lucro = Number($("#Lucro").val());

        if (precoCompra > 0 && lucro >= 0) {
            $('#precoVenda').val(calcLucro(precoCompra, lucro));
        }
    }

    $("#precoCompra, #Lucro, #selectLucro").on('input change', atualizarPrecoVenda);

    $("#precoCompra, #Lucro").on('input change', function() {
        if ($("#precoCompra").val() == '0.00' && $('#precoVenda').val() != '') {
            $('#errorAlert').text('Você não pode preencher valor de compra e depois apagar.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
            $("#precoCompra").focus();
        } else if ($("#precoCompra").val() != '' && $("#Lucro").val() != '') {
            atualizarPrecoVenda();
        }
    });

    $("#Lucro").keyup(function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
        if ($("#precoCompra").val() == null || $("#precoCompra").val() == '') {
            $('#errorAlert').text('Preencher valor da compra primeiro.').css("display", "inline").fadeOut(5000);
            $('#Lucro').val('');
            $('#precoVenda').val('');
            $("#precoCompra").focus();
        } else if (Number($("#Lucro").val()) >= 0) {
            $('#precoVenda').val(calcLucro(Number($("#precoCompra").val()), Number($("#Lucro").val())));
        } else {
            $('#errorAlert').text('Não é permitido número negativo.').css("display", "inline").fadeOut(5000);
            $('#Lucro').val('');
            $('#precoVenda').val('');
        }
    });

    $('#precoVenda').focusout(function() {
        if (Number($('#precoVenda').val()) < Number($("#precoCompra").val())) {
            $('#errorAlert').text('Preço de venda não pode ser menor que o preço de compra.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
        }
    });

    $(document).ready(function() {
        renderPreviews();

        $(".money").maskMoney();
        $("#cest").mask("00.000.00");
        $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
            for (i in data.medidas) {
                $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
                $("#unidade option[value=" + '<?php echo isset($result->unidade) ? $result->unidade : ''; ?>' + "]").prop("selected", true);
            }
        });
        $('.tip-top').tooltip({placement: 'top'});
        $('#formProduto').validate({
            ignore: ":hidden, .ignore",
            rules: {
                descricao: { required: true },
                unidade: { required: true },
                precoCompra: { required: true },
                precoVenda: { required: true },
                estoque: { required: true },
                cst_csosn: { required: true }
            },
            messages: {
                descricao: { required: 'Campo Requerido.' },
                unidade: { required: 'Campo Requerido.' },
                precoCompra: { required: 'Campo Requerido.' },
                precoVenda: { required: 'Campo Requerido.' },
                estoque: { required: 'Campo Requerido.' },
                cst_csosn: { required: 'Campo Requerido.' }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });

        $("#ncm").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('produtos/autoCompleteNCM'); ?>",
                    dataType: "json",
                    data: { search: request.term },
                    success: function(data) { response(data); },
                    error: function() { response([]); }
                });
            },
            minLength: 2
        });

        $('#buscar_info_gtin').on('click', function() {
            var gtin = $('#codDeFabrica').val();
            if (gtin.length < 8) {
                swal("Atenção", "Digite um GTIN válido (8 a 14 dígitos) no Código de Fábrica.", "warning");
                return;
            }

            var btn = $(this);
            var originalHtml = btn.html();
            btn.html('<span class="button__icon"><i class="bx bx-loader bx-spin"></i></span><span class="button__text2">Consultar</span>').prop('disabled', true);

            $.ajax({
                url: "<?php echo site_url('produtos/consultarCosmos'); ?>",
                type: "GET",
                data: { gtin: gtin },
                dataType: "json",
                success: function(data) {
                    btn.html(originalHtml).prop('disabled', false);
                    if (data.result === false) {
                        swal("Erro", data.message || "Produto não encontrado.", "error");
                    } else {
                        if (data.description) { $('#descricao').val(data.description); }
                        if (data.ncm) { $('#ncm').val(data.ncm.code.replace(/\D/g, '')); }
                        if (data.cest) {
                            var cest = data.cest.code.replace(/\D/g, '');
                            if (cest.length === 7) { cest = cest.substring(0,2) + '.' + cest.substring(2,5) + '.' + cest.substring(5,7); }
                            $('#cest').val(cest);
                        }
                        swal("Sucesso", "Produto encontrado e campos preenchidos!", "success");
                    }
                },
                error: function() { btn.html(originalHtml).prop('disabled', false); swal("Erro", "Erro de conexão com a API.", "error"); }
            });
        });

        $('#cest').on('keyup change', function() {
            var cest = $(this).val().replace(/\D/g, '');
            if (cest.length > 0) {
                if ($('#cst_csosn').val() == '102' || $('#cst_csosn').val() == '101') {
                    $('#cst_csosn').val('500');
                }
            } else {
                if ($('#cst_csosn').val() == '500') {
                    $('#cst_csosn').val('102');
                }
            }
        });

        $(document).on('change', '.marcar-principal', function(e) {
            var id = $(this).data('id');
            var idProduto = $(this).data('produto');
            var checkbox = $(this);

            if (checkbox.is(':checked')) {
                $('.set-principal').prop('checked', false);
                document.getElementById('principal_index').value = '';

                $.ajax({
                    url: '<?php echo site_url('produtos/marcarPrincipal'); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        idProduto: idProduto,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.result) {
                            $('.marcar-principal').not(checkbox).prop('checked', false);
                        } else {
                            alert('Erro ao marcar imagem como principal.');
                            checkbox.prop('checked', false);
                        }
                    }
                });
            } else {
                checkbox.prop('checked', true);
            }
        });

        $(document).on('click', '.btn-excluir-imagem', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm('Deseja realmente excluir esta imagem?')) {
                $.ajax({
                    url: '<?php echo site_url('produtos/excluirImagem'); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.result) {
                            $('#img-' + id).remove();

                            if (Number(response.remainingCount) === 1) {
                                $('.marcar-principal').prop('checked', false);

                                if (response.principalImageId) {
                                    $('.marcar-principal[data-id="' + response.principalImageId + '"]').prop('checked', true);
                                } else {
                                    $('.marcar-principal').first().prop('checked', true);
                                }
                            }
                        } else {
                            alert(response.message || 'Erro ao excluir imagem.');
                        }
                    }
                });
            }
        });

        $("#add-image-button").on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) {
                e.preventDefault();
                document.getElementById('userfile').click();
            }
        });

        $('#btn-voltar-produtos').on('click', function(e) {
            e.preventDefault();
            var redirectUrl = this.href;

            $.ajax({
                url: '<?php echo site_url('produtos/limparImagensTemporariasAjax'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    idProduto: produtoId,
                    [csrfTokenName]: csrfTokenValue
                }
            }).always(function(response) {
                if (response && response.csrfHash) {
                    csrfTokenValue = response.csrfHash;
                }
                window.location.href = redirectUrl;
            });
        });

        $(document).on('click', '.galeria-item-clickable', function(e) {
            if ($(e.target).closest('.img-main-label, .img-controls').length) {
                return;
            }

            abrirModalImagem($(this).data('full-src') || $(this).attr('src'));
        });

        $('#image-modal-close').on('click', function() {
            fecharModalImagem();
        });

        $('#image-modal').on('click', function(e) {
            if (e.target === this) {
                fecharModalImagem();
            }
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && imageModal.hasClass('open')) {
                fecharModalImagem();
            }
        });
    });
</script>
