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
if ($permissao['permissoes']['usuarios'] == '0') {
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
                <div class="titulos">Usuários cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Novo Usuário</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="34%" style="text-align: left">
                                Nome
                            </th>
                            <th width="26%" style="text-align: left">
                                Email
                            </th>
                            <th width="10%" style="text-align: center">
                                Login
                            </th>
                            <th width="15%" style="text-align: center">
                                Status
                            </th>
                            <th width='5%' style="text-align: center">
                                Permissões
                            </th>
                            <th width='5%' style="text-align: center">
                                Editar
                            </th>
                            <th width='5%' style="text-align: center">
                                Opção
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                        <?php
                        if ($usuarios) {
                            foreach ($usuarios as $user) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $user['nome']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['email']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $user['usuario']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($user['situacao'] == 'Ativo') {
                                            echo '<span style="color: green; font-weight: bold">' . $user['situacao'] . '</span>';
                                        } else {
                                            echo '<span style="color: red; font-weight: bold">' . $user['situacao'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Atribuir permissões">
                                            <span class="btn btn-sm btn-success" onclick="window.location = 'listarPermissoes?id=<?php echo $user['id']; ?>&name=<?php echo $user['nome']; ?>&perm=<?php echo $user['idPermissao']; ?>'">
                                                <span class="fas fa-check-square"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $user['id']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <?php if ($user['sts'] == '1') { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Desativar">
                                                <span class="btn btn-sm btn-danger" Onclick="window.location = 'desativar?id=<?php echo $user['id']; ?>&usuario=<?php echo $user['usuario']; ?>'">
                                                    <span class=" fas fa-ban"></span></span>
                                            </div>
                                        </td>
                                    <?php } else { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Reativar">
                                                <span class="btn btn-sm btn-warning" Onclick="window.location = 'reativar?id=<?php echo $user['id']; ?>&usuario=<?php echo $user['usuario']; ?>'">
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