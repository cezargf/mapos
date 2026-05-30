<style>
@media (max-width: 767px) {
    .hide-on-mobile { display: none !important; }
}
@media (min-width: 768px) {
    .show-on-mobile { display: none !important; }
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
</style>
<div class="widget-box">
    <div class="widget-title" style="margin: 0;font-size: 1.1em">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Cliente</a></li>
            <li><a data-toggle="tab" href="#tab2">Ordens de Serviço</a></li>
            <li><a data-toggle="tab" href="#tab3">Vendas</a></li>
            <li><a data-toggle="tab" href="#tab4">Contatos</a></li>
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
                                <h5 style="padding-left: 28px">Dados Pessoais</h5>
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
                                        <?php echo $result->nomeCliente ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><strong>Documento</strong></td>
                                    <td>
                                        <?php echo $result->documento ?>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($result->dataCadastro)) ?>
                                    </td>
                                </tr>
                                <?php if ($result->prospectado) : ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Status de Prospecção</strong></td>
                                        <td>
                                            <span class="badge badge-success">Prospectado</span> 
                                            (Origem: <?php echo $result->origem_prospeccao ?: 'Não informada' ?>)
                                        </td>
                                    </tr>
                                <?php endif; ?>
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

                            <h5 style="margin-top: 15px;">Lista de Contatos Adicionais</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="border: 1px solid #ddd">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th class="hide-on-mobile">Telefone</th>
                                            <th class="hide-on-mobile">Celular</th>
                                            <th class="show-on-mobile">Telefone/Celular</th>
                                            <th>Email</th>
                                            <th>Cargo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-contatos-resumo">
                                        <?php if (!$contatos) { ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center">Nenhum contato adicional cadastrado</td>
                                            </tr>
                                        <?php } else {
                                            $parseJsonOrArray = function($val) {
                                                if (!$val || $val === 'null') return [];
                                                $decoded = json_decode($val, true);
                                                if (json_last_error() === JSON_ERROR_NONE) {
                                                    if ($decoded === null) return [];
                                                    if (is_string($decoded)) {
                                                        $inner = json_decode($decoded, true);
                                                        if (json_last_error() === JSON_ERROR_NONE && is_array($inner)) return $inner;
                                                    }
                                                    return is_array($decoded) ? $decoded : [$decoded];
                                                }
                                                if (strpos($val, ',') !== false) return array_filter(array_map('trim', explode(',', $val)));
                                                return [$val];
                                            };
                                            foreach ($contatos as $c) {
                                                $telefones = $parseJsonOrArray($c->telefone);
                                                $celulares = $parseJsonOrArray($c->celular);
                                                $emails = $parseJsonOrArray($c->email);

                                                $telLinks = [];
                                                foreach($telefones as $tel) {
                                                    $telClean = preg_replace('/[^0-9]/', '', $tel);
                                                    $telLinks[] = '<a href="tel:'.$telClean.'" title="Ligar" style="color: inherit; text-decoration: none;">'.htmlspecialchars($tel).' <i class="fas fa-phone" style="margin-left: 3px;"></i></a> <a href="https://wa.me/55'.$telClean.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                                                }
                                                $celLinks = [];
                                                foreach($celulares as $cel) {
                                                    $celClean = preg_replace('/[^0-9]/', '', $cel);
                                                    $celLinks[] = '<a href="https://wa.me/55'.$celClean.'" target="_blank" style="color: inherit; text-decoration: none;">'.htmlspecialchars($cel).' <i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                                                }

                                                $allTels = array_merge($telefones, $celulares);
                                                $telExibir = !empty($allTels) ? $allTels[0] : '';
                                                $whatsappLink = '---';
                                                if($telExibir) {
                                                    $waNumber = preg_replace('/[^0-9]/', '', $telExibir);
                                                    $whatsappLink = '<a href="tel:'.$waNumber.'" title="Ligar" style="color: inherit; text-decoration: none;">' . htmlspecialchars($telExibir) . ' <i class="fas fa-phone" style="margin-right: 5px;"></i></a>';
                                                    $whatsappLink .= ' <a href="https://wa.me/55'.$waNumber.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366;"></i></a>';
                                                    if(count($allTels) > 1) {
                                                        $whatsappLink .= ' <small>(+' . (count($allTels) - 1) . ')</small>';
                                                    }
                                                }
                                                
                                                $emailExibir = !empty($emails) ? $emails[0] : '';
                                                $emailLink = '---';
                                                if($emailExibir) {
                                                    $emailLink = '<a href="mailto:'.$emailExibir.'" title="Enviar E-mail" style="color: inherit;">'.htmlspecialchars($emailExibir).' <i class="fas fa-envelope" style="margin-left: 3px;"></i></a>';
                                                    if(count($emails) > 1) {
                                                        $emailLink .= ' <small>(+' . (count($emails) - 1) . ')</small>';
                                                    }
                                                }
                                                
                                                echo '<tr>';
                                                echo '<td>' . htmlspecialchars($c->nome) . '</td>';
                                                echo '<td class="hide-on-mobile">' . (!empty($telLinks) ? implode('<br>', $telLinks) : '---') . '</td>';
                                                echo '<td class="hide-on-mobile">' . (!empty($celLinks) ? implode('<br>', $celLinks) : '---') . '</td>';
                                                echo '<td class="show-on-mobile">' . $whatsappLink . '</td>';
                                                echo '<td>' . $emailLink . '</td>';
                                                echo '<td>' . htmlspecialchars($c->cargo) . '</td>';
                                                echo '</tr>';
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
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
        <!--Tab 4-->
        <div id="tab4" class="tab-pane" style="min-height: 300px">
            <div id="div-tabela-contatos">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hide-on-mobile">Telefone</th>
                        <th class="hide-on-mobile">Celular</th>
                        <th class="show-on-mobile">Telefone/Celular</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-contatos-aba">
                    <?php if (!$contatos) { ?>
                        <tr>
                            <td colspan="7" style="text-align: center">Nenhum contato cadastrado</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        $parseJsonOrArray = function($val) {
                            if (!$val || $val === 'null') return [];
                            $decoded = json_decode($val, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                if ($decoded === null) return [];
                                if (is_string($decoded)) {
                                    $inner = json_decode($decoded, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($inner)) return $inner;
                                }
                                return is_array($decoded) ? $decoded : [$decoded];
                            }
                            if (strpos($val, ',') !== false) return array_filter(array_map('trim', explode(',', $val)));
                            return [$val];
                        };
                        ?>
                        <?php foreach ($contatos as $c) {
                            $telefones = $parseJsonOrArray($c->telefone);
                            $celulares = $parseJsonOrArray($c->celular);
                            $emails = $parseJsonOrArray($c->email);
                            
                            $telLinks = [];
                            foreach($telefones as $tel) {
                                $telClean = preg_replace('/[^0-9]/', '', $tel);
                                $telLinks[] = '<a href="tel:'.$telClean.'" title="Ligar" style="color: inherit; text-decoration: none;">'.htmlspecialchars($tel).' <i class="fas fa-phone" style="margin-left: 3px;"></i></a> <a href="https://wa.me/55'.$telClean.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                            }
                            $celLinks = [];
                            foreach($celulares as $cel) {
                                $celClean = preg_replace('/[^0-9]/', '', $cel);
                                $celLinks[] = '<a href="https://wa.me/55'.$celClean.'" target="_blank" style="color: inherit; text-decoration: none;">'.htmlspecialchars($cel).' <i class="fab fa-whatsapp" style="color: #25d366; margin-left: 3px;"></i></a>';
                            }
                            $emailLinks = [];
                            foreach($emails as $em) {
                                $emailLinks[] = '<a href="mailto:'.$em.'" title="Enviar E-mail" style="color: inherit;">'.htmlspecialchars($em).' <i class="fas fa-envelope" style="margin-left: 3px;"></i></a>';
                            }
                            
                            $allTels = array_merge($telefones, $celulares);
                            $telExibir = !empty($allTels) ? $allTels[0] : '';
                            $whatsappLink = '---';
                            if($telExibir) {
                                $waNumber = preg_replace('/[^0-9]/', '', $telExibir);
                                $whatsappLink = '<a href="tel:'.$waNumber.'" title="Ligar" style="color: inherit; text-decoration: none;">' . htmlspecialchars($telExibir) . ' <i class="fas fa-phone" style="margin-right: 5px;"></i></a>';
                                $whatsappLink .= ' <a href="https://wa.me/55'.$waNumber.'" target="_blank" title="Abrir WhatsApp" style="color: inherit; text-decoration: none;"><i class="fab fa-whatsapp" style="color: #25d366;"></i></a>';
                                if(count($allTels) > 1) {
                                    $whatsappLink .= ' <small>(+' . (count($allTels) - 1) . ')</small>';
                                }
                            }
                            
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($c->nome) . '</td>';
                            echo '<td class="hide-on-mobile">' . (!empty($telLinks) ? implode('<br>', $telLinks) : '---') . '</td>';
                            echo '<td class="hide-on-mobile">' . (!empty($celLinks) ? implode('<br>', $celLinks) : '---') . '</td>';
                            echo '<td class="show-on-mobile">' . $whatsappLink . '</td>';
                            echo '<td>' . (!empty($emailLinks) ? implode('<br>', $emailLinks) : '---') . '</td>';
                            echo '<td>' . htmlspecialchars($c->cargo) . '</td>';
                            echo '<td>';
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                echo '<button type="button" class="btn btn-info btn-edit-contato" data-id="' . $c->idContatos . '" title="Editar Contato"><i class="fas fa-edit"></i></button>';
                            }
                            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                                echo ' <button type="button" class="btn btn-danger btn-delete-contato" data-id="' . $c->idContatos . '" data-nome="' . $c->nome . '" title="Excluir Contato"><i class="fas fa-trash-alt"></i></button>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) { ?>
                <button type="button" id="btn-novo-contato" class="btn btn-success"><i class="fas fa-plus"></i> Adicionar Contato</button>
            <?php } ?>
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
        <form id="form-contato-modal" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="modal-contato-titulo">Novo Contato</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="contato-id" name="idContatos" value="" />
                <input type="hidden" name="cliente_id" value="<?php echo $result->idClientes ?>" />
                
                <div class="control-group">
                    <label for="nome" class="control-label">Nome <span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" id="contato-nome" name="nome" class="span11" required />
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label for="telefone" class="control-label">Telefone</label>
                            <div class="controls">
                                <input type="text" id="contato-telefone" name="telefone" class="span11" />
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label for="celular" class="control-label">Celular</label>
                            <div class="controls">
                                <input type="text" id="contato-celular" name="celular" class="span11" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label for="email" class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" id="contato-email" name="email" class="span11" />
                    </div>
                </div>

                <div class="control-group">
                    <label for="cargo" class="control-label">Cargo</label>
                    <div class="controls">
                        <input type="text" id="contato-cargo" name="cargo" class="span11" />
                    </div>
                </div>

                <div class="control-group">
                    <label for="observacoes" class="control-label">Observações</label>
                    <div class="controls">
                        <textarea id="contato-observacoes" name="observacoes" class="span11" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
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
            // Máscaras
            $('#contato-telefone').mask('(00) 0000-0000');
            $('#contato-celular').mask('(00) 00000-0000');

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
                $('#form-contato-modal')[0].reset();
                $('#contato-id').val('');
                $('#modal-contato-titulo').text('Novo Contato');
                $('#modal-contato').modal('show');
            });

            // Abrir modal para editar contato
            $(document).on('click', '.btn-edit-contato', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '<?php echo site_url('clientes/getContatoById') ?>',
                    type: 'POST',
                    data: { 
                        idContatos: id,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            var c = response.data;
                            $('#contato-id').val(c.idContatos);
                            $('#contato-nome').val(c.nome);
                            $('#contato-telefone').val(c.telefone).trigger('input');
                            $('#contato-celular').val(c.celular).trigger('input');
                            $('#contato-email').val(c.email);
                            
                            var parseJson = function(val) {
                                if (!val) return '';
                                try { var arr = JSON.parse(val); return arr.length > 0 ? arr[0] : ''; } catch(e) { return val; }
                            };
                            
                            $('#contato-telefone').val(parseJson(c.telefone)).trigger('input');
                            $('#contato-celular').val(parseJson(c.celular)).trigger('input');
                            $('#contato-email').val(parseJson(c.email));
                            $('#contato-cargo').val(c.cargo);
                            $('#contato-observacoes').val(c.observacoes);
                            
                            $('#modal-contato-titulo').text('Editar Contato');
                            $('#modal-contato').modal('show');
                        }
                    }
                });
            });

            // Salvar Contato (Adicionar ou Editar)
            $('#form-contato-modal').submit(function(e) {
                e.preventDefault();
                var id = $('#contato-id').val();
                var url = id ? '<?php echo site_url('clientes/editarContato') ?>' : '<?php echo site_url('clientes/adicionarContato') ?>';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#modal-contato').modal('hide');
                            location.reload(); // Recarrega para atualizar a lista
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            // Abrir modal de exclusão
            $(document).on('click', '.btn-delete-contato', function() {
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                $('#excluir-idContato').val(id);
                $('#excluir-nomeContato').text(nome);
                $('#modal-excluir-contato').modal('show');
            });

            // Confirmar exclusão
            $('#btn-confirm-excluir').click(function() {
                var id = $('#excluir-idContato').val();
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
                            location.reload();
                        } else {
                            alert(response.message);
                        }
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
