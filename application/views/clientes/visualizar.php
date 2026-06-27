<style>
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
        max-height: 40px;
        height: 100%;
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

    #modal-contato {
        width: 600px;
        height: auto;
        left: 50%;
        top: 50%;
        margin: 0;
        transform: translate(-50%, -50%);
    }

    #modal-contato .modal-body {
        max-height: calc(100vh - 160px);
        overflow-y: auto;
        padding: 15px;
    }

    #modal-contato #form-contato-inline {
        display: block !important;
        margin-bottom: 0;
    }

    #modal-contato #form-contato-inline .row-fluid [class*="span"] {
        width: 100%;
        float: none;
        margin-left: 0;
    }

    #modal-contato #form-contato-inline .control-group .controls {
        display: flex;
        flex-wrap: wrap;
    }

    #modal-contato #form-contato-inline .control-group .controls input,
    #modal-contato #form-contato-inline .control-group .controls textarea {
        width: 100%;
    }

    #modal-contato #container-inline-telefone,
    #modal-contato #container-inline-celular {
        display: inline-flex;
        width: 100%;
    }

    #modal-contato #container-inline-email .input-append-contatos input,
    #modal-contato #container-inline-telefone .input-append-contatos input,
    #modal-contato #container-inline-celular .input-append-contatos input {
        width: 230px !important;
    }

    @media (max-width: 767px) {
        .hide-on-mobile { display: none !important; }
    }
    @media (min-width: 768px) {
        .show-on-mobile { display: none !important; }
    }
    @media (max-width: 640px) {
        #modal-contato {
            width: calc(100% - 20px);
        }
        .modal-footer .button {
            min-width: 90px !important;
            margin-bottom: 10px;
        }
    }
    @media (max-width: 480px) {
        #modal-contato #container-inline-email .input-append-contatos,
        #modal-contato #container-inline-telefone .input-append-contatos,
        #modal-contato #container-inline-celular .input-append-contatos {
            width: 100%;
        }
    }
</style>
<?php
$documentoLimpo = preg_replace('/\D/', '', $result->documento ?? '');
$isPessoaFisica = isset($result->pessoa_fisica) && $result->pessoa_fisica !== ''
    ? (bool) $result->pessoa_fisica
    : strlen($documentoLimpo) <= 11;
$dadosClienteTitulo = $isPessoaFisica ? 'Dados Pessoais' : 'Dados da Empresa';

function valorOuTraco($valor)
{
    if ($valor === null) {
        return '---';
    }

    $texto = trim((string) $valor);

    return $texto !== '' ? $texto : '---';
}

function dataOuTraco($valor)
{
    if (empty($valor) || $valor === '0000-00-00') {
        return '---';
    }

    $timestamp = strtotime($valor);

    return $timestamp ? date('d/m/Y', $timestamp) : '---';
}
?>
<div class="widget-box">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Cliente</a></li>
            <li><a data-toggle="tab" href="#tab2">Ordens de Serviço</a></li>
            <li><a data-toggle="tab" href="#tab3">Vendas</a></li>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span><i class='bx bx-user icon-cli' ></i></span>
                                <h5 style="padding-left: 28px"><?php echo $dadosClienteTitulo; ?></h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Código</strong></td>
                                    <td>
                                        <?php echo $result->idClientes; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                    <td>
                                        <?php echo $isPessoaFisica && !empty($result->tratamento)
                                            ? $result->tratamento . ' ' . $result->nomeCliente
                                            : $result->nomeCliente; ?>
                                    </td>
                                </tr>
                                <?php if ($isPessoaFisica) { ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Tratamento</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->tratamento ?? null); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Data de Nascimento</strong></td>
                                        <td>
                                            <?php echo dataOuTraco($result->nascimento ?? null); ?>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Nome Fantasia</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->fantasia ?? null); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Tipo</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->tipo ?? null); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Porte</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->porte ?? null); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Atividade Principal</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->atividade_principal ?? null); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Situação</strong></td>
                                        <td>
                                            <?php echo valorOuTraco($result->situacao ?? null); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="text-align: right"><strong>Documento</strong></td>
                                    <td>
                                        <?php echo $result->documento ?>
                                    </td>
                                </tr>
                                <?php if (!$isPessoaFisica) { ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Inscrição Estadual (IE)</strong></td>
                                        <td>
                                            <?php echo !empty($result->ie) ? $result->ie : '---' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Inscrição Municipal (IM)</strong></td>
                                        <td>
                                            <?php echo !empty($result->im) ? $result->im : '---' ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($result->dataCadastro)) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Tipo do Cliente</strong></td>
                                    <td>
                                        <?php echo $result->fornecedor == true ? 'Fornecedor' : 'Cliente'; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span><i class='bx bx-phone icon-cli'></i></span>
                                <h5 style="padding-left: 28px">Contatos</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                            <table class="table table-bordered" style="border: 1px solid #ddd">
                                <tbody>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Contato:</strong></td>
                                    <td>
                                        <?php echo $result->contato ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right; width: 30%"><strong>Telefone</strong></td>
                                    <td>
                                        <?php 
                                            if($result->telefone) {
                                                $telClean = preg_replace('/[^0-9]/', '', $result->telefone);
                                                echo '<a href="tel:'.$telClean.'" title="Ligar" style="color: inherit; text-decoration: none;">' . $result->telefone . ' <i class="fas fa-phone" style="margin-left: 3px;"></i></a>';
                                                echo ' <a href="https://wa.me/55'.$telClean.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                                            } else {
                                                echo '---';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Celular</strong></td>
                                    <td>
                                        <?php 
                                            if($result->celular) {
                                                $whatsapp = preg_replace('/[^0-9]/', '', $result->celular);
                                                echo '<a href="https://wa.me/55'.$whatsapp.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;">' . $result->celular . ' <i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                                            } else {
                                                echo '---';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Email</strong></td>
                                    <td>
                                        <?php echo $result->email ? '<a href="mailto:'.$result->email.'" title="Enviar E-mail" style="color: inherit;">'.$result->email.' <i class="fas fa-envelope" style="margin-left: 3px;"></i></a>' : '---' ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div style="display:flex;justify-content:space-between;align-items:center;margin: 10px 0 15px;">
                                <h5 style="margin: 0;">Lista de Contatos Adicionais</h5>
                                <span class="badge badge-info" id="badge-contatos">0</span>
                            </div>

                            <div class="table-responsive">
                                <table id="table-contatos" class="table table-bordered" style="border: 1px solid #ddd">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Celular</th>
                                            <th>Cargo</th>
                                            <th style="text-align: center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contatos-table-body"></tbody>
                                </table>
                            </div>

                            <div id="msg-sem-contatos" class="alert alert-info" style="display:none;margin-top:10px;">
                                Nenhum contato adicional cadastrado.
                            </div>

                            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) { ?>
                                <div style="display:flex;justify-content:flex-end;margin-top: 10px; padding-top: 10px; border-top: 1px solid #ccc;">
                                    <button type="button" id="btn-novo-contato" class="button btn btn-mini btn-success">
                                        <span class="button__icon"><i class="bx bx-plus"></i></span>
                                        <span class="button__text2"> Adicionar Contato</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                <span><i class='bx bx-map-alt icon-cli' ></i></span>
                                <h5 style="padding-left: 28px">Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGThree">
                        <div class="widget-content">
                            <table class="table table-bordered th" style="border: 1px solid #ddd;border-left: 1px solid #ddd">
                                <tbody>
                                <tr>
                                    <td style="text-align: right; width: 30%;"><strong>Rua</strong></td>
                                    <td>
                                        <?php echo $result->rua ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Número</strong></td>
                                    <td>
                                        <?php echo $result->numero ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Complemento</strong></td>
                                    <td>
                                        <?php echo $result->complemento ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Bairro</strong></td>
                                    <td>
                                        <?php echo $result->bairro ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Cidade</strong></td>
                                    <td>
                                        <?php echo $result->cidade ?> -
                                        <?php echo $result->estado ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>CEP</strong></td>
                                    <td>
                                        <?php echo $result->cep ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div id="map" style="height: 300px; width: 100%; margin-top: 15px; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
            <?php if (!$results) { ?>
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>N° OS</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Descricao</th>
                        <th>Defeito</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">Nenhuma OS Cadastrada</td>
                    </tr>
                    </tbody>
                </table>
                <?php
            } else { ?>
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>N° OS</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Descricao</th>
                        <th>Defeito</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($results as $r) {
                        $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                        $dataFinal = date(('d/m/Y'), strtotime($r->dataFinal));
                        
                        switch ($r->status) {
                            case 'Aberto': $cor = '#00cd00'; break;
                            case 'Em Andamento': $cor = '#436eee'; break;
                            case 'Orçamento': $cor = '#CDB380'; break;
                            case 'Negociação': $cor = '#AEB404'; break;
                            case 'Cancelado': $cor = '#CD0000'; break;
                            case 'Finalizado': $cor = '#256'; break;
                            case 'Faturado': $cor = '#B266FF'; break;
                            case 'Aguardando Peças': $cor = '#FF7F00'; break;
                            case 'Aprovado': $cor = '#808080'; break;
                            default: $cor = '#E0E4CC'; break;
                        }
                        
                        echo '<tr>';
                        echo '<td style="border-left: 4px solid ' . $cor . ' !important;">' . $r->idOs . '</td>';
                        echo '<td>' . $dataInicial . '</td>';
                        echo '<td>' . $dataFinal . '</td>';
                        echo '<td>' . $r->descricaoProduto . '</td>';
                        echo '<td>' . $r->defeito . '</td>';
                        echo '<td style="text-align: center"><span class="badge" style="background-color: ' . $cor . '; border-color: ' . $cor . '">' . $r->status . '</span></td>';

                        echo '<td style="text-align: center">';
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
                            echo '<a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                            echo '<a href="' . base_url() . 'index.php/os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="fas fa-edit"></i></a>';
                        }

                        echo  '</td>';
                        echo '</tr>';
                    } ?>
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <?php
            } ?>
        </div>
        <!--Tab 3-->
        <div id="tab3" class="tab-pane" style="min-height: 300px">
            <?php if (!$result_vendas) { ?>
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>N° Venda</th>
                        <th>Data</th>
                        <th>Faturado</th>
                        <th>Total</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6">Nenhuma Venda Cadastrada</td>
                    </tr>
                    </tbody>
                </table>
                <?php
            } else { ?>
                <table class="table table-bordered ">
                    <thead>
                    <tr>
			            <th>N° Venda</th>
                        <th>Data</th>
                        <th>Faturado</th>
                        <th>Total</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($result_vendas as $r) {
                        $dataVenda = date(('d/m/Y'), strtotime($r->dataVenda));
                        if ($r->faturado == 1) {
                            $faturado = 'Sim';
                        } else {
                            $faturado = 'Não';
                        }
                        
                        switch ($r->status) {
                            case 'Aberto': $cor = '#00cd00'; break;
                            case 'Em Andamento': $cor = '#436eee'; break;
                            case 'Orçamento': $cor = '#CDB380'; break;
                            case 'Negociação': $cor = '#AEB404'; break;
                            case 'Cancelado': $cor = '#CD0000'; break;
                            case 'Finalizado': $cor = '#256'; break;
                            case 'Faturado': $cor = '#B266FF'; break;
                            case 'Aguardando Peças': $cor = '#FF7F00'; break;
                            case 'Aprovado': $cor = '#808080'; break;
                            default: $cor = '#E0E4CC'; break;
                        }
                        
                        echo '<tr>';
                        echo '<td style="border-left: 4px solid ' . $cor . ' !important;">' . $r->idVendas . '</td>';
                        echo '<td>' . $dataVenda . '</td>';
                        echo '<td>' . $faturado . '</td>';
                        echo '<td>R$' . $r->valorTotal. '</td>';
                        echo '<td style="text-align: center"><span class="badge" style="background-color: ' . $cor . '; border-color: ' . $cor . '">' . $r->status . '</span></td>';

                        echo '<td style="text-align: center">';
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
                            echo '<a href="' . base_url() . 'index.php/vendas/visualizar/' . $r->idVendas . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="fas fa-eye"></i></a>';
                        }
                        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
                            echo '<a href="' . base_url() . 'index.php/vendas/editar/' . $r->idVendas . '" class="btn btn-info tip-top" title="Editar Venda"><i class="fas fa-edit"></i></a>';
                        }
                        echo  '</td>';
                        echo '</tr>';
                    } ?>
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <?php
            } ?>
        </div>
    </div>
    <div class="modal-footer" style="display:flex;justify-content: center">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            echo '<a title="Editar" class="button btn btn-mini btn-info" style="min-width: 140px; top:10px" href="' . base_url() . 'index.php/clientes/editar/' . $result->idClientes . '">
<span class="button__icon"><i class="bx bx-edit"></i></span> <span class="button__text2"> Editar</span></a>';
        } ?>
        
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) { ?>
            <a title="Excluir" id="btn-excluir-cliente" class="button btn btn-mini btn-danger" style="min-width: 140px; top:10px">
            <span class="button__icon"><i class="bx bx-trash"></i></span> <span class="button__text2"> Excluir</span></a>
        <?php } ?>

        <a title="Voltar" class="button btn btn-mini btn-warning" style="min-width: 140px; top:10px" href="<?php echo site_url() ?>/clientes">
          <span class="button__icon"><i class="bx bx-undo"></i></span><span class="button__text2">Voltar</span></a>
    </div>

    <!-- Modal Adicionar/Editar Contato -->
    <div id="modal-contato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="modal-contato-titulo">Novo Contato</h3>
        </div>
        <div class="modal-body">
            <?php $use_inline_index = 0; $this->load->view('clientes/contatos/formContato'); ?>
        </div>
    </div>

    <!-- Modal Excluir Contato -->
    <div id="modal-excluir-contato" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Excluir Contato</h3>
        </div>
        <div class="modal-body">
            <input type="hidden" id="excluir-idContato" value="" />
            <h5 style="text-align: center">Deseja realmente excluir o contato <strong id="excluir-nomeContato"></strong>?</h5>
            <p style="text-align: center; color: red;">Esta ação não pode ser desfeita!</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger" id="btn-confirm-excluir">Excluir</button>
        </div>
    </div>

    <!-- Modal Exclusão Inteligente de Cliente -->
    <div id="modal-excluir-cliente" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form action="<?php echo base_url() ?>index.php/clientes/excluir" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Excluir Cliente</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $result->idClientes ?>" />
                
                <div id="alerta-pendencias" style="display:none;">
                    <div class="alert alert-danger">
                        <strong>Atenção!</strong> Foram encontradas as seguintes pendências para este cliente:
                        <ul id="lista-pendencias" style="margin-top: 10px;"></ul>
                    </div>
                    <h5 style="text-align: center">Como deseja tratar os lançamentos e cobranças em aberto?</h5>
                    <div style="text-align: center; margin-top: 15px;">
                        <label class="radio inline">
                            <input type="radio" name="confirm_financeiro" value="received" checked> Marcar como Recebido
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="confirm_financeiro" value="delete"> Apenas Excluir tudo
                        </label>
                    </div>
                </div>

                <div id="alerta-limpo" style="display:none;">
                    <h5 style="text-align: center">Deseja realmente excluir o cliente <strong><?php echo $result->nomeCliente ?></strong>?</h5>
                    <p style="text-align: center; color: red;">Todos os dados associados serão removidos permanentemente!</p>
                </div>

                <div id="carregando-pendencias" style="text-align: center; padding: 20px;">
                    <i class="fas fa-spinner fa-spin fa-2x"></i><br>Verificando pendências...
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button type="submit" id="btn-final-excluir" class="btn btn-danger" style="display:none;">Confirmar Exclusão</button>
            </div>
        </form>
    </div>

    <!-- Leaflet Assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var clienteId = <?php echo (int) $result->idClientes; ?>;
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            var podeEditarContato = <?php echo $this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente') ? 'true' : 'false'; ?>;
            var podeExcluirContato = <?php echo $this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente') ? 'true' : 'false'; ?>;
            var contatosList = <?php echo json_encode($contatos ?: [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
            var contatoEmEdicaoId = null;

            function escapeHtml(value) {
                return $('<div>').text(value == null ? '' : String(value)).html();
            }

            function aplicarMascaras() {
                $('.mascara-telefone').mask('(00) 0000-0000');
                $('.mascara-celular').mask('(00) 00000-0000');
            }

            function renderContatos() {
                FormContatoInline.renderTabelaContatos({
                    contatos: contatosList,
                    escapeHtml: escapeHtml,
                    tableSelector: '#table-contatos',
                    tbodySelector: '#contatos-table-body',
                    emptySelector: '#msg-sem-contatos',
                    badgeSelector: '#badge-contatos',
                    getActionButtons: function (contato, index, helpers) {
                        var acoes = '';

                        if (podeEditarContato) {
                            acoes += helpers.criarBotaoAcao('edit', {
                                'data-id': contato.idContatos
                            });
                        }

                        if (podeExcluirContato) {
                            acoes += helpers.criarBotaoAcao('delete', {
                                'data-id': contato.idContatos,
                                'data-nome': helpers.escapeHtml(contato.nome || '')
                            });
                        }

                        return acoes;
                    }
                });
            }

            function carregarContatos() {
                var requestData = {
                    cliente_id: clienteId
                };

                requestData[csrfName] = csrfHash;

                $.ajax({
                    url: '<?php echo site_url('clientes/getContatos') ?>',
                    type: 'POST',
                    data: requestData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            contatosList = response.data || [];
                            renderContatos();
                        }
                    },
                    error: function () {
                        alert('Erro ao carregar contatos.');
                    }
                });
            }

            function abrirModalNovoContato() {
                contatoEmEdicaoId = null;
                $('#modal-contato-titulo').text('Novo Contato');
                $('#form-contato-titulo').text('Adicionar Contato');
                FormContatoInline.resetFormulario();
                $('#form-contato-inline').show();
                $('#modal-contato').modal('show');
                aplicarMascaras();
                $('#inline-nome').focus();
            }

            function abrirModalEdicaoContato(contato) {
                contatoEmEdicaoId = contato.idContatos || null;
                $('#modal-contato-titulo').text('Editar Contato');
                $('#modal-contato').modal('show');
                FormContatoInline.abrirFormularioEdicao(contato, {
                    aplicarMascaras: aplicarMascaras,
                    titulo: 'Editar Contato'
                });
            }

            renderContatos();
            FormContatoInline.bindEventos(aplicarMascaras);
            aplicarMascaras();

            FormContatoInline.initListActions({
                aplicarMascaras: aplicarMascaras,
                escapeHtml: escapeHtml,
                onEditar: function ($button, abrirFormulario) {
                    var idContato = $button.data('id');

                    $.ajax({
                        url: '<?php echo site_url('clientes/getContatoById') ?>',
                        type: 'POST',
                        data: {
                            idContatos: idContato,
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                abrirModalEdicaoContato(response.data);
                            }
                        }
                    });
                },
                onExcluir: function ($button) {
                    var idContato = $button.data('id');
                    var nome = $button.data('nome');
                    $('#excluir-idContato').val(idContato);
                    $('#excluir-nomeContato').text(nome);
                    $('#modal-excluir-contato').modal('show');
                }
            });

            FormContatoInline.initAjax({
                getIdContato: function () { return contatoEmEdicaoId; },
                getClienteId: function () { return clienteId; },
                getContatosParaValidacao: function () { return contatosList; },
                aplicarMascaras: aplicarMascaras,
                onCancelar: function () {
                    contatoEmEdicaoId = null;
                    $('#modal-contato').modal('hide');
                },
                onSalvoComSucesso: function () {
                    contatoEmEdicaoId = null;
                    $('#modal-contato').modal('hide');
                    carregarContatos();
                },
                onErro: function (msg) {
                    alert(msg);
                }
            });

            // Abrir modal de exclusão inteligente
            $('#btn-excluir-cliente').click(function() {
                $('#modal-excluir-cliente').modal('show');
                $('#carregando-pendencias').show();
                $('#alerta-pendencias, #alerta-limpo, #btn-final-excluir').hide();

                $.getJSON('<?php echo site_url('clientes/checkPendencias') ?>', { id: "<?php echo $result->idClientes ?>" }, function(response) {
                    $('#carregando-pendencias').hide();
                    if (response.status === 'success') {
                        var p = response.data;
                        var temPendencia = (p.os > 0 || p.vendas > 0 || p.lancamentos > 0 || p.cobrancas > 0);

                        if (temPendencia) {
                            var list = '';
                            if (p.os > 0) list += '<li>' + p.os + ' Ordem(ns) de Serviço</li>';
                            if (p.vendas > 0) list += '<li>' + p.vendas + ' Venda(s)</li>';
                            if (p.lancamentos > 0) list += '<li>' + p.lancamentos + ' Lançamento(s) financeiro(s) em aberto</li>';
                            if (p.cobrancas > 0) list += '<li>' + p.cobrancas + ' Cobrança(s) pendente(s)</li>';
                            
                            $('#lista-pendencias').html(list);
                            $('#alerta-pendencias').show();
                        } else {
                            $('#alerta-limpo').show();
                        }
                        $('#btn-final-excluir').show();
                    }
                });
            });

            // Abrir modal para novo contato
            $('#btn-novo-contato').click(function() {
                abrirModalNovoContato();
            });

            // Confirmar exclusão
            $('#btn-confirm-excluir').click(function() {
                var id = $('#excluir-idContato').val();
                var $button = $(this);

                if ($button.prop('disabled')) {
                    return;
                }

                $button.prop('disabled', true);

                $.ajax({
                    url: '<?php echo site_url('clientes/deletarContato') ?>',
                    type: 'POST',
                    data: { 
                        idContatos: id,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#modal-excluir-contato').modal('hide');
                            carregarContatos();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Erro ao excluir contato.');
                    },
                    complete: function() {
                        $button.prop('disabled', false);
                    }
                });
            });

            // Lógica do Mapa
            var map;
            var lat = "<?php echo $result->latitude; ?>";
            var lon = "<?php echo $result->longitude; ?>";
            var address = "<?php echo $result->rua . ', ' . $result->numero . ', ' . $result->bairro . ', ' . $result->cidade . ' - ' . $result->estado . ', ' . $result->cep; ?>";

            function initMap(latitude, longitude) {
                if (!map) {
                    map = L.map('map').setView([latitude, longitude], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    L.marker([latitude, longitude]).addTo(map)
                        .bindPopup("<strong><?php echo addslashes($result->nomeCliente); ?></strong><br>" + address)
                        .openPopup();
                } else {
                    map.setView([latitude, longitude], 15);
                    map.invalidateSize();
                }
            }

            // Inicia o mapa quando o accordion de endereço for aberto
            // Compatibilidade BS2 (shown) e BS3+ (shown.bs.collapse)
            $('#collapseGThree').on('shown shown.bs.collapse', function () {
                if (lat && lon && parseFloat(lat) != 0) {
                    initMap(lat, lon);
                    return;
                }

                // Lógica de Geocodificação com Cache e Fallback
                var cacheKey = 'geo_' + btoa(unescape(encodeURIComponent(address)));
                var cached = localStorage.getItem(cacheKey);

                if (cached) {
                    var coords = JSON.parse(cached);
                    initMap(coords.lat, coords.lon);
                    return;
                }

                $('#map').html('<div style="text-align: center; padding-top: 100px;"><i class="fas fa-spinner fa-spin"></i> Buscando localização...</div>');

                // Tentativa 1: Nominatim
                $.getJSON('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address) + '&limit=1', function(data) {
                    if (data && data.length > 0) {
                        localStorage.setItem(cacheKey, JSON.stringify({lat: data[0].lat, lon: data[0].lon}));
                        $('#map').html('');
                        initMap(data[0].lat, data[0].lon);
                    } else {
                        // Tentativa 2: Photon (Fuzzy Search - mais tolerante a erros)
                        $.getJSON('https://photon.komoot.io/api/?q=' + encodeURIComponent(address) + '&limit=1', function(data) {
                            if (data && data.features && data.features.length > 0) {
                                var c = data.features[0].geometry.coordinates;
                                localStorage.setItem(cacheKey, JSON.stringify({lat: c[1], lon: c[0]}));
                                $('#map').html('');
                                initMap(c[1], c[0]);
                            } else {
                                $('#map').html('<div class="alert alert-warning" style="margin: 20px;">Não conseguimos localizar este endereço no mapa automaticamente.</div>');
                            }
                        });
                    }
                }).fail(function() {
                    $('#map').html('<div class="alert alert-error" style="margin: 20px;">Erro ao carregar o serviço de mapas. Verifique sua conexão.</div>');
                });
            });
        });
    </script>
</div>
