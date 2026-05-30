<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css">
<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
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
        width: 100%;
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
    .search-area {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 15px;
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
    .search-button {
        height: 30px;
        margin-bottom: 0;
    }
    @media (max-width: 767px) {
        .hide-on-mobile { display: none !important; }
        .search-button { width: 100% !important; height: 40px !important; margin-top: 5px; }
        .widget-content { width: 100%; padding: 0 !important; }
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
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?>
                <div class="span12" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; margin-left: 0;">
                    <a href="<?= base_url() ?>index.php/clientes/adicionar" class="button btn btn-mini btn-success" style="max-width: max-content;">
                        <span class="button__icon"><i class='bx bx-plus-circle'></i></span>
                        <span class="button__text2">Cliente / Fornecedor</span>
                    </a>
                    <a href="<?= site_url('prospeccao') ?>" class="button btn btn-mini btn-info" style="max-width: max-content;">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                        <span class="button__text2">Prospecção B2B</span>
                    </a>
                </div>
            <?php } ?>

            <div class="span12" style="margin-left: 0;">
                <form method="get" action="<?= base_url() ?>index.php/clientes" class="search-area" style="justify-content: flex-start;">
                    <select name="tipo" id="filtro-tipo" style="width: 130px; margin-bottom: 0;">
                        <option value="">Ambos (Todos)</option>
                        <option value="0" <?= $this->input->get('tipo') === '0' ? 'selected' : '' ?>>Clientes</option>
                        <option value="1" <?= $this->input->get('tipo') === '1' ? 'selected' : '' ?>>Fornecedores</option>
                    </select>

                    <select name="estado" id="filtro-estado" style="width: 200px; margin-bottom: 0;">
                    </select>

                    <input type="hidden" name="cidade[]" id="filtro-cidade" value="<?= is_array($this->input->get('cidade')) ? implode(',', $this->input->get('cidade')) : $this->input->get('cidade') ?>" style="width: 250px; margin-bottom: 0;">


                    <input type="text" name="pesquisa" id="pesquisa" 
                           placeholder="Nome, Doc, Email ou Telefone..." 
                           style="width: 250px; margin-bottom: 0;"
                           value="<?= $this->input->get('pesquisa') ?>">
                    
                    <button class="button btn btn-mini btn-warning search-button">
                        <span class="button__icon"><i class='bx bx-search-alt'></i></span>
                        <span class="button__text2 show-on-mobile">Pesquisar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="widget-tabs-box">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-lista" id="btn-tab-lista">Listagem de Clientes</a></li>
            <li><a data-toggle="tab" href="#tab-mapa" id="btn-tab-mapa">Mapa de Clientes</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-lista" class="tab-pane active">
                <?php echo $this->pagination->create_links(); ?>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <div class="table-responsive">
                        <?php
                            $sort = $this->input->get('sort') ?: 'idClientes';
                            $order = $this->input->get('order') ?: 'desc';
                            $nextOrder = $order == 'asc' ? 'desc' : 'asc';
                            $get_params = $this->input->get();
                            
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
                        <table id="tabela" class="table table-bordered table-sortable">
                            <thead>
                                <tr>
                                    <th><a href="<?= $buildUrl('idClientes') ?>">Cod. <?= $iconSort('idClientes') ?></a></th>
                                    <th><a href="<?= $buildUrl('nomeCliente') ?>">Nome <?= $iconSort('nomeCliente') ?></a></th>
                                    <th><a href="<?= $buildUrl('contato') ?>">Contato <?= $iconSort('contato') ?></a></th>
                                    <th><a href="<?= $buildUrl('documento') ?>">CPF/CNPJ <?= $iconSort('documento') ?></a></th>
                                    <th class="hide-on-mobile">Telefone</th>
                                    <th class="hide-on-mobile">Celular</th>
                                    <th class="show-on-mobile">Telefone/Celular</th>
                                    <th><a href="<?= $buildUrl('email') ?>">Email <?= $iconSort('email') ?></a></th>
                                    <th><a href="<?= $buildUrl('fornecedor') ?>">Tipo <?= $iconSort('fornecedor') ?></a></th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$results) {
                                    echo '<tr><td colspan="10" style="text-align: center">Nenhum Cliente Encontrado</td></tr>';
                                } else {
                                    foreach ($results as $r) {
                                        $telClean = preg_replace('/[^0-9]/', '', (string)$r->telefone);
                                        $celClean = preg_replace('/[^0-9]/', '', (string)$r->celular);
                                        
                                        $telefoneLink = $r->telefone ? '<a href="tel:'.$telClean.'">'.htmlspecialchars($r->telefone).' <i class="fas fa-phone" style="font-size: 10px;"></i></a> <a href="https://wa.me/55'.$telClean.'" target="_blank"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>' : '---';
                                        $celularLink = $r->celular ? '<a href="https://wa.me/55'.$celClean.'" target="_blank">'.htmlspecialchars($r->celular).' <i class="fab fa-whatsapp" style="color:#25d366"></i></a>' : '---';
                                        
                                        $telExibir = $r->telefone ?: $r->celular;
                                        $whatsappLink = '---';
                                        if($telExibir) {
                                            $waNumber = preg_replace('/[^0-9]/', '', (string)$telExibir);
                                            $whatsappLink = '<a href="tel:'.$waNumber.'">'.htmlspecialchars($telExibir).' <i class="fas fa-phone" style="font-size: 10px;"></i></a> <a href="https://wa.me/55'.$waNumber.'" target="_blank"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>';
                                        }

                                        echo '<tr>';
                                        echo '<td>' . $r->idClientes . '</td>';
                                        echo '<td><a href="' . base_url() . 'index.php/clientes/visualizar/' . $r->idClientes . '">' . htmlspecialchars($r->nomeCliente ?? '') . '</a></td>';
                                        echo '<td>' . htmlspecialchars($r->contato ?? '') . '</td>';
                                        echo '<td>' . htmlspecialchars($r->documento ?? '') . '</td>';
                                        echo '<td class="hide-on-mobile">' . $telefoneLink . '</td>';
                                        echo '<td class="hide-on-mobile">' . $celularLink . '</td>';
                                        echo '<td class="show-on-mobile">' . $whatsappLink . '</td>';
                                        echo '<td>' . ($r->email ? '<a href="mailto:'.$r->email.'">'.htmlspecialchars($r->email).' <i class="fas fa-envelope" style="font-size: 10px;"></i></a>' : '---') . '</td>';
                                        echo '<td><span class="label ' . ($r->fornecedor ? 'label-primary' : 'label-success') . '">' . ($r->fornecedor ? 'Fornecedor' : 'Cliente') . '</span></td>';
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
        $.getJSON('<?= site_url('clientes/getGeographicData') ?>', { estado: estado, cidade: cidade, tipo: tipo }, function(response) {
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
                var tipoCor = ehFornecedor ? 'color: #ff7800;' : 'color: #2b82cb;';
                var tipoTxt = ehFornecedor ? 'Fornecedor' : 'Cliente';
                
                popupContent += `<a href="<?= base_url('index.php/clientes/visualizar/') ?>${c.idClientes}">${c.nomeCliente}</a> <small style="${tipoCor}">(${tipoTxt})</small><br>`;
                if (index === 0) labelName = abbreviateName(c.nomeCliente);
                
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
                if ($('#filtro-cidade').data('select2')) {
                    $('#filtro-cidade').select2('destroy');
                }

                var placeholder = state ? 'Digite para buscar uma cidade' : 'Selecione um estado';
                
                $('#filtro-cidade').select2({
                    multiple: true,
                    placeholder: placeholder,
                    allowClear: true,
                    ajax: {
                        url: state ? '<?= site_url('ibge/search_cities') ?>/' + state : null,
                        dataType: 'json',
                        delay: 250,
                        data: function(term, page) {
                            return { term: term };
                        },
                        results: function(data, page) {
                            return { results: data.results };
                        },
                        cache: true
                    },
                    minimumInputLength: 2,
                    initSelection: function(element, callback) {
                        var data = [];
                        var ids = $(element).val().split(',');
                        ids.forEach(function(id) {
                            if (id) {
                                data.push({id: id, text: id});
                            }
                        });
                        callback(data);
                    }
                });

                // Habilita/desabilita com base no estado
                $('#filtro-cidade').select2(state ? 'enable' : 'disable');
            }

            // Evento de mudança no estado (interação do usuário)
            $('#filtro-estado').on('change', function() {
                var state = $(this).val();
                $('#filtro-cidade').val(null).trigger('change'); // Limpa a cidade
                setupCitySelect(state);
            });

            // Popula o dropdown de estados e então inicializa o de cidades
            getStates().then(states => {
                $('#filtro-estado').empty().append(new Option('Selecione um estado', '', false, false));
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
