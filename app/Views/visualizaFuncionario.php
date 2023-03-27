<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos">Descrição detalhada do Funcionário</label>
    </div>
    <div class="panel panel-default">
        <div class="padrao_titulo">
            Dados do Funcionário
        </div>
        <div class="panel-body">
            <table style="border: none;">
                <tr>
                    <td style="font-weight: bold; text-align: right;">Nome:</td>
                    <td style="padding-left: 5px;"><?= $funcionario[0]['nome_funcionario']; ?>
                        &nbsp;(<span style="font-style: italic;">Pessoa <?= $funcionario[0]['tipopessoa']; ?></span>)
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Endereço:</td>
                    <td style="padding-left: 5px;"><?= $funcionario[0]['endereco'] . ', ' . $funcionario[0]['bairro'] . ' - ' . $funcionario[0]['cidade'] . '/' . $funcionario[0]['uf']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CPF/CNPJ:</td>
                    <td style="padding-left: 5px;"><?= isset($funcionario[0]['cpf']) ? mskCPF($funcionario[0]['cpf']) : mskCNPJ($funcionario[0]['cnpj']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">CEP:</td>
                    <td style="padding-left: 5px;"><?= isset($funcionario[0]['cep']) ? mskCEP($funcionario[0]['cep']) : 'Não informado'; ?></td>
                </tr>
                <?php if ($funcionario[0]['tipopessoa'] == 'Física') { ?>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Sexo:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['sexo']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">RG:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['rg'] . ' - ' . $funcionario[0]['orgaorg']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Data Nascimento:</td>
                        <td style="padding-left: 5px;"><?= dataBR($funcionario[0]['datanascimento']); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Estado Civil:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['estadocivil']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Setor</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['nomesetor']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Função:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['nomefuncao']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Formação:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['formacao']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Telefones:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['telefones']; ?></td>
                    </tr>
                <?php } ?>
                <?php if ($funcionario[0]['tipopessoa'] == 'Jurídica') { ?>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Razão Social:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['razaosocial']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-align: right;">Contato:</td>
                        <td style="padding-left: 5px;"><?= $funcionario[0]['nomecontato']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Email:</td>
                    <td style="padding-left: 5px;"><?= $funcionario[0]['email']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Data Cadastro:</td>
                    <td style="padding-left: 5px;"><?= dataBR($funcionario[0]['datacadastro']); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;">Situação:</td>
                    <td style="padding-left: 5px;">
                        <?= ($funcionario[0]['ativo'] == 0) ? '<span style="color: red;">' . 'Desativado' . '</span>' : '<span style="color: green;">' . 'Ativado' . '</span>' ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <a href="#" OnClick="window.location = 'funcionarios'" class="btn btn-warning">&nbsp;&nbsp;Voltar</a>
    </div>
</div>