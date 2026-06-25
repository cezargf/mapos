<style>
    /* Estilos para o formulário inline de contatos */
    #form-contato-inline {
        margin-bottom: 15px;
    }

    #form-contato-inline .panel-heading {
        background-color: #f5f5f5;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #form-contato-inline .panel-heading h4 {
        margin: 0;
        font-weight: bold;
    }

    #form-contato-inline .buttons-container {
        display: flex;
        gap: 5px;
    }

    #form-contato-inline .buttons-container .button {
        margin: 0;
    }

    #form-contato-inline .buttons-container .button .button__icon {
        margin-right: 5px;
    }

    #form-contato-inline .buttons-container .button .button__text2 {
        width: 60px;
    }

    #form-contato-inline .panel-body {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-top: none;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    #form-contato-inline .control-group {
        margin-bottom: 20px;
    }

    #form-contato-inline .control-group .control-label {
        display: flex !important;
        align-items: center;
        justify-content: flex-start;
        padding: 0;
    }

    #form-contato-inline .control-group .control-label button {
        padding: 0;
        margin: 0 0 0 5px;
    }

    #form-contato-inline .control-group .control-label .button__icon,
    #form-contato-inline .input-append-contatos .button__icon {
        padding: 0px 5px;
    }

    #form-contato-inline .control-group .controls {
        justify-content: space-between;
        margin: 0 !important;
        padding: 0;
    }

    #form-contato-inline .control-group .controls .input-append-contatos {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
        width: 48%;
    }

    #form-contato-inline .control-group .controls .input-append-contatos input {
        flex: 1;
        margin-bottom: 0 !important;
    }

    #form-contato-inline .control-group .controls .input-append-contatos .button {
        margin: 0;
    }

    @media (max-width: 767px) {
        /* Estilos para telas pequenas */
        #form-contato-inline .panel-heading {
            display: flex;
        }

        #form-contato-inline .buttons-container {
            justify-content: flex-end;
        }
    }

    @media (max-width: 480px) {
        /* Estilos para telas muito pequenas */
        #form-contato-inline .buttons-container .button .button__icon {
            margin-right: 0;
        }

        #form-contato-inline .buttons-container .button .button__text2 {
            display: none;
        }

        #form-contato-inline .control-group .control-label {
            justify-content: space-between;
        }

        #form-contato-inline .control-group .controls .input-append-contatos {
            width: 100%;
        }

        #form-contato-inline .control-group .controls .input-append-contatos .button {
            margin: 0;
        }
    }
</style>

<!-- Formulário Inline Expandível para Adicionar/Editar Contato -->
<div id="form-contato-inline" class="panel panel-default" style="display: none;">
    <div class="panel-heading">
        <h4 id="form-contato-titulo">Adicionar Contato</h4>
        <div class="buttons-container">
            <button type="button" class="button btn btn-mini btn-danger" id="btn-cancelar-contato" title="Cancelar">
                <span class="button__icon"><i class="bx bx-x-circle"></i></span>
                <span class="button__text2">Cancelar</span>
            </button>
            <button type="button" class="button btn btn-mini btn-primary" id="btn-save-contato" title="Salvar Contato">
                <span class="button__icon"><i class="bx bx-save"></i></span>
                <span class="button__text2">Salvar</span>
            </button>
        </div>
    </div>
    <div class="panel-body">

        <?php if (isset($use_inline_index) && $use_inline_index == 1): ?>
            <input type="hidden" id="inline-index" value="">
        <?php endif; ?>

        <div id="form-contato-erros" class="alert alert-danger" style="display: none;">
            <!-- <ul id="form-contato-erros" style="margin: 0; padding-left: 20px;"></ul> -->
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label for="inline-nome" class="control-label">Nome <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" class="form-control" id="inline-nome" maxlength="255" placeholder="Nome do contato">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Email <button type="button" id="add-inline-email" class="button btn btn-mini btn-success"><span class="button__icon"><i class="bx bx-plus-circle"></i></span></button></label>
                    <div class="controls" id="container-inline-email">
                        <div class="linha-email input-append-contatos">
                            <input type="email" class="form-control span10" name="inline_emails[]" maxlength="255" placeholder="email@exemplo.com">
                            <button type="button" class="button btn btn-mini btn-danger remover-campo"><span class="button__icon"><i class="bx bx-trash"></i></span></button>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Telefone <button type="button" id="add-inline-telefone" class="button btn btn-mini btn-success"><span class="button__icon"><i class="bx bx-plus-circle"></i></span></button></label>
                    <div class="controls" id="container-inline-telefone">
                        <div class="linha-telefone input-append-contatos">
                            <input type="text" class="form-control span10 mascara-telefone" name="inline_telefones[]" maxlength="25" placeholder="(00) 0000-0000">
                            <button type="button" class="button btn btn-mini btn-danger remover-campo"><span class="button__icon"><i class="bx bx-trash"></i></span></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span6">
                <div class="control-group">
                    <label class="control-label">Celular <button type="button" id="add-inline-celular" class="button btn btn-mini btn-success"><span class="button__icon"><i class="bx bx-plus-circle"></i></span></button></label>
                    <div class="controls" id="container-inline-celular">
                        <div class="linha-celular input-append-contatos">
                            <input type="text" class="form-control span10 mascara-celular" name="inline_celulares[]" maxlength="25" placeholder="(00) 00000-0000">
                            <button type="button" class="button btn btn-mini btn-danger remover-campo"><span class="button__icon"><i class="bx bx-trash"></i></span></button>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label for="inline-cargo" class="control-label">Cargo</label>
                    <div class="controls">
                        <input type="text" class="form-control" id="inline-cargo" maxlength="100" placeholder="Cargo ou função">
                    </div>
                </div>

                <div class="control-group">
                    <label for="inline-observacoes" class="control-label">Observações</label>
                    <div class="controls">
                        <textarea class="form-control" id="inline-observacoes" rows="2" maxlength="500" placeholder="Observações adicionais"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
(function (window, $) {
    'use strict';

    function parseJsonOrArray(val) {
        if (!val || val === 'null') {
            return [];
        }

        if (Array.isArray(val)) {
            return val;
        }

        if (typeof val === 'string') {
            try {
                var parsed = JSON.parse(val);

                if (parsed === null) {
                    return [];
                }

                if (typeof parsed === 'string') {
                    try {
                        var innerParsed = JSON.parse(parsed);
                        if (Array.isArray(innerParsed)) {
                            return innerParsed;
                        }
                    } catch (e) {
                        // Keep fallback behavior when nested JSON parsing fails.
                    }
                }

                return Array.isArray(parsed) ? parsed : [parsed];
            } catch (e) {
                if (val.indexOf(',') >= 0) {
                    return val.split(',').map(function (s) {
                        return s.trim();
                    }).filter(function (s) {
                        return s !== '';
                    });
                }

                return [val];
            }
        }

        return [val];
    }

    function criarLinha(tipo, valor, escapeHtml) {
        var safeValue = valor ? escapeHtml(String(valor)) : '';

        return '<div class="linha-' + tipo + ' input-append-contatos">'
            + '<input type="' + (tipo === 'email' ? 'email' : 'text') + '" class="form-control span10'
            + (tipo === 'telefone' ? ' mascara-telefone' : '')
            + (tipo === 'celular' ? ' mascara-celular' : '')
            + '" name="inline_' + (tipo === 'email' ? 'emails' : (tipo === 'telefone' ? 'telefones' : 'celulares')) + '[]"'
            + ' maxlength="' + (tipo === 'email' ? '255' : '25') + '"'
            + ' placeholder="' + (tipo === 'email' ? 'email@exemplo.com' : (tipo === 'telefone' ? '(00) 0000-0000' : '(00) 00000-0000')) + '"'
            + ' value="' + safeValue + '">'
            + '<button type="button" class="button btn btn-mini btn-danger remover-campo">'
            + '<span class="button__icon"><i class="bx bx-trash"></i></span>'
            + '</button>'
            + '</div>';
    }

    function preencherCamposContato(contato, escapeHtml) {
        var emails = parseJsonOrArray(contato.email);
        var telefones = parseJsonOrArray(contato.telefone);
        var celulares = parseJsonOrArray(contato.celular);

        if (emails.length > 0) {
            var htmlEmails = emails.map(function (email) {
                return criarLinha('email', email, escapeHtml);
            }).join('');
            $('#container-inline-email').html(htmlEmails);
        }

        if (telefones.length > 0) {
            var htmlTelefones = telefones.map(function (telefone) {
                return criarLinha('telefone', telefone, escapeHtml);
            }).join('');
            $('#container-inline-telefone').html(htmlTelefones);
        }

        if (celulares.length > 0) {
            var htmlCelulares = celulares.map(function (celular) {
                return criarLinha('celular', celular, escapeHtml);
            }).join('');
            $('#container-inline-celular').html(htmlCelulares);
        }
    }

    function limparCamposContato() {
        $('#container-inline-email').html(criarLinha('email', '', function (v) {
            return v;
        }));
        $('#container-inline-telefone').html(criarLinha('telefone', '', function (v) {
            return v;
        }));
        $('#container-inline-celular').html(criarLinha('celular', '', function (v) {
            return v;
        }));
    }

    function obterCamposContato() {
        var emails = $("input[name='inline_emails[]']").map(function () {
            return $(this).val();
        }).get().filter(function (v) {
            return v.trim() !== '';
        });

        var telefones = $("input[name='inline_telefones[]']").map(function () {
            return $(this).val();
        }).get().filter(function (v) {
            return v.trim() !== '';
        });

        var celulares = $("input[name='inline_celulares[]']").map(function () {
            return $(this).val();
        }).get().filter(function (v) {
            return v.trim() !== '';
        });

        return {
            emails: emails,
            telefones: telefones,
            celulares: celulares
        };
    }

    function obterEmailsContatoParaValidacao() {
        return $("input[name='inline_emails[]']").map(function () {
            return $(this).val().trim();
        }).get().filter(function (v) {
            return v !== '';
        });
    }

    function validarContatoInline(params) {
        var erros = [];
        var nome = (params.nome || '').trim();
        var emails = params.emails || [];
        var contatos = params.contatos || [];
        var contatoAtualId = params.contatoAtualId;
        var isValidEmail = params.isValidEmail;
        var getContatoId = params.getContatoId || function (contato) {
            if (contato && typeof contato.idContatos !== 'undefined') {
                return contato.idContatos;
            }

            return null;
        };

        if (!nome) {
            erros.push('Nome é obrigatório.');
        }

        emails.forEach(function (email) {
            if (typeof isValidEmail === 'function') {
                if (!isValidEmail(email)) {
                    erros.push('Email inválido: ' + email);
                }
            }
        });

        for (var i = 0; i < contatos.length; i++) {
            var contato = contatos[i] || {};
            var nomeContato = String(contato.nome || '').toLowerCase();
            if (nomeContato === nome.toLowerCase() && getContatoId(contato, i) !== contatoAtualId) {
                erros.push('Já existe um contato com este nome.');
                break;
            }
        }

        return erros;
    }

    function resetFormulario() {
        $('#inline-nome').val('');
        limparCamposContato();
        $('#inline-cargo').val('');
        $('#inline-observacoes').val('');
        $('#inline-index').val('');
        $('#form-contato-erros').hide();
    }

    function abrirFormularioEdicao(contato, config) {
        config = config || {};

        resetFormulario();

        $('#inline-nome').val(contato.nome || '');
        preencherCamposContato(contato, config.escapeHtml || function (v) {
            return v;
        });
        $('#inline-cargo').val(contato.cargo || '');
        $('#inline-observacoes').val(contato.observacoes || '');

        $('#form-contato-titulo').text(config.titulo || 'Editar Contato');
        $('#form-contato-inline').slideDown(300);

        if (typeof config.aplicarMascaras === 'function') {
            config.aplicarMascaras();
        }

        if (config.focusNome !== false) {
            $('#inline-nome').focus();
        }
    }

    function criarLinksTelefone(telefones, escapeHtml) {
        var html = (Array.isArray(telefones) ? telefones : []).map(function (tel) {
            if (!tel) {
                return '';
            }

            var telClean = String(tel).replace(/[^0-9]/g, '');

            return '<a href="tel:' + telClean + '" title="Ligar" style="color: inherit; text-decoration: none;">'
                + escapeHtml(String(tel)) + ' <i class="fas fa-phone" style="margin-left: 3px;"></i></a> '
                + '<a href="https://wa.me/55' + telClean + '" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
        }).join('<br>');

        return html || '-';
    }

    function criarLinksCelular(celulares, escapeHtml) {
        var html = (Array.isArray(celulares) ? celulares : []).map(function (cel) {
            if (!cel) {
                return '';
            }

            var celClean = String(cel).replace(/[^0-9]/g, '');

            return '<a href="https://wa.me/55' + celClean + '" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;">'
                + escapeHtml(String(cel)) + ' <i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
        }).join('<br>');

        return html || '-';
    }

    function criarLinksEmail(emails, escapeHtml) {
        var html = (Array.isArray(emails) ? emails : []).map(function (email) {
            if (!email) {
                return '';
            }

            return '<a href="mailto:' + email + '" title="Enviar E-mail" style="color: inherit; text-decoration: none;">'
                + escapeHtml(String(email)) + ' <i class="fas fa-envelope" style="margin-left: 3px;"></i></a>';
        }).join('<br>');

        return html || '-';
    }

    function criarBotaoAcao(tipo, attrs) {
        var classe = tipo === 'edit' ? 'btn-info btn-edit-contato' : 'btn-danger btn-delete-contato';
        var icone = tipo === 'edit' ? 'bx bx-edit' : 'bx bx-trash';
        var titulo = tipo === 'edit' ? 'Editar' : 'Deletar';
        var atributos = Object.keys(attrs || {}).map(function (key) {
            return ' ' + key + '="' + attrs[key] + '"';
        }).join('');

        return '<button type="button" class="button btn btn-xs ' + classe + '"' + atributos
            + ' title="' + titulo + '" style="margin-right: 5px; margin-bottom: 5px;">'
            + '<span class="button__icon"><i class="' + icone + '"></i></span>'
            + '</button>';
    }

    function renderTabelaContatos(config) {
        var contatos = config.contatos || [];
        var escapeHtml = config.escapeHtml || function (v) {
            return v;
        };
        var tbody = $(config.tbodySelector || '#contatos-table-body');
        var tabela = $(config.tableSelector || '#table-contatos');
        var estadoVazio = $(config.emptySelector || '#msg-sem-contatos');
        var badge = $(config.badgeSelector || '#badge-contatos');

        tbody.empty();

        if (contatos.length === 0) {
            tabela.hide();
            estadoVazio.show();
            badge.text('0');
            return;
        }

        estadoVazio.hide();
        tabela.show();
        badge.text(contatos.length);

        contatos.forEach(function (contato, index) {
            var telefonesArray = parseJsonOrArray(contato.telefone);
            var celularesArray = parseJsonOrArray(contato.celular);
            var emailsArray = parseJsonOrArray(contato.email);
            var colunasExtras = typeof config.renderExtraColumns === 'function'
                ? config.renderExtraColumns(contato, index)
                : '';
            var botoes = typeof config.getActionButtons === 'function'
                ? config.getActionButtons(contato, index, {
                    criarBotaoAcao: criarBotaoAcao,
                    escapeHtml: escapeHtml
                })
                : '';

            var row = '<tr>'
                + '<td><strong>' + escapeHtml(contato.nome || '') + '</strong></td>'
                + '<td>' + criarLinksEmail(emailsArray, escapeHtml) + '</td>'
                + '<td>' + criarLinksTelefone(telefonesArray, escapeHtml) + '</td>'
                + '<td>' + criarLinksCelular(celularesArray, escapeHtml) + '</td>'
                + '<td>' + escapeHtml(contato.cargo || '-') + '</td>'
                + colunasExtras
                + '<td>' + botoes + '</td>'
                + '</tr>';

            tbody.append(row);
        });
    }

    function initAjax(config) {
        $('#btn-cancelar-contato').off('click.contatoAjax click.contatoArray').on('click.contatoAjax', function () {
            $('#form-contato-inline').slideUp(300);
            if (typeof config.onCancelar === 'function') {
                config.onCancelar();
            }
        });

        $('#btn-save-contato').off('click.contatoAjax click.contatoArray').on('click.contatoAjax', function () {
            var idContato = typeof config.getIdContato === 'function' ? config.getIdContato() : null;
            var nome = $('#inline-nome').val().trim();
            var emails = obterEmailsContatoParaValidacao();
            var contatosAtuais = typeof config.getContatosParaValidacao === 'function' ? config.getContatosParaValidacao() : [];

            var erros = validarContatoInline({
                nome: nome,
                emails: emails,
                contatos: contatosAtuais,
                contatoAtualId: idContato,
                isValidEmail: window.isValidEmail,
                getContatoId: function (c) { return c.idContatos; }
            });

            if (erros.length > 0) {
                var html = '<strong>Erros:</strong><ul><li>' + erros.join('</li><li>') + '</li></ul>';
                $('#form-contato-erros').html(html).show();
                return;
            }

            $('#form-contato-erros').hide();

            var camposContato = obterCamposContato();
            var dados = {
                idContatos: idContato,
                cliente_id: typeof config.getClienteId === 'function' ? config.getClienteId() : null,
                nome: nome,
                email: JSON.stringify(camposContato.emails),
                telefone: JSON.stringify(camposContato.telefones),
                celular: JSON.stringify(camposContato.celulares),
                cargo: $('#inline-cargo').val().trim(),
                observacoes: $('#inline-observacoes').val().trim()
            };
            dados['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';

            var url = idContato
                ? '<?php echo site_url('clientes/editarContato'); ?>'
                : '<?php echo site_url('clientes/adicionarContato'); ?>';

            var $modalLoading = $('#modal-loading');
            if ($modalLoading.length) {
                $modalLoading.modal('show');
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: dados,
                dataType: 'json',
                success: function (response) {
                    if ($modalLoading.length) {
                        $modalLoading.modal('hide');
                    }
                    if (response.status === 'success') {
                        $('#form-contato-inline').slideUp(300);
                        if (typeof config.onSalvoComSucesso === 'function') {
                            config.onSalvoComSucesso(!!idContato);
                        }
                    } else {
                        if (typeof config.onErro === 'function') {
                            config.onErro(response.message || 'Erro ao processar');
                        }
                    }
                },
                error: function () {
                    if ($modalLoading.length) {
                        $modalLoading.modal('hide');
                    }
                    if (typeof config.onErro === 'function') {
                        config.onErro('Erro ao processar requisição');
                    }
                }
            });
        });
    }

    function initArrayMode(config) {
        $('#btn-cancelar-contato').off('click.contatoAjax click.contatoArray').on('click.contatoArray', function () {
            $('#form-contato-inline').slideUp(300);
            resetFormulario();
            if (typeof config.setIndexEdicao === 'function') {
                config.setIndexEdicao(null);
            }

            if (typeof config.onCancelar === 'function') {
                config.onCancelar();
            }

            if (typeof config.aplicarMascaras === 'function') {
                config.aplicarMascaras();
            }
        });

        $('#btn-save-contato').off('click.contatoAjax click.contatoArray').on('click.contatoArray', function () {
            var indexEdicao = typeof config.getIndexEdicao === 'function' ? config.getIndexEdicao() : null;
            var nome = $('#inline-nome').val().trim();
            var emails = obterEmailsContatoParaValidacao();
            var contatosAtuais = typeof config.getContatos === 'function' ? config.getContatos() : [];

            var erros = validarContatoInline({
                nome: nome,
                emails: emails,
                contatos: contatosAtuais,
                contatoAtualId: indexEdicao,
                isValidEmail: window.isValidEmail,
                getContatoId: function (c, index) { 
                    return index; 
                }
            });

            if (erros.length > 0) {
                var html = '<strong>Erros:</strong><ul><li>' + erros.join('</li><li>') + '</li></ul>';
                $('#form-contato-erros').html(html).show();
                return;
            }

            $('#form-contato-erros').hide();

            var camposContato = obterCamposContato();
            var contato = {
                nome: nome,
                email: JSON.stringify(camposContato.emails),
                telefone: JSON.stringify(camposContato.telefones),
                celular: JSON.stringify(camposContato.celulares),
                cargo: $('#inline-cargo').val().trim(),
                observacoes: $('#inline-observacoes').val().trim()
            };

            if (indexEdicao !== null && typeof config.updateContato === 'function') {
                config.updateContato(indexEdicao, contato);
            } else if (typeof config.addContato === 'function') {
                config.addContato(contato);
            }

            if (typeof config.onContatoSalvo === 'function') {
                config.onContatoSalvo(indexEdicao !== null);
            }

            $('#form-contato-inline').slideUp(300);
            resetFormulario();
            if (typeof config.setIndexEdicao === 'function') {
                config.setIndexEdicao(null);
            }

            if (typeof config.aplicarMascaras === 'function') {
                config.aplicarMascaras();
            }
        });
    }

    function initListActions(config) {
        $(document).off('click.formContatoListaEditar', '.btn-edit-contato').on('click.formContatoListaEditar', '.btn-edit-contato', function () {
            if (typeof config.onEditar !== 'function') {
                return;
            }

            config.onEditar($(this), function (contato, options) {
                abrirFormularioEdicao(contato || {}, {
                    aplicarMascaras: config.aplicarMascaras,
                    escapeHtml: config.escapeHtml,
                    focusNome: !options || options.focusNome !== false,
                    titulo: options && options.titulo ? options.titulo : 'Editar Contato'
                });
            });
        });

        $(document).off('click.formContatoListaExcluir', '.btn-delete-contato').on('click.formContatoListaExcluir', '.btn-delete-contato', function () {
            if (typeof config.onExcluir === 'function') {
                config.onExcluir($(this));
            }
        });
    }

    function bindEventos(aplicarMascaras) {
        $('#add-inline-email').off('click.formContatoInline').on('click.formContatoInline', function () {
            $('#container-inline-email').append(criarLinha('email', '', function (v) {
                return v;
            }));
        });

        $('#add-inline-telefone').off('click.formContatoInline').on('click.formContatoInline', function () {
            $('#container-inline-telefone').append(criarLinha('telefone', '', function (v) {
                return v;
            }));

            if (typeof aplicarMascaras === 'function') {
                aplicarMascaras();
            }
        });

        $('#add-inline-celular').off('click.formContatoInline').on('click.formContatoInline', function () {
            $('#container-inline-celular').append(criarLinha('celular', '', function (v) {
                return v;
            }));

            if (typeof aplicarMascaras === 'function') {
                aplicarMascaras();
            }
        });

        $(document).off('click.formContatoInline', '.remover-campo').on('click.formContatoInline', '.remover-campo', function () {
            var container = $(this).closest('.controls');
            if (container.children('.input-append-contatos').length > 1) {
                $(this).closest('.input-append-contatos').remove();
            } else {
                $(this).siblings('input').val('');
            }
        });
    }

    window.FormContatoInline = {
        abrirFormularioEdicao: abrirFormularioEdicao,
        bindEventos: bindEventos,
        criarLinha: criarLinha,
        initAjax: initAjax,
        initArrayMode: initArrayMode,
        initListActions: initListActions,
        limparCamposContato: limparCamposContato,
        obterCamposContato: obterCamposContato,
        obterEmailsContatoParaValidacao: obterEmailsContatoParaValidacao,
        parseJsonOrArray: parseJsonOrArray,
        preencherCamposContato: preencherCamposContato,
        renderTabelaContatos: renderTabelaContatos,
        resetFormulario: resetFormulario,
        validarContatoInline: validarContatoInline
    };
}(window, jQuery));
</script>
