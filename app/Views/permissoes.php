<?php
$id = $_GET["id"];
$nome = $_GET["name"];
?>
<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos">Atribuição de Permissões</label>
    </div>
    <form id="formPermissoes" method="post" action="salvarPermissoes" class="form-horizontal">
        <div>
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $permissoes[0]['idUsuario'] ?>">
            <input type="hidden" id="idPermissao" name="idPermissao" value="<?= $permissoes[0]['idPermissao'] ?>">
            <input type="hidden" id="nome" name="nome" value="<?= $nome ?>">
            <div class="panel panel-default">
                <div class="padrao_titulo">Atribua as permissões desejadas
                    <span style="font-weight: lighter; font-style: italic; color: navy;">&nbsp;&nbsp;(Ao selecionar as permissões, clique no botão "Aplicar permissões").</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-12" style="text-align: left;">Nome do Usuário:&nbsp;<span style="color: blue;"><?= $nome; ?></span></label>
                        <hr>
                        <div class="col-md-2">
                            <div class="card" style="width: 28rem; text-align: center;">
                                <div class="card-header" style="background-color: green; height: 30px; padding-top: 5px;">
                                    <span style="color: white; font-weight: bold;">&nbsp;Cadastros</span>
                                </div>
                                <ul class="list-group list-group-flush" style="text-align: left;">
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['usuarios'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="usuarios" name="usuarios" checked>
                                            <label class="form-check-label" for="usuarios">Usuários</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="usuarios" name="usuarios">
                                            <label class="form-check-label" for="usuarios">Usuários</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['clientes'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="clientes" name="clientes" checked>
                                            <label class="form-check-label" for="clientes">Clientes</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="clientes" name="clientes">
                                            <label class="form-check-label" for="clientes">Clientes</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['funcionarios'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="funcionarios" name="funcionarios" checked>
                                            <label class="form-check-label" for="funcionarios">Funcionarios</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="funcionarios" name="funcionarios">
                                            <label class="form-check-label" for="funcionarios">Funcionarios</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['fornecedores'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="fornecedores" name="fornecedores" checked>
                                            <label class="form-check-label" for="fornecedores">Fornecedores</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="fornecedores" name="fornecedores">
                                            <label class="form-check-label" for="fornecedores">Fornecedores</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['produtos'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="produtos" name="produtos" checked>
                                            <label class="form-check-label" for="produtos">Produtos</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="produtos" name="produtos">
                                            <label class="form-check-label" for="produtos">Produtos</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['agenda'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="agenda" name="agenda" checked>
                                            <label class="form-check-label" for="agenda">Agenda</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="agenda" name="agenda">
                                            <label class="form-check-label" for="agenda">Agenda</label>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="card" style="width: 28rem; text-align: center;">
                                <div class="card-header" style="background-color: #912CEE; height: 30px; padding-top: 5px;">
                                    <span style="color: white; font-weight: bold;">Financeiro</span>
                                </div>
                                <ul class="list-group list-group-flush" style="text-align: left;">
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['receitas'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="receitas" name="receitas" checked>
                                            <label class="form-check-label" for="receitas">Receitas</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="receitas" name="receitas">
                                            <label class="form-check-label" for="receitas">Receitas</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['despesas'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="despesas" name="despesas" checked>
                                            <label class="form-check-label" for="despesas">Despesas</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="despesas" name="despesas">
                                            <label class="form-check-label" for="despesas">Despesas</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['vendas'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="vendas" name="vendas" checked>
                                            <label class="form-check-label" for="vendas">Vendas</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="vendas" name="vendas">
                                            <label class="form-check-label" for="vendas">Vendas</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['balancetes'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="balancetes" name="balancetes" checked>
                                            <label class="form-check-label" for="balancetes">Balancetes</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="balancetes" name="balancetes">
                                            <label class="form-check-label" for="balancetes">Balancetes</label>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="card" style="width: 28rem; text-align: center;">
                                <div class="card-header" style="background-color: blue; height: 30px; padding-top: 5px;">
                                    <span style="color: white; font-weight: bold;">Relatórios</span>
                                </div>
                                <ul class="list-group list-group-flush" style="text-align: left;">
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['relatorios_adm'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="relatorios_adm" name="relatorios_adm" checked>
                                            <label class="form-check-label" for="relatorios_adm">Relatórios Administrativos</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="relatorios_adm" name="relatorios_adm">
                                            <label class="form-check-label" for="relatorios_adm">Relatórios Administrativos</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['relatorios_fin'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="relatorios_fin" name="relatorios_fin" checked>
                                            <label class="form-check-label" for="relatorios_fin">Relatórios Financeiros</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="relatorios_fin" name="relatorios_fin">
                                            <label class="form-check-label" for="relatorios_fin">Relatórios Financeiros</label>
                                        <?php } ?>
                                    </li>
                                    <li class="list-group-item">
                                        <?php if ($permissoes[0]['log_acoes'] == 1) { ?>
                                            <input type="checkbox" class="form-check-input" id="log_acoes" name="log_acoes" checked>
                                            <label class="form-check-label" for="log_acoes">Log de Ações do Sistema</label>
                                        <?php } else { ?>
                                            <input type="checkbox" class="form-check-input" id="log_acoes" name="log_acoes">
                                            <label class="form-check-label" for="log_acoes">Log de Ações do Sistema</label>
                                        <?php } ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" class="btn btn-success" value="Aplicar permissões" />
            <a href="#" OnClick="window.location = 'usuarios'" class="btn btn-danger">Cancelar</a>
        </div><br><br><br><br><br>
    </form>
</div>