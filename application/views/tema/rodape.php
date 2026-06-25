<div class="row-fluid">
    <div id="footer" class="span12">
        <a class="pecolor" href="https://github.com/RamonSilva20/mapos" target="_blank">
            <?= date('Y') ?> &copy; Ramon Silva - Map-OS - Versão: <?= $this->config->item('app_version') ?>
        </a>
    </div>
</div>
<!--end-Footer-part-->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/matrix.js"></script>
<script type="text/javascript">
    // Correção para modal-backdrop bloqueando cliques quando modal está oculto
    $(document).on('hidden.bs.modal', '#modal-contato', function () {
        // Força remoção do modal-backdrop se ainda existir
        $('.modal-backdrop').remove();
        // Remove classe modal-open do body se existir
        $('body').removeClass('modal-open');
    });

    // Garante que o modal seja fechado corretamente ao clicar no backdrop
    $(document).on('click', '.modal-backdrop', function() {
        $('#modal-contato').modal('hide');
    });
</script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var dataTableEnabled = '<?= $configuration['control_datatable'] ?>';
        if(dataTableEnabled == '1') {
            var pageLength = parseInt(window.maposClientesPerPage || '<?= (int) $configuration['per_page'] ?>', 10);
            if (isNaN(pageLength) || pageLength <= 0) {
                pageLength = <?= (int) $configuration['per_page'] ?>;
            }

            var lengthOptions = [10, 25, 50, 100];
            if (lengthOptions.indexOf(pageLength) === -1) {
                lengthOptions.push(pageLength);
            }
            lengthOptions.sort(function(a, b) {
                return a - b;
            });

            $('#tabela').dataTable( {
                "pageLength": pageLength,
                "lengthMenu": [lengthOptions, lengthOptions],
                "ordering": false,
                "info": false,
                "language": {
                    "url": "<?= base_url() ?>assets/js/dataTable_pt-br.json",
                },
                "oLanguage": {
                    "sSearch": "Pesquisa rápida na tabela abaixo:",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "initComplete": function() {
                    $('#tabela').on('length.dt', function(event, settings, len) {
                        var params = new URLSearchParams(window.location.search);
                        params.set('per_page', len);
                        params.delete('page');
                        window.location.search = params.toString();
                    });
                }
            } );
        }
    });
</script>
</html>
