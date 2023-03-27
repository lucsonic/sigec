<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos">Descrição detalhada do Fornecedor</label>
    </div>
    <div class="panel panel-default">
        <div class="padrao_titulo">
            Dados do Fornecedor
        </div>
        <div class="panel-body">
            <table style="border: none;">
                <tr>
                    <td style="font-weight: bold; text-align: right;">Nome Fantasia:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['nomefantasia']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Razão Social:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['razaosocial']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Endereço:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['endereco'] . ', ' . $fornecedor[0]['bairro'] . ' - ' . $fornecedor[0]['cidade'] . '/' . $fornecedor[0]['uf']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CNPJ:</td>
                    <td style="padding-left: 5px;"><?= mskCNPJ($fornecedor[0]['cnpj']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CEP:</td>
                    <td style="padding-left: 5px;"><?= isset($fornecedor[0]['cep']) ? mskCEP($fornecedor[0]['cep']) : 'Não informado'; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Razão Social:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['razaosocial']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Contato:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['nomecontato']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Email:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['email']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Site:</td>
                    <td style="padding-left: 5px;"><?= $fornecedor[0]['site']; ?>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Data Cadastro:</td>
                    <td style="padding-left: 5px;"><?= dataBR($fornecedor[0]['datacadastro']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Situação:</td>
                    <td style="padding-left: 5px;">
                        <?= ($fornecedor[0]['ativo'] == 0) ? '<span style="color: red;">' . 'Desativado' . '</span>' : '<span style="color: green;">' . 'Ativado' . '</span>' ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <a href="#" OnClick="window.location = 'fornecedores'" class="btn btn-warning">&nbsp;&nbsp;Voltar</a>
    </div>
</div>