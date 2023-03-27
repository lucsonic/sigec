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
if ($permissao['permissoes']['clientes'] == '0') {
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
                <div class="titulos">Clientes cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-user-plus"></span>&nbsp;&nbsp;Novo Cliente</a>
            <a class="btn btn-success" Onclick="window.location = 'exportExcel'"><span class="fas fa-file-excel"></span>&nbsp;&nbsp;Exportar para Excel</a>
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
                                Opção
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                        <?php
                        if ($clientes) {
                            foreach ($clientes as $cliente) {
                        ?>
                                <tr>
                                    <td>
                                        <a href="visualizar?id=<?= $cliente['idcliente']; ?>"><?php echo $cliente['nome_cliente']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo $cliente['endereco'] . ', ' . $cliente['bairro'] .  ' - ' . $cliente['cidade'] . '/' . $cliente['uf']; ?>
                                    </td>
                                    <td style="text-align: left">
                                        <?php echo $cliente['email']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($cliente['ativo'] == 1) {
                                            echo '<span style="color: green; font-weight: bold">Ativo</span>';
                                        } else {
                                            echo '<span style="color: red; font-weight: bold">Inativo</span>';
                                        }
                                        ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $cliente['idcliente']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <?php if ($cliente['ativo'] == 1) { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Desativar">
                                                <span class="btn btn-sm btn-danger" Onclick="window.location = 'desativar?id=<?php echo $cliente['idcliente']; ?>&nome=<?php echo $cliente['nome_cliente']; ?>'">
                                                    <span class=" fas fa-ban"></span></span>
                                            </div>
                                        </td>
                                    <?php } else { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Reativar">
                                                <span class="btn btn-sm btn-warning" Onclick="window.location = 'reativar?id=<?php echo $cliente['idcliente']; ?>&nome=<?php echo $cliente['nome_cliente']; ?>'">
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