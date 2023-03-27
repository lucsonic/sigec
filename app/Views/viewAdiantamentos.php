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
if ($permissao['permissoes']['adiantamentos'] == '0') {
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
                <div class="titulos">Adiantamentos cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-hand-holding-usd"></span>&nbsp;&nbsp;Novo Adiantamento</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="35%" style="text-align: left">
                                Nome do Funcionário
                            </th>
                            <th width="10%" style="text-align: center">
                                Data Adiant.
                            </th>
                            <th width="10%" style="text-align: center">
                                Parcela
                            </th>
                            <th width="15%" style="text-align: center">
                                Situação
                            </th>
                            <th width="10%" style="text-align: right">
                                Valor
                            </th>
                            <th width="10%" style="text-align: center">
                                Data Pag.
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
                        if ($adiantamentos) {
                            foreach ($adiantamentos as $adiantamento) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $adiantamento['nome_funcionario']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo dataBR($adiantamento['data_adt']); ?>
                                    </td>
                                    <td>
                                        <?php echo $adiantamento['nparcela'] . ' de ' . $adiantamento['parcelas']; ?>
                                    </td style="text-align: center">
                                    <td style="text-align: center">
                                        <?php echo $adiantamento['situacao']; ?>
                                    </td>
                                    <td style="text-align: right">
                                        <?php echo mostraVlr($adiantamento['valor']); ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo dataBR($adiantamento['data_pag']); ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $adiantamento['idadiantamento']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Excluir">
                                            <a href="#" onclick="if(confirm('Deseja realmente excluir este adiantamento?'))window.location = 'excluir?id=<?= $adiantamento['idadiantamento']; ?>&func=<?= $adiantamento['nome_funcionario']; ?>'">
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