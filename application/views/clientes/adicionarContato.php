<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/funcoes.js"></script>
<style>
    .control-group.error .help-inline {
        display: flex;
    }

    .form-horizontal .control-group {
        border-bottom: 1px solid #ffffff;
    }

    .form-horizontal .controls {
        margin-left: 20px;
        padding-bottom: 8px 0;
    }

    .form-horizontal .control-label {
        text-align: left;
        padding-top: 15px;
    }

    .nopadding {
        padding: 0 20px !important;
        margin-right: 20px;
    }

    .widget-title h5 {
        padding-bottom: 30px;
        text-align-last: left;
        font-size: 2em;
        font-weight: 500;
    }

    @media (max-width: 480px) {
        form {
            display: contents !important;
        }

        .form-horizontal .control-label {
            margin-bottom: -6px;
        }

        .btn-xs {
            position: initial !important;
        }
    }
</style>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title" style="margin: -20px 0 0">
                <span class="icon">
                    <i class="fas fa-user-plus"></i>
                </span>
                <h5>Adicionar Contato - Cliente: <?php echo $cliente->nomeCliente ?></h5>
            </div>
            <?php if ($custom_error != '') {
                echo '<div class="alert alert-danger">' . $custom_error . '</div>';
            } ?>
            <form action="<?php echo current_url(); ?>" id="formContato" method="post" class="form-horizontal">
                <div class="widget-content nopadding tab-content">
                    <div class="span12">
                        <div class="control-group">
                            <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                            <div class="controls">
                                <input id="nome" type="text" name="nome" value="<?php echo set_value('nome'); ?>" title="Nome: Nome completo do contato. Campo obrigatório." />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="telefone" class="control-label">Telefone</label>
                            <div class="controls">
                                <input id="telefone" type="text" name="telefone" value="<?php echo set_value('telefone'); ?>" title="Telefone: Número de telefone fixo. Formato: (00) 0000-0000." />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="celular" class="control-label">Celular</label>
                            <div class="controls">
                                <input id="celular" type="text" name="celular" value="<?php echo set_value('celular'); ?>" title="Celular: Número de telefone celular. Formato: (00) 00000-0000." />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="email" class="control-label">E-mail</label>
                            <div class="controls">
                                <input id="email" type="email" name="email" value="<?php echo set_value('email'); ?>" title="E-mail: Endereço de e-mail válido." />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="cargo" class="control-label">Cargo</label>
                            <div class="controls">
                                <input id="cargo" type="text" name="cargo" value="<?php echo set_value('cargo'); ?>" title="Cargo: Cargo ou função do contato." />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="observacoes" class="control-label">Observações</label>
                            <div class="controls">
                                <textarea id="observacoes" name="observacoes" title="Observações: Informações adicionais sobre o contato."><?php echo set_value('observacoes'); ?></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="cliente_id" value="<?php echo $cliente->idClientes ?>" />
                    </div>
                </div>
                <div class="form-actions">
                    <div class="span12">
                        <div class="span6 offset3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar</button>
                            <a href="<?php echo site_url() ?>/clientes/visualizar/<?php echo $cliente->idClientes ?>" class="btn"><i class="fas fa-arrow-left"></i> Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#telefone").mask("(00) 0000-0000");
        $("#celular").mask("(00) 00000-0000");

        $('#formContato').validate({
            rules: {
                nome: {
                    required: true
                },
                email: {
                    email: true
                }
            },
            messages: {
                nome: {
                    required: 'Campo Requerido.'
                },
                email: {
                    email: 'Insira um e-mail válido.'
                }
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
    });
</script>