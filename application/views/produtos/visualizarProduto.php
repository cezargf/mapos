<style>
    .accordion .widget-box {
        border: 1px solid #c8e2d5;
        border-radius: 4px;
    }
    .accordion-heading {
        display: flex;
        align-items: center;   /* filhos ocupam toda a altura */
        min-height: 50px;       /* define uma referência de altura */
        padding: 0 15px;
    }
    .accordion-heading .widget-title {
        display: flex;
        align-items: center;    /* centraliza verticalmente */
        width: 100%;
        height: 100%;
    }
    .accordion-heading .widget-title a {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        gap: 8px;
        text-align: left;
    }
    .accordion-heading .widget-title h5 {
        line-height: 1.2;
        font-size: 16px;
        margin: 0;
    }
    .accordion .widget-content {
        display: flex;
        align-items: stretch;
        gap: 15px;
        padding: 15px;
    }

    .accordion .widget-content > .span6 {
        display: flex;
        flex-direction: column;
        float: none;
        width: 50%;
        margin-left: 0;
        box-sizing: border-box;
    }
    .accordion .widget-content table td {
        padding: 8px;
        vertical-align: middle;
    }
    .accordion-footer {
        display: flex;
        justify-content: center;
        padding: 15px;
        gap: 10px;
    }
    .accordion-footer .button {
        min-width: 140px;
    }

    .product-data-section {
        flex: 1;
        display: flex;
        align-self: stretch;
    }

    .product-data-section .table {
        width: 100%;
        margin-bottom: 0;
        /* background: #fff; */
    }

    .images-section-container {
        display: flex;
        flex-direction: column;
        align-self: stretch;
        margin: 0;
        min-height: 0;
    }
    .images-section {
        flex: 1;
        margin-top: 0;
        padding: 16px;
        border: 1px solid #d8e9df;
        border-radius: 6px;
        background: #f9fcfa;
    }

    .images-section h5 {
        margin: 0 0 12px;
        font-size: 15px;
        color: #2f4f3f;
    }

    .images-section .thumbnails {
        margin: 0;
    }

    .images-section .thumbnails > li {
        width: 220px;
        margin-right: 12px;
        margin-bottom: 12px;
    }

    .images-section .thumbnail {
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

    #modal-visualizar-imagem {
        width: auto;
        max-width: none;
    }

    #modal-visualizar-imagem .modal-body {
        padding: 10px;
        text-align: center;
        max-height: calc(100vh - 140px);
        overflow: hidden;
    }

    #modal-visualizar-imagem #imagem-modal {
        display: block;
        margin: 0 auto;
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: calc(100vh - 160px);
        object-fit: contain;
    }

    @media (max-width: 767px) {
        .accordion .widget-content {
            display: block;
        }

        .accordion .widget-content > .span6 {
            float: none;
            width: 100%;
        }

        .images-section {
            margin-top: 16px;
        }

        .images-section .thumbnails > li {
            width: calc(50% - 12px);
            margin-right: 12px;
        }

        #modal-visualizar-imagem {
            left: 2%;
            right: 2%;
            width: auto;
            margin-left: 0;
        }

        #modal-visualizar-imagem .modal-body {
            max-height: calc(100vh - 120px);
        }

        #modal-visualizar-imagem #imagem-modal {
            max-height: calc(100vh - 140px);
        }
    }

    @media (max-width: 480px) {
        .images-section .thumbnails > li {
            width: 100%;
            margin-right: 0;
        }
        .accordion-footer {
            gap: 5px;
        }
        .accordion-footer .button {
            min-width: 80px;
            margin-bottom: 8px;
        }
    }
</style>
<?php
$dadosProdutoTítulo = 'Visualizar Produto';
if (isset($result->nome)) {
    $dadosProdutoTítulo = $result->nome;
}
?>
<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="fas fa-box"></i></span>
                    <h5><?php echo $dadosProdutoTítulo; ?></h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content tab-content">
                <div class="span6">
                    <div class="product-data-section accordion-group widget-box">
                        <div class="accordion-heading">
                            <div class="widget-title">
                                <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                    <span class="icon"><i class="fas fa-info-circle"></i></span>
                                    <h5>Informações do Produto</h5>
                                </a>
                            </div>
                        </div>
                        <div class="collapse in accordion-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Código de Barra</strong></td>
                                    <td>
                                        <?php echo $result->codDeBarra ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Código de Fábrica</strong></td>
                                    <td>
                                        <?php echo $result->codDeFabrica ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                    <td>
                                        <?php echo $result->nome ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Descrição</strong></td>
                                    <td>
                                        <?php echo $result->descricao ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Modelo</strong></td>
                                    <td>
                                        <?php echo $result->modelo ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Fabricante</strong></td>
                                    <td>
                                        <?php echo $result->fabricante ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Unidade</strong></td>
                                    <td>
                                        <?php echo $result->unidade ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Preço de Compra</strong></td>
                                    <td>R$
                                        <?php echo $result->precoCompra; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Preço de Venda</strong></td>
                                    <td>R$
                                        <?php echo $result->precoVenda; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Estoque</strong></td>
                                    <td>
                                        <?php echo $result->estoque; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                                    <td>
                                        <?php echo $result->estoqueMinimo; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Página do Produto</strong></td>
                                    <td>
                                        <a href="<?php echo $result->url_pagina ?>" target="_blank"><?php echo $result->url_pagina ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Especificações</strong></td>
                                    <td>
                                        <a href="<?php echo $result->url_especificacoes ?>" target="_blank"><?php echo $result->url_especificacoes ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Manual</strong></td>
                                    <td>
                                        <a href="<?php echo $result->url_manual ?>" target="_blank"><?php echo $result->url_manual ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>NCM</strong></td>
                                    <td>
                                        <?php echo $result->ncm ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>CEST</strong></td>
                                    <td>
                                        <?php echo $result->cest ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Origem</strong></td>
                                    <td>
                                        <?php echo $result->origem ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>CST/CSOSN</strong></td>
                                    <td>
                                        <?php echo $result->cst_csosn ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>IBS/CBS</strong></td>
                                    <td>
                                        <?php echo $result->ibs_cbs ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="span6 images-section-container">
                    <div class="images-section">
                        <h5>Imagens do Produto</h5>
                        <ul class="thumbnails">
                            <?php foreach ($images as $img) : ?>
                                <li class="span2">
                                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#modal-visualizar-imagem" data-image-url="<?php echo $img->url; ?>">
                                        <div class="image-landscape-frame">
                                            <img src="<?php echo $img->thumb; ?>" alt="Imagem do Produto">
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-footer">
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) { ?>
                <a title="Editar" class="button btn btn-mini btn-info" style="top:10px" href="<?php echo base_url() ?>index.php/produtos/editar/<?php echo $result->idProdutos; ?>">
                    <span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span>
                </a>
            <?php } ?>

            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) { ?>
                <a title="Excluir" id="btn-excluir-produto" class="button btn btn-mini btn-danger" style="top:10px" href="#modal-excluir-produto" role="button" data-toggle="modal">
                    <span class="button__icon"><i class="bx bx-trash"></i></span> <span class="button__text2"> Excluir</span>
                </a>
            <?php } ?>

            <a title="Voltar" class="button btn btn-mini btn-warning" style="top:10px" href="<?php echo site_url() ?>/produtos">
                <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span>
            </a>
        </div>
    </div>
</div>

<div id="modal-visualizar-imagem" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-visualizar-imagem-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 id="modal-visualizar-imagem-label"><i class="fas fa-image"></i> Visualizar Imagem</h5>
    </div>
    <div class="modal-body">
        <img id="imagem-modal" src="" alt="">
    </div>
</div>

<div id="modal-excluir-produto" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-excluir-produto-label" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/produtos/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="modal-excluir-produto-label"><i class="fas fa-trash-alt"></i> Excluir Produto</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $result->idProdutos; ?>" />
            <h5 style="text-align: center">Deseja realmente excluir este produto?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
                <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span>
            </button>
            <button class="button btn btn-danger">
                <span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span>
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var $janela = $(window);
        var $modalVisualizarImagem = $('#modal-visualizar-imagem');
        var $imagemModal = $modalVisualizarImagem.find('#imagem-modal');
        var imagemSelecionadaUrl = '';

        function ajustarLarguraModal() {
            if (!$modalVisualizarImagem.hasClass('in')) {
                return;
            }

            var larguraViewport = $janela.width();

            if (larguraViewport <= 767) {
                $modalVisualizarImagem.css({
                    left: '2%',
                    right: '2%',
                    width: 'auto',
                    'margin-left': '0'
                });
                return;
            }

            var imagem = $imagemModal.get(0);
            var larguraNatural = imagem && imagem.naturalWidth ? imagem.naturalWidth : 0;
            var larguraMaxima = Math.max(320, larguraViewport - 40);
            var larguraDesejada = larguraNatural ? (larguraNatural + 40) : larguraMaxima;
            var larguraFinal = Math.min(larguraMaxima, Math.max(320, larguraDesejada));

            $modalVisualizarImagem.css({
                right: 'auto',
                left: '50%',
                width: larguraFinal + 'px',
                'margin-left': (larguraFinal / -2) + 'px'
            });
        }

        $(document).on('click', 'a.thumbnail[data-target="#modal-visualizar-imagem"]', function() {
            imagemSelecionadaUrl = $(this).attr('data-image-url') || '';

            $imagemModal.attr({
                src: imagemSelecionadaUrl,
                alt: imagemSelecionadaUrl ? 'Imagem do Produto' : ''
            });

            if ($imagemModal.get(0) && $imagemModal.get(0).complete) {
                ajustarLarguraModal();
            }
        });

        $modalVisualizarImagem.on('show', function(event) {
            var trigger = $(event.relatedTarget || null);
            var imageUrl = trigger.length ? (trigger.attr('data-image-url') || imagemSelecionadaUrl) : imagemSelecionadaUrl;

            $imagemModal.attr({
                src: imageUrl,
                alt: imageUrl ? 'Imagem do Produto' : ''
            });

            if ($imagemModal.get(0) && $imagemModal.get(0).complete) {
                ajustarLarguraModal();
            }
        });

        $imagemModal.on('load', function() {
            ajustarLarguraModal();
        });

        $modalVisualizarImagem.on('hidden', function() {
            imagemSelecionadaUrl = '';
            $modalVisualizarImagem.removeAttr('style');
            $imagemModal.attr({
                src: '',
                alt: ''
            });
        });

        $janela.on('resize.modalVisualizarImagem', function() {
            ajustarLarguraModal();
        });
    });
</script>
