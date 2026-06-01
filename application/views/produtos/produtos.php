<style>
  .dataTables_length {
      margin-top: 20px;
  }
  .search-area {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 15px;
  }
  .search-button {
      height: 30px;
      margin-bottom: 0;
  }
  /* Estilização para ordenação da tabela */
  .table-sortable th {
      white-space: nowrap;
  }
  .table-sortable th a {
      color: inherit;
      text-decoration: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 8px;
  }
  .table-sortable th a:hover {
      color: #000;
  }
  .table-sortable th a i {
      font-size: 10px;
      color: #999;
  }
  /* Tabela Responsiva */
  .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      width: 100%;
  }
  @media (max-width: 767px) {
      .widget-content { width: 100%; padding: 0 !important; }
  }
</style>

<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon">
            <i class="fas fa-shopping-bag"></i>
        </span>
        <h5>Produtos</h5>
    </div>

    <div class="row-fluid" style="margin-top: 15px;">
        <div class="span12">
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) : ?>
                <div class="span12" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; margin-left: 0;">
                    <a href="<?php echo base_url(); ?>index.php/produtos/adicionar" class="button btn btn-mini btn-success" style="max-width: max-content" tabindex="1" aria-label="Adicionar Produto">
                        <span class="button__icon"><i class='bx bx-plus-circle'></i></span><span class="button__text2">Produtos</span>
                    </a>
                    <a href="#modal-etiquetas" role="button" data-toggle="modal" class="button btn btn-mini btn-warning" style="max-width: max-content" tabindex="2" aria-label="Gerar Etiquetas">
                        <span class="button__icon"><i class='bx bx-barcode-reader' ></i></span><span class="button__text2">Gerar Etiquetas</span>
                    </a>
                    <a href="<?php echo base_url(); ?>index.php/produtos/atualizarNCM" class="button btn btn-mini btn-info" style="max-width: max-content" onclick="return confirm('Deseja baixar a tabela atualizada do NCM da Receita Federal? Isso pode levar alguns segundos.')" tabindex="3" aria-label="Atualizar NCM">
                        <span class="button__icon"><i class='bx bx-sync'></i></span><span class="button__text2">Atualizar NCM</span>
                    </a>
                    <a href="#modal-importar-xml" role="button" data-toggle="modal" class="button btn btn-mini btn-primary" style="max-width: max-content" tabindex="4" aria-label="Importar XML">
                        <span class="button__icon"><i class='bx bx-upload'></i></span><span class="button__text2">Importar XML</span>
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="span12" style="margin-left: 0;">
                <form method="get" action="<?= base_url() ?>index.php/produtos/gerenciar" class="search-area" style="justify-content: flex-start;">
                    <input type="text" name="pesquisa" id="pesquisa" 
                           placeholder="Buscar por Código de Barras ou Descrição..." 
                           style="width: 300px; margin-bottom: 0;"
                           value="<?= $this->input->get('pesquisa') ?>">
                    
                    <button class="button btn btn-mini btn-warning search-button">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                        <span class="button__text2">Pesquisar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="widget-box">
        <div class="widget-content nopadding">
            <div class="table-responsive">
                <?php
                    $sort = $this->input->get('sort') ?: 'idProdutos';
                    $order = $this->input->get('order') ?: 'desc';
                    $nextOrder = $order == 'asc' ? 'desc' : 'asc';
                    $get_params = $this->input->get();
                    unset($get_params['per_page']);
                    
                    $buildUrl = function($col) use ($nextOrder, $sort, $get_params) {
                        $get_params['sort'] = $col;
                        $get_params['order'] = ($sort == $col) ? $nextOrder : 'asc';
                        return base_url('index.php/produtos/gerenciar?') . http_build_query($get_params);
                    };
                    
                    $iconSort = function($col) use ($sort, $order) {
                        if ($sort == $col) {
                            return $order == 'asc' ? '<i class="fas fa-sort-alpha-down" style="color: #333;"></i>' : '<i class="fas fa-sort-alpha-up" style="color: #333;"></i>';
                        }
                        return '<i class="fas fa-sort"></i>';
                    };
                ?>
                <table id="tabela" class="table table-bordered table-sortable">
                    <thead>
                        <tr>
                            <th><a href="<?= $buildUrl('idProdutos') ?>">Cod. <?= $iconSort('idProdutos') ?></a></th>
                            <th>Foto</th>
                            <th><a href="<?= $buildUrl('codDeBarra') ?>">Cod. Barra <?= $iconSort('codDeBarra') ?></a></th>
                            <th><a href="<?= $buildUrl('descricao') ?>">Nome <?= $iconSort('descricao') ?></a></th>
                            <th><a href="<?= $buildUrl('estoque') ?>">Estoque <?= $iconSort('estoque') ?></a></th>
                            <th><a href="<?= $buildUrl('precoVenda') ?>">Preço <?= $iconSort('precoVenda') ?></a></th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$results) {
                            echo '<tr><td colspan="7" style="text-align: center;">Nenhum produto encontrado.</td></tr>';
                        } else {
                            foreach ($results as $r) {
                                echo '<tr>';
                                echo '<td>' . $r->idProdutos . '</td>';
                                echo '<td>';
                                if ($r->thumb) {
                                    echo '<img src="' . $r->thumb . '" style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover;">';
                                } else {
                                    echo '<i class="bx bx-image-alt" style="font-size: 24px; color: #ccc;"></i>';
                                }
                                echo '</td>';
                                echo '<td>' . $r->codDeBarra . '</td>';
                                echo '<td>' . $r->descricao . '</td>';
                                echo '<td>' . $r->estoque . '</td>';
                                echo '<td>R$ ' . number_format($r->precoVenda, 2, ',', '.') . '</td>';
                                echo '<td>';
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                                    echo '<a style="margin-right: 1%" href="' . base_url('index.php/produtos/visualizar/' . $r->idProdutos) . '" class="btn-nwe" title="Visualizar Produto"><i class="bx bx-show bx-xs"></i></a>';
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                    echo '<a style="margin-right: 1%" href="' . base_url('index.php/produtos/editar/' . $r->idProdutos) . '" class="btn-nwe3" title="Editar Produto"><i class="bx bx-edit bx-xs"></i></a>';
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                                    echo '<a style="margin-right: 1%" href="#modal-excluir" role="button" data-toggle="modal" produto="' . $r->idProdutos . '" class="btn-nwe4" title="Excluir Produto"><i class="bx bx-trash-alt bx-xs"></i></a>';
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                    echo '<a href="#atualizar-estoque" role="button" data-toggle="modal" produto="' . $r->idProdutos . '" estoque="' . $r->estoque . '" class="btn-nwe5" title="Atualizar Estoque"><i class="bx bx-plus-circle bx-xs"></i></a>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/produtos/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-trash-alt"></i> Excluir Produto</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idProduto" class="idProduto" name="id" value=""/>
            <h5 style="text-align: center">Deseja realmente excluir este produto?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true">
              <span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-danger"><span class="button__icon"><i class='bx bx-trash'></i></span> <span class="button__text2">Excluir</span></button>
        </div>
    </form>
</div>

<!-- Modal Estoque -->
<div id="atualizar-estoque" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/produtos/atualizar_estoque" method="post" id="formEstoque">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-plus-square"></i> Atualizar Estoque</h5>
        </div>
        <div class="modal-body">
            <div class="control-group">
                <label for="estoqueAtual" class="control-label">Estoque Atual</label>
                <div class="controls">
                    <input id="estoqueAtual" type="text" name="estoqueAtual" value="" readonly />
                </div>
            </div>

            <div class="control-group">
                <label for="estoque" class="control-label">Adicionar Produtos<span class="required">*</span></label>
                <div class="controls">
                    <input type="hidden" id="idProduto" class="idProduto" name="id" value=""/>
                    <input id="estoque" type="text" name="estoque" value=""/>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
          <button class="button btn btn-primary"><span class="button__icon"><i class="bx bx-sync"></i></span><span class="button__text2">Atualizar</span></button>
          <button class="button btn btn-warning"  data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
        </div>
    </form>
</div>

<!-- Modal Etiquetas -->
<div id="modal-etiquetas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/relatorios/produtosEtiquetas" method="get">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Gerar etiquetas com Código de Barras</h5>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0"> Escolha o intervalo de produtos para gerar as etiquetas.</div>

            <div class="span12" style="margin-left: 0;">
                <div class="span6" style="margin-left: 0;">
                    <label for="valor">De</label>
                    <input class="span9" style="margin-left: 0" type="text" id="de_id" name="de_id" placeholder="ID do primeiro produto" value=""/>
                </div>

                <div class="span6">
                    <label for="valor">Até</label>
                    <input class="span9" type="text" id="ate_id" name="ate_id" placeholder="ID do último produto" value=""/>
                </div>

                <div class="span4">
                    <label for="valor">Qtd. do Estoque</label>
                    <input class="span12" type="checkbox" name="qtdEtiqueta" value="true"/>
                </div>

                <div class="span6">
                    <label class="span12" for="valor">Formato Etiqueta</label>
                    <select class="span5" name="etiquetaCode">
                        <option value="EAN13">EAN-13</option>
                        <option value="UPCA">UPCA</option>
                        <option value="C93">CODE 93</option>
                        <option value="C128A">CODE 128</option>
                        <option value="CODABAR">CODABAR</option>
                        <option value="QR">QR-CODE</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
          <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
          <button class="button btn btn-success"><span class="button__icon"><i class='bx bx-barcode'></i></span><span class="button__text2">Gerar</span></button>
        </div>
    </form>
</div>

<!-- Modal Importar XML -->
<div id="modal-importar-xml" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/produtos/importarXml" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel"><i class="fas fa-upload"></i> Importar XML de Produtos</h5>
        </div>
        <div class="modal-body">
            <div class="span12 alert alert-info" style="margin-left: 0">Selecione um arquivo XML de NFe para importar os produtos.</div>
            <div class="span12" style="margin-left: 0;">
                <label for="arquivo">Arquivo XML</label>
                <input class="span12" type="file" name="userfile" size="20" />
            </div>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="button btn btn-warning" data-dismiss="modal" aria-hidden="true"><span class="button__icon"><i class="bx bx-x"></i></span><span class="button__text2">Cancelar</span></button>
            <button class="button btn btn-success"><span class="button__icon"><i class='bx bx-upload'></i></span><span class="button__text2">Importar</span></button>
        </div>
    </form>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', 'a[produto]', function (event) {
            var produto = $(this).attr('produto');
            var estoque = $(this).attr('estoque');
            $('.idProduto').val(produto);
            $('#estoqueAtual').val(estoque);
        });

        $('#formEstoque').validate({
            rules: {
                estoque: {
                    required: true,
                    number: true
                }
            },
            messages: {
                estoque: {
                    required: 'Campo Requerido.',
                    number: 'Informe um número válido.'
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>
