<?php
$nome = $_SESSION['credenciais']["nome"];
$permissao = $_SESSION['permissoes'];
?>
<style>
    #dados td {
        vertical-align: middle;
    }

    #btn_novo:hover {
        background-color: #8B0000;
        color: white;
    }
</style>

<?php
if ($permissao['permissoes']['funcionarios'] == '0') {
?>

    <body>
        <div class='container-fluid' style="padding-top: 0px; text-align: center;">
            <img src="<?= base_url(); ?>/assets/img/403.png" width="80%">
        </div>
    </body>
<?php
} else {
?>

    <body>
        <div class='container-fluid' style="padding-top: 0px;">
            <div class="barra" style="margin-bottom: 5px;">
                <div class="titulos">Funcionários cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-user-tie"></span>&nbsp;&nbsp;Novo Funcionário</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="34%" style="text-align: left">
                                Nome
                            </th>
                            <th width="31%" style="text-align: left">
                                Endereço
                            </th>
                            <th width="10%" style="text-align: left">
                                Email
                            </th>
                            <th width="15%" style="text-align: center">
                                Situação
                            </th>
                            <th width='5%' style="text-align: center">
                                Editar
                            </th>
                            <th width='5%' style="text-align: center">
                                Opções
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                        <?php
                        if ($funcionarios) {
                            foreach ($funcionarios as $funcionario) {
                        ?>
                                <tr>
                                    <td>
                                        <a href="visualizar?id=<?= $funcionario['idfuncionario']; ?>"><?php echo $funcionario['nome_funcionario']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo $funcionario['endereco'] . ', ' . $funcionario['bairro'] .  ' - ' . $funcionario['cidade'] . '/' . $funcionario['uf']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $funcionario['email']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($funcionario['ativo'] == 1) {
                                            echo '<span style="color: green; font-weight: bold">Ativo</span>';
                                        } else {
                                            echo '<span style="color: red; font-weight: bold">Inativo</span>';
                                        }
                                        ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $funcionario['idfuncionario']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <?php if ($funcionario['ativo'] == 1) { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Desativar" style="float: left;">
                                                <span class="btn btn-sm btn-danger" Onclick="window.location = 'desativar?id=<?php echo $funcionario['idfuncionario']; ?>&nome=<?php echo $funcionario['nome_funcionario']; ?>'">
                                                    <span class=" fas fa-ban"></span></span>
                                            </div>
                                            <div data-toggle="tooltip" title="Folha de Ponto" style="float: right;">
                                                <span class="btn btn-sm btn-info" Onclick="window.location = 'folhaponto?id=<?php echo $funcionario['idfuncionario']; ?>&nome=<?php echo $funcionario['nome_funcionario']; ?>'">
                                                    <span class=" fas fa-file-alt"></span></span>
                                            </div>
                                        </td>
                                    <?php } else { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Reativar">
                                                <span class="btn btn-sm btn-warning" Onclick="window.location = 'reativar?id=<?php echo $funcionario['idfuncionario']; ?>&nome=<?php echo $funcionario['nome_funcionario']; ?>'">
                                                    <span class=" fas fa-reply"></span></span>
                                            </div>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                                </tr>
                            <?php
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
<?php } ?>