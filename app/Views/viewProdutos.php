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
                <div class="titulos">Produtos cadastrados</div>
                <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
            </div>
            <a class="btn cortema" id="btn_novo" Onclick="window.location = 'criar'"><span class="fas fa-box-open"></span>&nbsp;&nbsp;Novo Produto</a>
            <br />
            <br />
            <div class="row" style="margin-bottom: 80px;">
                <table id="tblDados" class="table table-striped table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="50%" style="text-align: left">
                                Descrição do Produto
                            </th>
                            <th width="10%" style="text-align: center">
                                Marca
                            </th>
                            <th width="10%" style="text-align: center">
                                Modelo
                            </th>
                            <th width='10%' style="text-align: center">
                                Qtde.
                            </th>
                            <th width='10%' style="text-align: right">
                                Valor
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
                        if ($produtos) {
                            foreach ($produtos as $produto) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $produto['dsc_produto']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $produto['dsc_marca']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $produto['modelo']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php echo $produto['qtd_atual']; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php echo mostraVlr($produto['vlr_venda']); ?>
                                    </td>
                                    <td width=5px style="text-align: center">
                                        <div data-toggle="tooltip" title="Editar">
                                            <span class="btn btn-sm btn-primary" Onclick="window.location = 'editar?id=<?php echo $produto['idproduto']; ?>'">
                                                <span class=" fas fa-edit"></span></span>
                                        </div>
                                    </td>
                                    <?php if ($produto['ativo'] == 1) { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Desativar">
                                                <span class="btn btn-sm btn-danger" Onclick="window.location = 'desativar?id=<?php echo $produto['idproduto']; ?>&nome=<?php echo $produto['dsc_produto']; ?>'">
                                                    <span class=" fas fa-ban"></span></span>
                                            </div>
                                        </td>
                                    <?php } else { ?>
                                        <td width=5px style="text-align: center">
                                            <div data-toggle="tooltip" title="Reativar">
                                                <span class="btn btn-sm btn-warning" Onclick="window.location = 'reativar?id=<?php echo $produto['idproduto']; ?>&nome=<?php echo $produto['dsc_produto']; ?>'">
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