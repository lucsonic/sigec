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
                '<input name="nome" id="nome" type="text" style="text-transform: uppercase" value="<?php echo isset($cliente[0]['nome']) ? $cliente[0]['nome'] : null; ?>" class="form-control" placeholder="Nome do cliente" required/>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right">Sexo:</label>' +
                '<div class="col-md-2">' +
                '<select class="selectpicker form-control" name="sexo" id="sexo">' +
                '<option value = "<?php echo isset($cliente[0]['sexo']) ? $cliente[0]['sexo'] : null; ?>" ><?php echo isset($cliente[0]['sexo']) ? $cliente[0]['sexo'] : null; ?> </option>' +
                '<option value = "Feminino">Feminino</option>' +
                '<option value = "Masculino">Masculino</option>' +
                '</select>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right">CPF:</label>' +
                '<div class="col-md-2">' +
                '<input name="cpf" id="cpf" type="text" class="form-control" maxlength="14" value="<?php echo isset($cliente[0]['cpf']) ? mskCPF($cliente[0]['cpf']) : null; ?>" onblur="javascript: validarCPF(this.value);" placeholder="CPF" onkeypress="mascara(this, cpf_mask);" />' +
                '</div>' +
                '</div><br>' +
                '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">RG:</label>' +
                '<div class="col-md-3">' +
                '<input name="rg" id="rg" type="text" value="<?php echo isset($cliente[0]['rg']) ? $cliente[0]['rg'] : null; ?>" class="form-control" placeholder="Identidade"/>' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Órgão Emissor:</label>' +
                '<div class="col-md-2">' +
                '<input name="orgao" id="orgao" type="text" value="<?php echo isset($cliente[0]['orgaorg']) ? $cliente[0]['orgaorg'] : null; ?>" class="form-control" placeholder="Órgao Emissor"/>' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Data Nascimento:</label>' +
                '<div class="col-md-2">' +
                '<input name="dtnasc" id="dtnasc" type="text" value="<?php echo isset($cliente[0]['datanascimento']) ? dataBR($cliente[0]['datanascimento']) : null; ?>" OnKeyPress="formatar(this, ' + "'##/##/####'" + ')" maxlength="10" class="form-control" placeholder="Data nascimento" / > ' +
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
                '<input name="nomefantasia" id="nomefantasia" type="text" value="<?php echo isset($cliente[0]['nomefantasia']) ? $cliente[0]['nomefantasia'] : null; ?>" style="text-transform: uppercase" class="form-control" placeholder="Nome fantasia" required/>' +
                '</div>' +
                '<label class="col-md-1" style="text-align: right;">Razão:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-5">' +
                '<input name="razaosocial" id="razaosocial" type="text" value="<?php echo isset($cliente[0]['razaosocial']) ? $cliente[0]['razaosocial'] : null; ?>" class="form-control" placeholder="Razão Social" required/>' +
                '</div>' +
                '</div>' +
                '<br>' +
                '<div class="row">' +
                '<label class="col-md-1" style="text-align: right;">CNPJ:&nbsp;<font color="red">*</font></label>' +
                '<div class="col-md-3">' +
                '<input name="cnpj" id="cnpj" type="text" value="<?php echo isset($cliente[0]['cnpj']) ? mskCNPJ($cliente[0]['cnpj']) : null; ?>" class="form-control" onBlur="ValidarCNPJ(formNovoCliente.cnpj);" maxlength="18" placeholder="CNPJ" onkeypress="mascara(this, cnpj_mask);" />' +
                '</div>' +
                '<label class="col-md-2" style="text-align: right;">Nome para contato:</label>' +
                '<div class="col-md-6">' +
                '<input name="ncontato" id="ncontato" type="text" value="<?php echo isset($cliente[0]['nomecontato']) ? $cliente[0]['nomecontato'] : null; ?>" class="form-control" placeholder="Nome para contato"/>' +
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
        <label class="titulos"><?php echo isset($cliente) ? 'Alteração de cliente' : 'Cadastro de clientes'; ?></label>
    </div>
    <form id="formUsuario" method="post" class="form-horizontal" action="<?php echo isset($cliente[0]['idcliente']) ? "atualizar" : "salvar"; ?>">
        <div>
            <button type="button" id="btnEdicao" name="btnEdicao" onclick="selecionaRadio();" style="visibility: hidden;"></button>
            <input type="hidden" id="tipoc" name="tipoc" value="<?= isset($cliente[0]['tipopessoa']) ? $cliente[0]['tipopessoa'] : null; ?>">
            <input type="hidden" id="id" name="id" value="<?= isset($cliente[0]['idcliente']) ? $cliente[0]['idcliente'] : null; ?>">
            <div class="panel panel-default">
                <div class="padrao_titulo">
                    Dados do Cliente&nbsp;&nbsp;&nbsp;
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
                            <input name="endereco" id="endereco" value="<?php echo isset($cliente[0]['endereco']) ? $cliente[0]['endereco'] : null; ?>" type="text" class="form-control" placeholder="Endereço" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Bairro:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="bairro" id="bairro" value="<?php echo isset($cliente[0]['bairro']) ? $cliente[0]['bairro'] : null; ?>" type="text" class="form-control" placeholder="Bairro" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Cidade:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="cidade" id="cidade" value="<?php echo isset($cliente[0]['cidade']) ? $cliente[0]['cidade'] : null; ?>" type="text" class="form-control" placeholder="Cidade" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Estado:</label>
                        <div class="col-md-1">
                            <select class="selectpicker form-control" name="uf" id="uf">
                                <option value="<?php echo isset($cliente[0]['uf']) ? $cliente[0]['uf'] : null; ?>"><?php echo isset($cliente[0]['uf']) ? $cliente[0]['uf'] : null; ?></option>
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
                            <input name="telefones" id="telefones" value="<?php echo isset($cliente[0]['telefones']) ? $cliente[0]['telefones'] : null; ?>" type="text" class="form-control" placeholder="Telefones" required />
                        </div>

                        <label class="col-md-1" style="text-align: right;">CEP:</label>
                        <div class="col-md-2">
                            <input name="cep" id="cep" OnKeyPress="formatar(this, '#####-###')" maxlength="9" value="<?php echo isset($cliente[0]['cep']) ? $cliente[0]['cep'] : null; ?>" maxlength="9" type="text" class="form-control" placeholder="CEP" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Email:</label>
                        <div class="col-md-7">
                            <input name="email" id="email" value="<?php echo isset($cliente[0]['email']) ? $cliente[0]['email'] : null; ?>" type="text" class="form-control" placeholder="Email" />
                        </div>

                        <label class="col-md-1" style="text-align: right">Indicação:</label>
                        <div class="col-md-3">
                            <select class="selectpicker form-control" name="indicacao" id="indicacao">
                                <option value="<?php echo isset($cliente[0]['indicacao']) ? $cliente[0]['indicacao'] : null; ?>"><?php echo isset($cliente[0]['indicacao']) ? $cliente[0]['indicacao'] : null; ?></option>
                                <option value="Amigos">Amigos</option>
                                <option value="Redes Sociais">Redes Sociais</option>
                                <option value="Propaganda em carro de som">Propaganda em carro de som</option>
                                <option value="Propaganda de Rádio">Propaganda de Rádio</option>
                                <option value="Panfleto">Panfleto</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'clientes'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>