<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title" style="margin: -20px 0 0">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="fas fa-shopping-bag"></i></span>
                    <h5>Dados do Produto</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: center; width: 30%"><strong>Código de Barra</strong></td>
                            <td>
                                <?php echo $result->codDeBarra ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Descrição</strong></td>
                            <td>
                                <?php echo $result->descricao ?>
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

                <div style="margin-top: 20px;">
                    <h5>Imagens do Produto</h5>
                    <ul class="thumbnails">
                        <?php foreach ($images as $img) : ?>
                            <li class="span2">
                                <a href="<?php echo $img->url; ?>" target="_blank" class="thumbnail">
                                    <img src="<?php echo $img->thumb; ?>" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
