<script language='JavaScript'>
    function SomenteNumero(e) {
        var tecla = (window.event) ? event.keyCode : e.which;
        if ((tecla > 47 && tecla < 58))
            return true;
        else {
            if (tecla == 8 || tecla == 0)
                return true;
            else
                return false;
        }
    }

    function validarCPF(cpf) {
        var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;

        if (!filtro.test(cpf)) {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        cpf = remove(cpf, ".");
        cpf = remove(cpf, "-");

        if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
            cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
            cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
            cpf == "88888888888" || cpf == "99999999999") {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        soma = 0;
        for (i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }

        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11) {
            resto = 0;
        }
        if (resto != parseInt(cpf.charAt(9))) {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        soma = 0;
        for (i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11) {
            resto = 0;
        }

        if (resto != parseInt(cpf.charAt(10))) {
            window.alert("CPF inválido. Tente novamente.");
            return false;
        }

        return true;
    }

    function remove(str, sub) {
        i = str.indexOf(sub);
        r = "";
        if (i == -1)
            return str; {
            r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
        }

        return r;
    }

    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function cpf_mask(v) {
        v = v.replace(/\D/g, "")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1.$2")
        v = v.replace(/(\d{3})(\d)/, "$1-$2")
        return v
    }

    function cnpj_mask(v) {
        v = v.replace(/^(\d{2})(\d)/, "$1.$2")
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
        v = v.replace(/(\d{4})(\d)/, "$1-$2")
        return v
    }

    function cnpj(v) {
        v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
        v = v.replace(/^(\d{2})(\d)/, "$1.$2"); //Coloca ponto entre o segundo e o terceiro dígitos
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3"); //Coloca ponto entre o quinto e o sexto dígitos
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2"); //Coloca uma barra entre o oitavo e o nono dígitos
        v = v.replace(/(\d{4})(\d)/, "$1-$2"); //Coloca um hífen depois do bloco de quatro dígitos
        return v;
    }

    function ValidarCNPJ(ObjCnpj) {
        var cnpj = ObjCnpj.value;
        var valida = new Array(6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
        var dig1 = new Number;
        var dig2 = new Number;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace(exp, "");
        var digito = new Number(eval(cnpj.charAt(12) + cnpj.charAt(13)));

        for (i = 0; i < valida.length; i++) {
            dig1 += (i > 0 ? (cnpj.charAt(i - 1) * valida[i]) : 0);
            dig2 += cnpj.charAt(i) * valida[i];
        }
        dig1 = (((dig1 % 11) < 2) ? 0 : (11 - (dig1 % 11)));
        dig2 = (((dig2 % 11) < 2) ? 0 : (11 - (dig2 % 11)));

        if (((dig1 * 10) + dig2) != digito)
            alert('CNPJ Invalido! Tente novamente.');

    }

    function formatar(src, mask) {
        var i = src.value.length;
        var saida = mask.substring(0, 1);
        var texto = mask.substring(i)
        if (texto.substring(0, 1) != saida) {
            src.value += texto.substring(0, 1);
        }
    }

    function exibeDadosPessoa() {
        var vMostrar = $('input:radio:checked').val();
        if (vMostrar == "Física") {
            var tipo = vMostrar;
            $('pessoa').value = tipo;

            var campos = '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">Nome:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-5">' +
                '<input name="nome" id="nome" type="text" style="text-transform: uppercase" value="<?php echo isset($funcionario[0]['nome_funcionario']) ? $funcionario[0]['nome_funcionario'] : null; ?>" class="form-control" placeholder="Nome do funcionário" required/>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right">Sexo:</label>' +
                '<div class="col-md-2">' +
                '<select class="selectpicker form-control" name="sexo" id="sexo">' +
                '<option value = "<?php echo isset($funcionario[0]['sexo']) ? $funcionario[0]['sexo'] : null; ?>" ><?php echo isset($funcionario[0]['sexo']) ? $funcionario[0]['sexo'] : null; ?> </option>' +
                '<option value = "Feminino">Feminino</option>' +
                '<option value = "Masculino">Masculino</option>' +
                '</select>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right">CPF:</label>' +
                '<div class="col-md-2">' +
                '<input name="cpf" id="cpf" type="text" class="form-control" maxlength="14" value="<?php echo isset($funcionario[0]['cpf']) ? mskCPF($funcionario[0]['cpf']) : null; ?>" onblur="javascript: validarCPF(this.value);" placeholder="CPF" onkeypress="mascara(this, cpf_mask);" />' +
                '</div>' +
                '</div><br>' +
                '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">RG:</label>' +
                '<div class="col-md-3">' +
                '<input name="rg" id="rg" type="text" value="<?php echo isset($funcionario[0]['rg']) ? $funcionario[0]['rg'] : null; ?>" class="form-control" placeholder="Identidade"/>' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Órgão Emissor:</label>' +
                '<div class="col-md-2">' +
                '<input name="orgao" id="orgao" type="text" value="<?php echo isset($funcionario[0]['orgaorg']) ? $funcionario[0]['orgaorg'] : null; ?>" class="form-control" placeholder="Órgao Emissor"/>' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Data Nascimento:</label>' +
                '<div class="col-md-2">' +
                '<input name="dtnasc" id="dtnasc" type="text" value="<?php echo isset($funcionario[0]['datanascimento']) ? dataBR($funcionario[0]['datanascimento']) : null; ?>" OnKeyPress="formatar(this, ' + "'##/##/####'" + ')" maxlength="10" class="form-control" placeholder="Data nascimento" / > ' +
                '</div>' +
                '</div><br>';

            document.getElementById('tp').innerHTML = '';
            document.getElementById('tp').innerHTML = campos;
        }
        if (vMostrar == "Jurídica") {
            var tipo = vMostrar;
            $('pessoa').value = tipo;

            var campos = '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">Fantasia:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-5">' +
                '<input name="nomefantasia" id="nomefantasia" type="text" value="<?php echo isset($funcionario[0]['nomefantasia']) ? $funcionario[0]['nomefantasia'] : null; ?>" style="text-transform: uppercase" class="form-control" placeholder="Nome fantasia" required/>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right;">Razão:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-5">' +
                '<input name="razaosocial" id="razaosocial" type="text" value="<?php echo isset($funcionario[0]['razaosocial']) ? $funcionario[0]['razaosocial'] : null; ?>" class="form-control" placeholder="Razão Social" required/>' +
                '</div>' +
                '</div>' +
                '<br>' +
                '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">CNPJ:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-3">' +
                '<input name="cnpj" id="cnpj" type="text" value="<?php echo isset($funcionario[0]['cnpj']) ? mskCNPJ($funcionario[0]['cnpj']) : null; ?>" class="form-control" onBlur="ValidarCNPJ(formNovoCliente.cnpj);" maxlength="18" placeholder="CNPJ" onkeypress="mascara(this, cnpj_mask);" />' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Nome para contato:</label>' +
                '<div class="col-md-6">' +
                '<input name="ncontato" id="ncontato" type="text" value="<?php echo isset($funcionario[0]['nomecontato']) ? $funcionario[0]['nomecontato'] : null; ?>" class="form-control" placeholder="Nome para contato"/>' +
                '</div>' +
                '</div><br>';

            document.getElementById('tp').innerHTML = '';
            document.getElementById('tp').innerHTML = campos;
        }
    }

    function selecionaRadio() {
        if (document.getElementById('tipoc').value == 'Física') {
            $("#tpessoaf").prop("checked", true);
            exibeDadosPessoa();
        } else if (document.getElementById('tipoc').value == 'Jurídica') {
            $("#tpessoaj").prop("checked", true);
            exibeDadosPessoa();
        } else {
            null;
        }
    }

    $(document).ready(function() {
        $('#btnEdicao').trigger('click');
    });
</script>
<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($funcionario) ? 'Alteração de funcionário' : 'Cadastro de funcionários'; ?></label>
    </div>
    <form id="formFuncionario" method="post" class="form-horizontal" action="<?php echo isset($funcionario[0]['idfuncionario']) ? "atualizar" : "salvar"; ?>">
        <div>
            <button type="button" id="btnEdicao" name="btnEdicao" onclick="selecionaRadio();" style="visibility: hidden;"></button>
            <input type="hidden" id="tipoc" name="tipoc" value="<?= isset($funcionario[0]['tipopessoa']) ? $funcionario[0]['tipopessoa'] : null; ?>">
            <input type="hidden" id="id" name="id" value="<?= isset($funcionario[0]['idfuncionario']) ? $funcionario[0]['idfuncionario'] : null; ?>">
            <div class="panel panel-default">
                <div class="padrao_titulo">
                    Dados do Funcionário&nbsp;&nbsp;&nbsp;
                    <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
                </div>
                <div class="col-md-12" style="background-color: #66CDAA; padding-top: 2px;">
                    <label class="col-md-1" style="text-align: left; padding-top: 2px;">Pessoa:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-3" style="color: green">
                        <label><input type="radio" onclick="exibeDadosPessoa();" value="Física" name="tpessoa" id="tpessoaf" required="">&nbsp;Física</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" onclick="exibeDadosPessoa();" value="Jurídica" name="tpessoa" id="tpessoaj" required="">&nbsp;Jurídica</label>
                    </div>
                </div>
                <br><br>
                <div class="panel-body">
                    <div id="tp">

                    </div>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Endereço:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-5">
                            <input name="endereco" id="endereco" value="<?php echo isset($funcionario[0]['endereco']) ? $funcionario[0]['endereco'] : null; ?>" type="text" class="form-control" placeholder="Endereço" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Bairro:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="bairro" id="bairro" value="<?php echo isset($funcionario[0]['bairro']) ? $funcionario[0]['bairro'] : null; ?>" type="text" class="form-control" placeholder="Bairro" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Cidade:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="cidade" id="cidade" value="<?php echo isset($funcionario[0]['cidade']) ? $funcionario[0]['cidade'] : null; ?>" type="text" class="form-control" placeholder="Cidade" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Estado:</label>
                        <div class="col-md-1">
                            <select class="selectpicker form-control" name="uf" id="uf">
                                <option value="<?php echo isset($funcionario[0]['uf']) ? $funcionario[0]['uf'] : null; ?>"><?php echo isset($funcionario[0]['uf']) ? $funcionario[0]['uf'] : null; ?></option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AM">AM</option>
                                <option value="AP">AP</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MG">MG</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="PR">PR</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SE">SE</option>
                                <option value="SP">SP</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                        <label class="col-md-1" style="text-align: right;">Telefones:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-6">
                            <input name="telefones" id="telefones" value="<?php echo isset($funcionario[0]['telefones']) ? $funcionario[0]['telefones'] : null; ?>" type="text" class="form-control" placeholder="Telefones" required />
                        </div>

                        <label class="col-md-1" style="text-align: right;">CEP:</label>
                        <div class="col-md-2">
                            <input name="cep" id="cep" OnKeyPress="formatar(this, '#####-###')" maxlength="9" value="<?php echo isset($funcionario[0]['cep']) ? $funcionario[0]['cep'] : null; ?>" maxlength="9" type="text" class="form-control" placeholder="CEP" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Setor:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-4">
                            <select class="selectpicker form-control" name="setor" id="setor" required>
                                <option value="<?php echo isset($funcionario[0]['idsetor']) ? $funcionario[0]['idsetor'] : null; ?>"><?php echo isset($funcionario[0]['idsetor']) ? $funcionario[0]['nomesetor'] : null; ?></option>
                                <?php
                                if ($setores) {
                                    foreach ($setores as $setor) {
                                ?>
                                        <option value="<?php echo $setor['idsetor']; ?>"><?php echo $setor['nomesetor']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1" style="text-align: left; padding-left: 0px;" data-toggle="tooltip" title="Inseir setor">
                            <button type="button" class="btn btn-sm btn-primary glyphicon glyphicon-plus" data-toggle="modal" data-target="#modalSetor"></button>
                        </div>
                        <label class="col-md-1" style="text-align: right">Email:</label>
                        <div class="col-md-5">
                            <input name="email" id="email" value="<?php echo isset($funcionario[0]['email']) ? $funcionario[0]['email'] : null; ?>" type="text" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">E. Civil:</label>
                        <div class="col-md-3">
                            <select class="selectpicker form-control" name="estadocivil" id="estadocivil">
                                <option value="<?php echo isset($funcionario[0]['estadocivil']) ? $funcionario[0]['estadocivil'] : null; ?>"><?php echo isset($funcionario[0]['estadocivil']) ? $funcionario[0]['estadocivil'] : null; ?></option>
                                <option value="Casado">Casado</option>
                                <option value="Solteiro">Solteiro</option>
                                <option value="Viúvo">Viúvo</option>
                                <option value="Separado judicialmente">Separado judicialmente</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        <label class="col-md-1" style="text-align: right">Formação:</label>
                        <div class="col-md-3">
                            <select class="selectpicker form-control" name="formacao" id="formacao">
                                <option value="<?php echo isset($funcionario[0]['formacao']) ? $funcionario[0]['formacao'] : null; ?>"><?php echo isset($funcionario[0]['formacao']) ? $funcionario[0]['formacao'] : null; ?></option>
                                <option value="Ensino Fundamental">Ensino Fundamental</option>
                                <option value="Ensino Médio">Ensino Médio</option>
                                <option value="Graduação">Graduação</option>
                                <option value="Pós-Graduação">Pós-Graduação</option>
                                <option value="Mestrado">Mestrado</option>
                                <option value="Doutorado">Doutorado</option>
                            </select>
                        </div>
                        <label class="col-md-1" style="text-align: right">Função:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-3">
                            <select class="selectpicker form-control" name="funcao" id="funcao" required>
                                <option value="<?php echo isset($funcionario[0]['idfuncao']) ? $funcionario[0]['idfuncao'] : null; ?>"><?php echo isset($funcionario[0]['nomefuncao']) ? $funcionario[0]['nomefuncao'] : null; ?></option>
                                <?php
                                if ($funcoes) {
                                    foreach ($funcoes as $funcao) {
                                ?>
                                        <option value="<?php echo $funcao['idfuncao']; ?>"><?php echo $funcao['nomefuncao']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right;">Entrada:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="entrada" id="entrada" type="text" value="<?php echo isset($funcionario[0]['entrada']) ? $funcionario[0]['entrada'] : null; ?>" OnKeyPress="formatar(this, '##:##')" maxlength="5" class="form-control" placeholder="Hora entrada" required />
                        </div>
                        <label class="col-md-1" style="text-align: right;">Saída:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="saida" id="saida" type="text" value="<?php echo isset($funcionario[0]['saida']) ? $funcionario[0]['saida'] : null; ?>" OnKeyPress="formatar(this, '##:##')" maxlength="5" class="form-control" placeholder="Hora saída" required />
                        </div>
                        <label class="col-md-1" style="text-align: right;">Observação:</label>
                        <div class="col-md-5">
                            <input name="observacao" id="observacao" value="<?php echo isset($funcionario[0]['observacao']) ? $funcionario[0]['observacao'] : null; ?>" type="text" class="form-control" placeholder="Observação" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'funcionarios'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>

<script>
    function validaCamposSetor() {
        var org = frmNovoSetor.nomesetor.value;

        if (org == "") {
            alert('Preencha o campo "Nome do setor"');
            frmNovoSetor.nomesetor.focus();
            return false;
        } else {
            $('#frmNovoSetor').submit();
        }
    }
</script>

<div class="modal fade" id="modalSetor" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class=" modal-header cortema">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #ffffff; font-weight: bold;">Adicionar Setor</h4>
            </div>
            <div class="modal-body">
                <form id="frmNovoSetor" action="novo_setor" name="frmNovoSetor" method="post">
                    <input name="nomesetor" id="nomesetor" type="text" class="form-control" placeholder="Nome do Setor" autofocus required />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="return validaCamposSetor()">Salvar</button>
            </div>
        </div>
    </div>
</div>