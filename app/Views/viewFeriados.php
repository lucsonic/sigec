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
                <div class="titulos">Feriados cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-calendar-alt"></span>&nbsp;&nbsp;Novo Feriado</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="10%" style="text-align: center">
                                Mês
                            </th>
                            <th width="10%" style="text-align: center">
                                Dia
                            </th>
                            <th width="10%" style="text-align: center">
                                Ano
                            </th>
                            <th width="60%" style="text-align: left">
                                Descrição
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
                        if ($feriados) {
                            foreach ($feriados as $feriado) {
                        ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo $feriado['mes']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $feriado['dia']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $feriado['ano']; ?>
                                    </td>
                                    <td>
                                        <?php echo $feriado['descricao']; ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $feriado['idferiado']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Excluir">
                                            <a href="#" onclick="if(confirm('Deseja realmente excluir este feriado?'))window.location = 'excluir?id=<?= $feriado['idferiado']; ?>&desc=<?= $feriado['descricao']; ?>'">
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