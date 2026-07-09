<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

<style>
    /* Tabela Responsiva com indicador de rolagem */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        width: 100% !important;
        box-shadow: inset -15px 0 15px -15px rgba(0,0,0,0.3);
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
    #map-clientes {
        height: 600px;
        width: 100%;
        border-radius: 10px;
    }
    .nav-tabs {
        margin-bottom: 0;
        display: flex;
        border-bottom: 1px solid #ddd;
    }
    .nav-tabs > li > a {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        margin-right: 5px;
        color: #555;
        font-weight: 500;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    .nav-tabs > li > a:hover {
        background-color: #e9e9e9;
        color: #333;
    }
    .nav-tabs > li.active > a,
    .nav-tabs > li.active > a:hover,
    .nav-tabs > li.active > a:focus {
        background-color: #fff;
        color: #2b82cb;
        border-color: #ddd;
        border-bottom: 1px solid #fff;
        margin-bottom: -1px;
        font-weight: bold;
    }
    .widget-box {
        margin-top: 0;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 10px 10px;
    }
    .dataTables_length {
        margin-top: 20px;
    }
    .pagination {
        margin: 0;
    }
    .client-label {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #333;
        border-radius: 4px;
        padding: 4px 8px;
        font-weight: bold;
        font-size: 12px;
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        color: #333;
    }
    #pesquisa {
        flex: 1;
        min-width: 200px;
        margin-bottom: 0;
    }
    .search-button {
        height: 30px;
        margin-bottom: 0;
    }
    #filtro-tipo, #filtro-pessoa_fisica {
        width: 100%;
        margin-bottom: 0;
    }
    .filters-container {
        display: none;
        background: #f9f9f9;
        padding: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 0 0 10px 10px;
        margin-top: -10px;
        margin-bottom: 10px;
        border-top: none;
    }
    .search-main-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        background: #f5f5f5;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        align-items: center;
        margin-bottom: 10px;
    }
    .search-advanced-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(120px, 160px)) repeat(1, minmax(250px, 1fr));
        gap: 15px;
        align-items: end;
    }
    .filters-active-row {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

    /* Uniformização do Select2 4.x nos filtros */
    .select2-container--default {
        width: 100% !important;
        max-width: 100% !important;
    }
    .select2-selection__clear {
        margin: 0 10px 0 0 !important;
    }
    .select2-search__field {
        height: 28px !important;
        margin: 5px 0 !important;
        padding: 0 5px !important;
        font-size: 14px !important;
    }
    /* Estilos gerais para resultados e opções */
    .select2-container--default .select2-results__option {
        padding: 4px 8px !important;
        font-size: 14px !important;
    }

    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ccc !important;
        min-height: 30px !important;
        height: auto !important;
        font-size: 14px !important;
        cursor: text;
        padding: 0 !important;
    }

    /* Estilos para Select2 de seleção ÚNICA */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 30px !important;
    }

    /* Estilos para Select2 de seleção MÚLTIPLA (Cidade) */
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        background-color: #e6e9f3 !important;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        min-height: 30px;
        height: auto !important;
        padding: 2px 6px !important;
        line-height: normal !important;
        box-sizing: border-box;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e4e4e4 !important;
        border: 1px solid #ccc !important;
        font-size: 13px !important;
        /* padding: 2px 5px !important; */
        margin: 2px 4px 2px 0 !important;
        display: inline-flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        margin-left: 5px !important;
        margin-right: 0 !important;
        color: #888 !important;
        order: 2;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #555 !important;
    }
    .select2-container--default .select2-selection--multiple .select2-search--inline {
        display: contents;
    }
    .select2-container--default .select2-selection--multiple .select2-search__field {
        margin: 0 !important;
        padding: 0 5px !important;
        width: auto !important;
        flex-grow: 1;
        min-width: 150px;
    }

    @media (max-width: 767px) {
        .hide-on-mobile { display: none !important; }
        .search-button { width: 160px !important; }
        .widget-content { width: 100%; padding: 0 !important; }
        #pesquisa { width: 100%; margin-bottom: 0; }
        #filtro-tipo, #filtro-pessoa_fisica { width: 100%; margin-bottom: 0; }
        .select2-container--default { max-width: 100% !important; width: 100% !important; }
        .search-advanced-row { grid-template-columns: 1fr; gap: 10px; }
    }
    @media (min-width: 768px) {
        .show-on-mobile { display: none !important; }
    }
</style>

<div class="new122">
    <div class="widget-title" style="margin: -20px 0 0">
        <span class="icon"><i class="fas fa-user"></i></span>
        <h5>Clientes</h5>
    </div>

    <div class="row-fluid" style="margin-top: 15px;">
        <div class="span12">
            <div class="span12" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; margin-left: 0;">
                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?>
                    <a href="<?= base_url() ?>index.php/clientes/adicionar" class="button btn btn-mini btn-success" style="max-width: max-content;">
                        <span class="button__icon"><i class='bx bx-plus-circle'></i></span>
                        <span class="button__text2">Cliente / Fornecedor</span>
                    </a>
                <?php } ?>
            </div>

            <form method="get" action="<?= base_url() ?>index.php/clientes" style="margin-left: 0;">
                <?php 
                    $sortState = isset($sortState) && is_array($sortState) ? $sortState : [];
                    $sort = $sortState['sort'] ?? 'idClientes';
                    $order = $sortState['order'] ?? 'desc';
                    $sortOptions = isset($sortOptions) && is_array($sortOptions)
                        ? $sortOptions
                        : [
                            'idClientes' => 'Cod.',
                            'nomeCliente' => 'Nome',
                            'contato' => 'Contato',
                            'documento' => 'CPF/CNPJ',
                            'email' => 'Email',
                        ];
                    $per_page_atual = (int) ($this->input->get('per_page') ?: $this->data['configuration']['per_page']);
                    $filtros_avancados_ativos = ($this->input->get('tipo') !== null && $this->input->get('tipo') !== '') || 
                                                ($this->input->get('pessoa_fisica') !== null && $this->input->get('pessoa_fisica') !== '') || 
                                                ($this->input->get('estado') !== null && $this->input->get('estado') !== '') || 
                                                ($this->input->get('cidade') !== null && $this->input->get('cidade') !== '');
                    $normalizeUtf8 = function ($value) {
                        $value = (string) ($value ?? '');

                        if ($value === '') {
                            return '';
                        }

                        if (function_exists('mb_check_encoding') && !mb_check_encoding($value, 'UTF-8')) {
                            $converted = @iconv('ISO-8859-1', 'UTF-8//TRANSLIT//IGNORE', $value);
                            if ($converted !== false) {
                                $value = $converted;
                            }
                        }

                        return html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    };
                    $e = function ($value) use ($normalizeUtf8) {
                        return htmlspecialchars($normalizeUtf8($value), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    };
                ?>
                <div class="search-main-row" id="search-main-card" style="border-radius: <?= $filtros_avancados_ativos ? '10px 10px 0 0' : '10px' ?>;">
                    <input type="text" name="pesquisa" id="pesquisa" 
                           title="Pesquisar por Nome, Doc, Email ou Telefone"
                           placeholder="Nome, Doc, Email ou Telefone..." 
                           aria-label="Pesquisar clientes"
                           value="<?= $this->input->get('pesquisa') ?>">
                          <input type="hidden" name="sort" value="<?= htmlspecialchars($sort, ENT_QUOTES, 'UTF-8') ?>">
                          <input type="hidden" name="order" value="<?= htmlspecialchars($order, ENT_QUOTES, 'UTF-8') ?>">
                    
                    <button type="submit" class="button btn btn-mini btn-warning search-button">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                        <span class="button__text2">Pesquisar</span>
                    </button>

                    <button type="button" id="btn-toggle-filtros" class="button btn btn-mini <?= $filtros_avancados_ativos ? 'btn-primary' : 'btn-inverse' ?> search-button" style="max-width: max-content;">
                        <span class="button__icon"><i class='bx bx-filter-alt' <?= $filtros_avancados_ativos ? 'style="color: #ffb848;"' : '' ?>></i></span>
                        <span class="button__text2">Filtros Avançados</span>
                    </button>
                </div>

                <div id="container-filtros" class="filters-container" style="<?= $filtros_avancados_ativos ? 'display: flex;' : '' ?>">
                    <div class="search-advanced-row">
                        <div>
                            <label for="filtro-tipo" style="font-size: 11px; font-weight: bold; color: #666;">TIPO</label>
                            <select name="tipo" id="filtro-tipo" title="Filtrar por Tipo">
                                <option value="">Todos</option>
                                <option value="0" <?= $this->input->get('tipo') === '0' ? 'selected' : '' ?>>Clientes</option>
                                <option value="1" <?= $this->input->get('tipo') === '1' ? 'selected' : '' ?>>Fornecedores</option>
                            </select>
                        </div>

                        <div>
                            <label for="filtro-pessoa_fisica" style="font-size: 11px; font-weight: bold; color: #666;">PERSONALIDADE</label>
                            <select name="pessoa_fisica" id="filtro-pessoa_fisica" title="Filtrar por Pessoa Física ou Jurídica">
                                <option value="">Todos</option>
                                <option value="1" <?= $this->input->get('pessoa_fisica') === '1' ? 'selected' : '' ?>>Pessoa Física</option>
                                <option value="0" <?= $this->input->get('pessoa_fisica') === '0' ? 'selected' : '' ?>>Pessoa Jurídica</option>
                            </select>
                        </div>

                        <div>
                            <label for="filtro-estado" style="font-size: 11px; font-weight: bold; color: #666;">ESTADO (UF)</label>
                            <select name="estado" id="filtro-estado" title="Filtrar por Estado"></select>
                        </div>

                        <div>
                            <label for="filtro-cidade" style="font-size: 11px; font-weight: bold; color: #666;">CIDADE</label>
                            <select name="cidade[]" id="filtro-cidade" title="Filtrar por Cidade" multiple="multiple" disabled>
                                <?php
                                    $cidade_get = $this->input->get('cidade');
                                    if ($cidade_get) {
                                        $cidades_arr = is_array($cidade_get) ? $cidade_get : explode(',', $cidade_get);
                                        foreach ($cidades_arr as $c) {
                                            $c = trim($c);
                                            if ($c) {
                                                echo '<option value="' . htmlspecialchars($c) . '" selected>' . htmlspecialchars($c) . '</option>';
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php if ($filtros_avancados_ativos || $this->input->get('pesquisa')): ?>
                        <div class="filters-active-row">
                            <a href="<?= base_url('index.php/clientes') ?>" class="btn btn-mini btn-link" style="color: #d9534f; text-decoration: none; font-size: 11px;">
                                <i class="fas fa-times"></i> Limpar todos os filtros
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="widget-tabs-box">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-lista" id="btn-tab-lista">Listagem de Clientes</a></li>
            <li><a data-toggle="tab" href="#tab-mapa" id="btn-tab-mapa">Mapa de Clientes</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-lista" class="tab-pane active">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin:15px;">
                    <div><?php echo $this->pagination->create_links(); ?></div>
                    <div style="font-size: 12px; color: #666;">
                        <?php if (!empty($paginacaoInfo) && $paginacaoInfo['total'] > 0): ?>
                            Exibindo <?php echo $paginacaoInfo['inicio']; ?> a <?php echo $paginacaoInfo['fim']; ?> de <?php echo $paginacaoInfo['total']; ?> registros
                        <?php else: ?>
                            Exibindo 0 registros
                        <?php endif; ?>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="table-responsive">
                        <?php
                            $nextOrder = $order == 'asc' ? 'desc' : 'asc';
                            $get_params = $this->input->get();
                            unset($get_params['page']);
                            
                            $buildUrl = function($col) use ($nextOrder, $sort, $get_params) {
                                $get_params['sort'] = $col;
                                $get_params['order'] = ($sort == $col) ? $nextOrder : 'asc';
                                return base_url('index.php/clientes?') . http_build_query($get_params);
                            };
                            
                            $iconSort = function($col) use ($sort, $order) {
                                if ($sort == $col) {
                                    return $order == 'asc' ? '<i class="fas fa-sort-alpha-down" style="color: #333;"></i>' : '<i class="fas fa-sort-alpha-up" style="color: #333;"></i>';
                                }
                                return '<i class="fas fa-sort"></i>';
                            };
                        ?>
                        <table id="tabela" class="table table-bordered table-sortable table-responsive">
                            <thead>
                                <tr>
                                    <th><a href="<?= $buildUrl('idClientes') ?>"><?= $sortOptions['idClientes'] ?> <?= $iconSort('idClientes') ?></a></th>
                                    <th><a href="<?= $buildUrl('nomeCliente') ?>"><?= $sortOptions['nomeCliente'] ?> <?= $iconSort('nomeCliente') ?></a></th>
                                    <th><a href="<?= $buildUrl('contato') ?>"><?= $sortOptions['contato'] ?> <?= $iconSort('contato') ?></a></th>
                                    <th><a href="<?= $buildUrl('documento') ?>"><?= $sortOptions['documento'] ?> <?= $iconSort('documento') ?></a></th>
                                    <th class="hide-on-mobile">Telefone</th>
                                    <th class="hide-on-mobile">Celular</th>
                                    <th class="show-on-mobile">Telefone/Celular</th>
                                    <th><a href="<?= $buildUrl('email') ?>"><?= $sortOptions['email'] ?> <?= $iconSort('email') ?></a></th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$results) {
                                    echo '<tr><td colspan="9" style="text-align: center">Nenhum Cliente Encontrado</td></tr>';
                                } else {
                                    foreach ($results as $r) {
                                        $telClean = preg_replace('/[^0-9]/', '', (string)$r->telefone);
                                        $celClean = preg_replace('/[^0-9]/', '', (string)$r->celular);
                                        
                                        $telefoneLink = $r->telefone ? '<a href="tel:'.$telClean.'">'.$e($r->telefone).' <i class="fas fa-phone" style="font-size: 10px;"></i></a> <a href="https://wa.me/55'.$telClean.'" target="_blank"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>' : '---';
                                        $celularLink = $r->celular ? '<a href="https://wa.me/55'.$celClean.'" target="_blank">'.$e($r->celular).' <i class="fab fa-whatsapp" style="color:#25d366"></i></a>' : '---';
                                        
                                        $telExibir = $r->telefone ?: $r->celular;
                                        $whatsappLink = '---';
                                        if($telExibir) {
                                            $waNumber = preg_replace('/[^0-9]/', '', (string)$telExibir);
                                            $whatsappLink = '<a href="tel:'.$waNumber.'">'.$e($telExibir).' <i class="fas fa-phone" style="font-size: 10px;"></i></a> <a href="https://wa.me/55'.$waNumber.'" target="_blank"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>';
                                        }

                                        $ehFornecedor = $r->fornecedor == 1;
                                        if (isset($r->pessoa_fisica)) {
                                            $ehPF = $r->pessoa_fisica == 1;
                                        } else {
                                            $docClean = preg_replace('/[^0-9]/', '', (string)$r->documento);
                                            $ehPF = strlen($docClean) <= 11;
                                        }
                                        
                                        $corBorda = $ehFornecedor ? '#ff7800' : '#2b82cb';
                                        $iconeTipo = $ehFornecedor ? '<i class="fas fa-truck" title="Fornecedor" style="color: '.$corBorda.';"></i>' : '<i class="fas fa-user-tag" title="Cliente" style="color: '.$corBorda.';"></i>';
                                        $iconeNatureza = $ehPF ? '<i class="fas fa-user" title="Pessoa Física" style="color: #666;"></i>' : '<i class="fas fa-building" title="Empresa (PJ)" style="color: #666;"></i>';

                                        echo '<tr>';
                                        echo '<td style="border-left: 4px solid '.$corBorda.';"><div style="display: flex; align-items: center; gap: 8px;"><span style="display: flex; gap: 4px; font-size: 13px;">' . $iconeTipo . ' ' . $iconeNatureza . '</span><span>' . $r->idClientes . '</span></div></td>';
                                        echo '<td><a href="' . base_url() . 'index.php/clientes/visualizar/' . $r->idClientes . '">' . $e($r->nomeCliente ?? '') . '</a></td>';
                                        echo '<td>' . $e($r->contato ?? '') . '</td>';
                                        echo '<td>' . $e($r->documento ?? '') . '</td>';
                                        echo '<td class="hide-on-mobile">' . $telefoneLink . '</td>';
                                        echo '<td class="hide-on-mobile">' . $celularLink . '</td>';
                                        echo '<td class="show-on-mobile">' . $whatsappLink . '</td>';
                                        echo '<td>' . ($r->email ? '<a href="mailto:'.htmlspecialchars($normalizeUtf8($r->email), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').'">'.$e($r->email).' <i class="fas fa-envelope" style="font-size: 10px;"></i></a>' : '---') . '</td>';
                                        echo '<td>';
                                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
                                            echo '<a href="' . base_url() . 'index.php/clientes/visualizar/' . $r->idClientes . '" class="btn-nwe" title="Visualizar"><i class="bx bx-show bx-xs"></i></a>';
                                        }
                                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                            echo '<a href="' . base_url() . 'index.php/clientes/editar/' . $r->idClientes . '" class="btn-nwe3" title="Editar"><i class="bx bx-edit bx-xs"></i></a>';
                                        }
                                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                                            echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="' . $r->idClientes . '" class="btn-nwe4" title="Excluir"><i class="bx bx-trash-alt bx-xs"></i></a>';
                                        }
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-mapa" class="tab-pane">
                <div id="map-clientes"></div>
            </div>
        </div>
    </div>
</div>

<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/clientes/excluir" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Cliente</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idCliente" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este cliente e seus dados?</h5>
        </div>
        <div class="modal-footer" style="display:flex;justify-content: center">
            <button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    var base_url = '<?= base_url() ?>';
    window.maposClientesPerPage = <?= (int) $per_page_atual ?>;
    var mapClientes;
    var markersLayer = null;
    var routePoints = [];

    var iconeCliente = new L.Icon({
        iconUrl: base_url + 'assets/img/marker-icon-blue.png',
        shadowUrl: base_url + 'assets/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var iconeFornecedor = new L.Icon({
        iconUrl: base_url + 'assets/img/marker-icon-orange.png',
        shadowUrl: base_url + 'assets/img/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    function initMapClientes() {
        mapClientes = L.map('map-clientes').setView([-15.7801, -47.9292], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(mapClientes);

        // Inicializa a camada de agrupamento (Cluster)
        markersLayer = L.markerClusterGroup();
        mapClientes.addLayer(markersLayer);
    }

    function loadGeographicData() {
        var estado = $('#filtro-estado').val();
        var cidade = $('#filtro-cidade').val();
        var tipo = $('#filtro-tipo').val();
        var pessoa_fisica = $('#filtro-pessoa_fisica').val();
        var pesquisa = $('#pesquisa').val();
        $.getJSON('<?= site_url('clientes/getGeographicData') ?>', { estado: estado, cidade: cidade, tipo: tipo, pessoa_fisica: pessoa_fisica, pesquisa: pesquisa }, function(response) {
            if (response.status === 'success') {
                renderClientMarkers(response.data);
            }
        });
    }

    function abbreviateName(name) {
        var words = name.split(' ');
        if (words.length <= 2) return name;
        return words[0] + ' ' + words[1];
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    var isInitialMapLoad = true;
    function renderClientMarkers(data) {

        markersLayer.clearLayers();
        var bounds = [];
        var locations = {};
        routePoints = [];

        data.forEach(function(c) {
            var key = parseFloat(c.latitude).toFixed(6) + ',' + parseFloat(c.longitude).toFixed(6);
            if (!locations[key]) {
                locations[key] = { lat: c.latitude, lon: c.longitude, clients: [] };
            }
            locations[key].clients.push(c);
        });

        Object.values(locations).forEach(function(loc) {
            var popupContent = "<strong>Clientes neste local:</strong><br>";
            var labelName = "";
            var possuiFornecedor = false;
            var possuiCliente = false;

            loc.clients.forEach(function(c, index) {
                var ehFornecedor = c.fornecedor == "1" || c.fornecedor === 1;
                var ehPF = c.pessoa_fisica == "1" || c.pessoa_fisica === 1;
                var tipoCor = ehFornecedor ? 'color: #ff7800;' : 'color: #2b82cb;';
                var tipoTxt = (ehFornecedor ? 'Fornecedor' : 'Cliente') + ' (' + (ehPF ? 'PF' : 'PJ') + ')';
                
                popupContent += `<a href="<?= base_url('index.php/clientes/visualizar/') ?>${c.idClientes}">${escapeHtml(c.nomeCliente)}</a> <small style="${tipoCor}">(${tipoTxt})</small><br>`;
                if (index === 0) labelName = abbreviateName(String(c.nomeCliente || ''));
                
                if (ehFornecedor) possuiFornecedor = true;
                else possuiCliente = true;
            });

            if (loc.clients.length > 1) labelName += " (+" + (loc.clients.length - 1) + ")";

            var markerIcon = (possuiFornecedor && !possuiCliente) ? iconeFornecedor : iconeCliente;
            var marker = L.marker([loc.lat, loc.lon], {icon: markerIcon}).bindPopup(popupContent);
            
            // Tooltip agora aparece apenas no HOVER e segue o mouse (sticky)
            marker.bindTooltip(labelName, {
                permanent: false,
                sticky: true,
                direction: 'top',
                className: 'client-label',
                offset: [0, -15]
            });

            markersLayer.addLayer(marker);
            bounds.push([loc.lat, loc.lon]);
            routePoints.push({ latlng: L.latLng(loc.lat, loc.lon), name: labelName, clients: loc.clients });
        });

        if (isInitialMapLoad) {
            // No carregamento inicial, apenas centraliza no Brasil, não importa os marcadores
            mapClientes.setView([-15.7801, -47.9292], 5);
            isInitialMapLoad = false;
        } else {
            // Para interações manuais, ajusta o zoom aos marcadores do filtro
            if (bounds.length > 0) {
                mapClientes.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
            } else {
                mapClientes.setView([-15.7801, -47.9292], 5);
            }
        }
    }

    $(document).ready(function() {
        initMapClientes();

        $('#btn-toggle-filtros').click(function() {
            var $container = $('#container-filtros');
            var $card = $('#search-main-card');
            
            $container.slideToggle('fast', function() {
                if ($container.is(':visible')) {
                    $card.css('border-radius', '10px 10px 0 0');
                } else {
                    $card.css('border-radius', '10px');
                }
            });
        });

        $('#btn-tab-mapa').on('shown.bs.tab', function() {
            setTimeout(function() {
                if (mapClientes) {
                    mapClientes.invalidateSize();
                }
            }, 100);
        });

        $(document).on('click', 'a[cliente]', function(event) {
            var cliente = $(this).attr('cliente');
            $('#idCliente').val(cliente);
        });

        $("#pesquisa").autocomplete({
            source: "<?= site_url('clientes/autoComplete') ?>",
            minLength: 2,
            select: function(event, ui) {
                if (ui.item.id) {
                    window.location.href = "<?= site_url('clientes/visualizar/') ?>" + ui.item.id;
                }
            }
        });

        function getStates() {
            return new Promise((resolve) => {
                let estadosCache = localStorage.getItem('ibge_estados');
                if (estadosCache) {
                    try {
                        let states = JSON.parse(estadosCache);
                        states.sort((a, b) => a.nome.localeCompare(b.nome));
                        return resolve(states);
                    } catch (e) { /* Ignora */ }
                }
                $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
                    .done(data => {
                        localStorage.setItem('ibge_estados', JSON.stringify(data));
                        resolve(data);
                    })
                    .fail(() => resolve([]));
            });
        }

        function initializeLocationFilters() {
            const curState = <?= json_encode($this->input->get('estado') ?: '') ?>;

            // Função para configurar o select2 da cidade
            function setupCitySelect(state) {
                // Destroi a instância anterior para evitar conflitos
                if ($('#filtro-cidade').hasClass("select2-hidden-accessible")) {
                    $('#filtro-cidade').select2('destroy');
                }

                var placeholder = state ? 'Filtrar por cidade' : 'Selecione o estado primeiro';
                
                $('#filtro-cidade').select2({
                    placeholder: placeholder,
                    allowClear: true,
                    ajax: {
                        url: state ? '<?= site_url('ibge/search_cities') ?>/' + state : null,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return { term: params.term };
                        },
                        processResults: function(data) {
                            return { results: data.results };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                });

                // Habilita/desabilita com base no estado
                $('#filtro-cidade').prop('disabled', !state);
            }

            // Evento de mudança no estado (interação do usuário)
            $('#filtro-estado').on('change', function() {
                var state = $(this).val();
                $('#filtro-cidade').val(null).trigger('change'); // Limpa a cidade
                setupCitySelect(state);
            });

            // Popula o dropdown de estados e então inicializa o de cidades
            getStates().then(states => {
                $('#filtro-estado').empty().append(new Option());
                states.forEach(function(estado) {
                    $('#filtro-estado').append(new Option(`${estado.sigla} - ${estado.nome}`, estado.sigla, false, curState === estado.sigla));
                });
                
                $('#filtro-estado').select2({
                    placeholder: "Selecione um estado",
                    allowClear: true
                }).val(curState); // Apenas define o valor, sem disparar 'change'

                // AGORA, com o estado já definido, inicializa o campo de cidade
                setupCitySelect(curState);
            });
        }

        initializeLocationFilters();
        loadGeographicData();
    });
</script>
