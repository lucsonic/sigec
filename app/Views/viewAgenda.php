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
if ($permissao['permissoes']['agenda'] == '0') {
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
                <div class="titulos">Agendamentos cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-address-card"></span>&nbsp;&nbsp;Novo Agendamento</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="10%" style="text-align: center">
                                Data
                            </th>
                            <th width="30%" style="text-align: left">
                                Compromisso
                            </th>
                            <th width="10%" style="text-align: center">
                                Horário
                            </th>
                            <th width="15%" style="text-align: left">
                                Local
                            </th>
                            <th width="10%" style="text-align: left">
                                Contato
                            </th>
                            <th width="15%" style="text-align: left">
                                Telefones
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
                        if ($agendas) {
                            foreach ($agendas as $agenda) {
                        ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo dataBR($agenda['data_comp']); ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $agenda['compromisso']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $agenda['horario']; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $agenda['local']; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $agenda['nome_contato']; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php echo $agenda['telefones']; ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $agenda['idagenda']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Excluir">
                                            <a href="#" onclick="if(confirm('Deseja realmente excluir este agendamento?'))window.location = 'excluir?id=<?= $agenda['idagenda']; ?>&desc=<?= $agenda['compromisso']; ?>'">
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