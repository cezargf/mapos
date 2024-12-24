<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Meus Dados</a></li>

            <div class="buttons" style="float: inline-start; margin: 5px 0 0 10px;">
                <a title="Editar" class="button btn btn-success" style="max-width: 140px;" href="<?php echo base_url() ?>index.php/mine/editarDados/<?php echo $result->idClientes ?>">
                  <span class="button__icon"><i class="bx bx-edit"></i> </span> <span class="button__text2">Editar</span></a>
            </div>
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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong><?= $result->pessoa_fisica ? 'Nome:' : 'Razão Social:';?></strong></td>
                                        <td>
                                            <?php echo $result->nomeCliente ?>
                                        </td>
                                    </tr>
                                    <?php if ( ! $result->pessoa_fisica) : ?>
                                        <tr>
                                            <td style="text-align: right; width: 30%"><strong>Nome Fantasia:</strong></td>
                                            <td>
                                                <?php echo $result->nomeFantasia ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td style="text-align: right"><strong><?= $result->pessoa_fisica ? 'CPF:' : 'CNPJ:' ;?></strong></td>
                                        <td>
                                            <?php echo $result->documento ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong><?= $result->pessoa_fisica ? 'RG:' : 'IE:' ;?></strong></td>
                                        <td>
                                            <?php echo $result->rg_ie ?>
                                        </td>
                                    </tr>
                                    <?php if ($result->pessoa_fisica) : ?>
                                        <tr>
                                            <td style="text-align: right;"><strong>Nascimento:</strong></td>
                                            <td>
                                                <?php echo date('d/m/Y', strtotime($result->dataNascimento)) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right"><strong>Sexo:</strong></td>
                                            <td>
                                                <?php echo $result->sexo ?>
                                            </td>
                                        </tr>
                                    <?php endif ; ?>
                                    <tr>
                                        <td style="text-align: right"><strong>Data de Cadastro:</strong></td>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($result->dataCadastro)) ?>
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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Contato:</strong></td>
                                        <td>
                                            <?php echo $result->contato ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone:</strong></td>
                                        <td>
                                            <?php echo $result->telefone ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Celular:</strong></td>
                                        <td>
                                            <?php echo $result->celular ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><strong>Email:</strong></td>
                                        <td>
                                            <?php echo $result->email ?>
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
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                              <span><i class='bx bx-map-alt icon-cli' ></i></span>
                              <h5 style="padding-left: 28px">Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGThree">
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Rua</strong></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
