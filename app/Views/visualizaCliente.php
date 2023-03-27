<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos">Descrição detalhada do Cliente</label>
    </div>
    <div class="panel panel-default">
        <div class="padrao_titulo">
            Dados do Cliente
        </div>
        <div class="panel-body">
            <table style="border: none;">
                <tr>
                    <td style="font-weight: bold; text-align: right;">Nome:</td>
                    <td style="padding-left: 5px;"><?= $cliente[0]['nome_cliente']; ?>
                        &nbsp;(<span style="font-style: italic;">Pessoa <?= $cliente[0]['tipopessoa']; ?></span>)
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Endereço:</td>
                    <td style="padding-left: 5px;"><?= $cliente[0]['endereco'] . ', ' . $cliente[0]['bairro'] . ' - ' . $cliente[0]['cidade'] . '/' . $cliente[0]['uf']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CPF/CNPJ:</td>
                    <td style="padding-left: 5px;"><?= isset($cliente[0]['cpf']) ? mskCPF($cliente[0]['cpf']) : mskCNPJ($cliente[0]['cnpj']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CEP:</td>
                    <td style="padding-left: 5px;"><?= isset($cliente[0]['cep']) ? mskCEP($cliente[0]['cep']) : 'Não informado'; ?></td>
                </tr>
                <?php if ($cliente[0]['tipopessoa'] == 'Física') { ?>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Sexo:</td>
                        <td style="padding-left: 5px;"><?= $cliente[0]['sexo']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">RG:</td>
                        <td style="padding-left: 5px;"><?= $cliente[0]['rg'] . ' - ' . $cliente[0]['orgaorg']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Data Nascimento:</td>
                        <td style="padding-left: 5px;"><?= dataBR($cliente[0]['datanascimento']); ?></td>
                    </tr>
                <?php } ?>
                <?php if ($cliente[0]['tipopessoa'] == 'Jurídica') { ?>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Razão Social:</td>
                        <td style="padding-left: 5px;"><?= $cliente[0]['razaosocial']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Contato:</td>
                        <td style="padding-left: 5px;"><?= $cliente[0]['nomecontato']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Email:</td>
                    <td style="padding-left: 5px;"><?= $cliente[0]['email']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Data Cadastro:</td>
                    <td style="padding-left: 5px;"><?= dataBR($cliente[0]['datacadastro']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Indicação:</td>
                    <td style="padding-left: 5px;"><?= $cliente[0]['indicacao']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Situação:</td>
                    <td style="padding-left: 5px;">
                        <?= ($cliente[0]['ativo'] == 0) ? '<span style="color: red;">' . 'Desativado' . '</span>' : '<span style="color: green;">' . 'Ativado' . '</span>' ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <a href="#" OnClick="window.location = 'clientes'" class="btn btn-warning">&nbsp;&nbsp;Voltar</a>
    </div>
</div>