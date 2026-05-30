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
            $('#tabela').dataTable( {
                "pageLength": <?= $configuration['per_page'] ?>,
                "ordering": false,
                "info": false,
                "language": {
                    "url": "<?= base_url() ?>assets/js/dataTable_pt-br.json",
                },
                "oLanguage": {
                    "sSearch": "Pesquisa rápida na tabela abaixo:"
                }
            } );
        }
    });
</script>
</html>
