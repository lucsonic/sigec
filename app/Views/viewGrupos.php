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
if ($permissao['permissoes']['produtos'] == '0') {
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
                <div class="titulos">Grupos cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-layer-group"></span>&nbsp;&nbsp;Novo Grupo</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="90%" style="text-align: left">
                                Descrição do Grupo
                            </th>
                            <th width='5%' style="text-align: center">
                                Editar
                            </th>
                            <th width='5%' style="text-align: center">
                                Excluir
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                        <?php
                        if ($grupos) {
                            foreach ($grupos as $grupo) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $grupo['descricao']; ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $grupo['idgrupo']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Excluir">
                                            <a href="#" onclick="if(confirm('Deseja realmente excluir este cliente?'))window.location = 'excluir?id=<?= $grupo['idgrupo']; ?>&desc=<?= $grupo['descricao']; ?>'">
                                                <span class="btn btn-sm btn-danger"><span class=" fas fa-trash-alt"></span></span></a>
                                        </div>
                                    </td>
                                <?php
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