<style>
    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
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
    
    .img-main-label input[type="radio"], .img-main-label input[type="checkbox"] {
        margin: 0;
    }

    #add-image-button {
        cursor: pointer;
        width: 160px; /* Largura limitada */
    }

    .ui-autocomplete {
        z-index: 9999 !important;
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </span>
                <h5>Cadastro de Produto</h5>
            </div>
            <div class="widget-content nopadding tab-content">
                <?php echo $custom_error ?? ''; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="control-group">
                        <label for="codDeBarra" class="control-label">Código de Barra<span class=""></span></label>
                        <div class="controls">
                            <div style="display: flex; gap: 5px;">
                                <input id="codDeBarra" type="text" name="codDeBarra" value="<?php echo set_value('codDeBarra'); ?>" tabindex="1" placeholder="Código de Barra" aria-label="Código de Barra" style="margin-bottom: 0;" />
                                <button id="buscar_info_gtin" class="btn btn-warning" type="button" title="Consultar GTIN (Cosmos)" tabindex="2" style="padding: 6px 10px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" name="descricao" maxlength="255" value="<?php echo set_value('descricao'); ?>" tabindex="3" placeholder="Descrição do produto" aria-label="Descrição do produto" aria-required="true" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada
                                <input type="checkbox" id="entrada" name="entrada" class="badgebox" value="1" checked tabindex="4" aria-label="Tipo de Movimento: Entrada">
                                <span class="badge">&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída
                                <input type="checkbox" id="saida" name="saida" class="badgebox" value="1" checked tabindex="5" aria-label="Tipo de Movimento: Saída">
                                <span class="badge">&check;</span>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoCompra" value="<?php echo set_value('precoCompra'); ?>" tabindex="6" placeholder="0.00" aria-label="Preço de Compra" aria-required="true" />
                            <strong><span style="color: red" id="errorAlert"></span><strong>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="Lucro" class="control-label">Lucro</label>
                        <div class="controls">
                            <select id="selectLucro" name="selectLucro" style="width: 10.5em;" tabindex="7" aria-label="Tipo de Lucro">
                              <option value="markup">Markup</option>
                              <option value="margemLucro">Margem de Lucro</option>
                            </select>
                            <input style="width: 4em;" id="Lucro" name="Lucro" type="text" placeholder="%" maxlength="3" size="2" tabindex="8" aria-label="Porcentagem de Lucro" />
                            <i class="icon-info-sign tip-left" title="Markup: Porcentagem aplicada ao valor de compra | Margem de Lucro: Porcentagem aplicada ao valor de venda"></i>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money" data-affixes-stay="true" data-thousands="" data-decimal="." type="text" name="precoVenda" value="<?php echo set_value('precoVenda'); ?>" tabindex="9" placeholder="0.00" aria-label="Preço de Venda" aria-required="true" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                        <div class="controls">
                            <select id="unidade" name="unidade" tabindex="10" aria-label="Unidade de medida" aria-required="true"></select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo set_value('estoque'); ?>" tabindex="11" placeholder="0" aria-label="Quantidade em estoque" aria-required="true" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                        <div class="controls">
                            <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="<?php echo set_value('estoqueMinimo'); ?>" tabindex="12" placeholder="0" aria-label="Estoque Mínimo" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="url_pagina" class="control-label">Página do Produto (URL)</label>
                        <div class="controls">
                            <input id="url_pagina" type="text" name="url_pagina" value="<?php echo set_value('url_pagina'); ?>" tabindex="13" placeholder="https://..." aria-label="Página do Produto (URL)" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="url_especificacoes" class="control-label">Especificações (URL)</label>
                        <div class="controls">
                            <input id="url_especificacoes" type="text" name="url_especificacoes" value="<?php echo set_value('url_especificacoes'); ?>" tabindex="14" placeholder="https://..." aria-label="Especificações (URL)" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="ncm" class="control-label">NCM<span class="required">*</span></label>
                        <div class="controls">
                            <input id="ncm" type="text" name="ncm" value="<?php echo set_value('ncm'); ?>" placeholder="Ex: 84713012" maxlength="8" tabindex="15" aria-label="NCM" aria-required="true" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="cest" class="control-label">CEST</label>
                        <div class="controls">
                            <input id="cest" type="text" name="cest" value="<?php echo set_value('cest'); ?>" placeholder="Ex: 21.040.00" maxlength="9" tabindex="16" aria-label="CEST" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="origem" class="control-label">Origem</label>
                        <div class="controls">
                            <select id="origem" name="origem" tabindex="17" aria-label="Origem do produto">
                                <option value="">Selecione...</option>
                                <option value="0">0 - Nacional</option>
                                <option value="1">1 - Estrangeira - Importação direta</option>
                                <option value="2">2 - Estrangeira - Adquirida no mercado interno</option>
                                <option value="3">3 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40%</option>
                                <option value="4">4 - Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos de que tratam o Decreto-Lei nº 288/67</option>
                                <option value="5">5 - Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40%</option>
                                <option value="6">6 - Estrangeira - Importação direta, sem similar nacional, constante em lista de Resolução CAMEX</option>
                                <option value="7">7 - Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução CAMEX</option>
                                <option value="8">8 - Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70%</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="cst_csosn" class="control-label">CST/CSOSN<span class="required">*</span></label>
                        <div class="controls">
                            <select id="cst_csosn" name="cst_csosn" tabindex="18" aria-label="CST/CSOSN" aria-required="true">
                                <optgroup label="Simples Nacional (CSOSN)">
                                    <option value="101" <?php echo set_select('cst_csosn', '101'); ?>>101 - Tributada com permissão de crédito</option>
                                    <option value="102" <?php echo set_select('cst_csosn', '102', true); ?>>102 - Tributada sem permissão de crédito</option>
                                    <option value="103" <?php echo set_select('cst_csosn', '103'); ?>>103 - Isenção do ICMS para faixa de receita bruta</option>
                                    <option value="201" <?php echo set_select('cst_csosn', '201'); ?>>201 - Tributada com permissão de crédito e com ST</option>
                                    <option value="202" <?php echo set_select('cst_csosn', '202'); ?>>202 - Tributada sem permissão de crédito e com ST</option>
                                    <option value="203" <?php echo set_select('cst_csosn', '203'); ?>>203 - Isenção do ICMS e com cobrança do ICMS por ST</option>
                                    <option value="300" <?php echo set_select('cst_csosn', '300'); ?>>300 - Imune</option>
                                    <option value="400" <?php echo set_select('cst_csosn', '400'); ?>>400 - Não tributada</option>
                                    <option value="500" <?php echo set_select('cst_csosn', '500'); ?>>500 - ICMS cobrado anteriormente por ST</option>
                                    <option value="900" <?php echo set_select('cst_csosn', '900'); ?>>900 - Outros</option>
                                </optgroup>
                                <optgroup label="Regime Normal (CST)">
                                    <option value="00" <?php echo set_select('cst_csosn', '00'); ?>>00 - Tributada integralmente</option>
                                    <option value="10" <?php echo set_select('cst_csosn', '10'); ?>>10 - Tributada e com cobrança do ICMS por ST</option>
                                    <option value="20" <?php echo set_select('cst_csosn', '20'); ?>>20 - Com redução de base de cálculo</option>
                                    <option value="30" <?php echo set_select('cst_csosn', '30'); ?>>30 - Isenta ou não tributada e com cobrança do ICMS por ST</option>
                                    <option value="40" <?php echo set_select('cst_csosn', '40'); ?>>40 - Isenta</option>
                                    <option value="41" <?php echo set_select('cst_csosn', '41'); ?>>41 - Não tributada</option>
                                    <option value="50" <?php echo set_select('cst_csosn', '50'); ?>>50 - Suspensão</option>
                                    <option value="51" <?php echo set_select('cst_csosn', '51'); ?>>51 - Diferimento</option>
                                    <option value="60" <?php echo set_select('cst_csosn', '60'); ?>>60 - ICMS cobrado anteriormente por ST</option>
                                    <option value="70" <?php echo set_select('cst_csosn', '70'); ?>>70 - Com redução de BC e cobrança do ICMS por ST</option>
                                    <option value="90" <?php echo set_select('cst_csosn', '90'); ?>>90 - Outras</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="ibs_cbs" class="control-label">IBS/CBS</label>
                        <div class="controls">
                            <input id="ibs_cbs" type="text" name="ibs_cbs" value="<?php echo set_value('ibs_cbs', 'CBS: 0.90% | IBS: 0.10%'); ?>" tabindex="19" readonly aria-label="IBS/CBS" />
                            <span class="help-inline">Fixo informativo conforme NT 2025.002 (Transição).</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="aliquota_icms" class="control-label">Alíquota ICMS (%)</label>
                        <div class="controls">
                            <input id="aliquota_icms" class="money" type="text" name="aliquota_icms" value="<?php echo set_value('aliquota_icms'); ?>" placeholder="Ex: 18.00" tabindex="20" aria-label="Alíquota ICMS" />
                            <span class="help-inline">Informe a porcentagem do imposto (Apenas para produtos de Regime Normal).</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Imagens do Produto</label>
                        <div class="controls">
                            <label tabindex="21" id="add-image-button" for="userfile" class="button btn btn-mini btn-info"><span class="button__icon"><i class='bx bx-image-add'></i></span><span class="button__text2">Adicionar Imagens</span></label>
                            <input id="userfile" type="file" name="userfile[]" multiple accept="image/*" style="display: none;" />
                            <p class="help-block">Tamanho máximo: 2MB. Resolução máxima: 2000x2000px.</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Pré-visualização</label>
                        <div class="controls">
                            <ul id="image-preview" class="thumbnails">
                                <!-- Previsões aparecerão aqui -->
                            </ul>
                            <input type="hidden" name="principal_index" id="principal_index" value="">
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3" style="display: flex;justify-content: center">
                                <button type="submit" class="button btn btn-mini btn-success" style="max-width: 160px" tabindex="22"><span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Adicionar</span></button>
                                <a href="<?php echo base_url() ?>index.php/produtos" id="" class="button btn btn-mini btn-warning" tabindex="23"><span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript">
    let selectedFiles = new DataTransfer();

    document.getElementById('userfile').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('image-preview');
        const files = Array.from(e.target.files);

        files.forEach(file => {
            if (file.type.startsWith("image/") && !Array.from(selectedFiles.files).some(f => f.name === file.name && f.size === file.size)) {
                selectedFiles.items.add(file);
            }
        });
        
        renderPreviews();
        this.files = selectedFiles.files;
    });

    function renderPreviews() {
        const previewContainer = document.getElementById('image-preview');
        const currentPrincipal = document.getElementById('principal_index').value;
        previewContainer.innerHTML = '';

        Array.from(selectedFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const li = document.createElement('li');
                li.className = 'span2';
                li.id = 'preview-' + index;
                li.innerHTML = `
                    <div class="thumbnail img-container">
                        <img src="${event.target.result}" style="height: 120px; width: 100%; object-fit: cover;">
                        <div class="img-main-label">
                             <input type="radio" name="temp_principal" class="set-principal tip-top" title="Marcar como Principal" value="${index}" ${currentPrincipal == index || (currentPrincipal === '' && index === 0) ? 'checked' : ''}>
                        </div>
                        <div class="img-controls">
                            <button type="button" class="btn btn-danger btn-mini remove-image tip-top" title="Excluir imagem da lista" data-index="${index}"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                `;
                previewContainer.appendChild(li);
                
                if (currentPrincipal === '' && index === 0) {
                    document.getElementById('principal_index').value = 0;
                }
                $('.tip-top').tooltip({placement: 'top'});
            };
            reader.readAsDataURL(file);
        });
    }

    $(document).on('change', '.set-principal', function() {
        document.getElementById('principal_index').value = $(this).val();
    });

    $(document).on('click', '.remove-image', function() {
        const indexToRemove = $(this).data('index');
        const newDataTransfer = new DataTransfer();
        let wasPrincipal = document.getElementById('principal_index').value == indexToRemove;

        Array.from(selectedFiles.files).forEach((file, i) => {
            if (i !== indexToRemove) {
                newDataTransfer.items.add(file);
            }
        });

        selectedFiles = newDataTransfer;
        document.getElementById('userfile').files = selectedFiles.files;
        
        if (wasPrincipal) {
            document.getElementById('principal_index').value = selectedFiles.files.length > 0 ? 0 : '';
        } else if (document.getElementById('principal_index').value > indexToRemove) {
            document.getElementById('principal_index').value -= 1;
        }

        renderPreviews();
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

    $('#precoVenda').focusout(function () {
        if (Number($('#precoVenda').val()) < Number($("#precoCompra").val())) {
            $('#errorAlert').text('Preço de venda não pode ser menor que o preço de compra.').css("display", "inline").fadeOut(6000);
            $('#precoVenda').val('');
        }
    });

    $(document).ready(function() {
        $(".money").maskMoney();
        $("#cest").mask("00.000.00");
        $.getJSON('<?php echo base_url() ?>assets/json/tabela_medidas.json', function(data) {
            for (i in data.medidas) {
                $('#unidade').append(new Option(data.medidas[i].descricao, data.medidas[i].sigla));
            }
        });
        $('#formProduto').validate({
            ignore: ":hidden, .ignore",
            rules: {
                descricao: { required: true },
                unidade: { required: true },
                precoCompra: { required: true },
                precoVenda: { required: true },
                estoque: { required: true },
                ncm: { required: true },
                cst_csosn: { required: true }
            },
            messages: {
                descricao: { required: 'Campo Requerido.' },
                unidade: { required: 'Campo Requerido.' },
                precoCompra: { required: 'Campo Requerido.' },
                precoVenda: { required: 'Campo Requerido.' },
                estoque: { required: 'Campo Requerido.' },
                ncm: { required: 'Campo Requerido.' },
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
                    success: function(data) {
                        response(data);
                    },
                    error: function() {
                        response([]);
                    }
                });
            },
            minLength: 2
        });

        $('#buscar_info_gtin').on('click', function() {
            var gtin = $('#codDeBarra').val();
            if (gtin.length < 8) {
                swal("Atenção", "Digite um GTIN válido (8 a 14 dígitos) no Código de Barras.", "warning");
                return;
            }

            var btn = $(this);
            var originalHtml = btn.html();
            btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

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

        $("#add-image-button").on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) {
                e.preventDefault();
                document.getElementById('userfile').click();
            }
        });
    });
</script>
