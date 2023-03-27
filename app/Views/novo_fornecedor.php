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
</script>
<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($fornecedores) ? 'Alteração de fornecedor' : 'Cadastro de fornecedores'; ?></label>
    </div>
    <form id="formFfornecedor" method="post" class="form-horizontal" action="<?php echo isset($fornecedor[0]['idfornecedor']) ? "atualizar" : "salvar"; ?>">
        <div>
            <input type="hidden" id="id" name="id" value="<?= isset($fornecedor[0]['idfornecedor']) ? $fornecedor[0]['idfornecedor'] : null; ?>">
            <div class="panel panel-default">
                <div class="padrao_titulo">
                    Dados do Fornecedor&nbsp;&nbsp;&nbsp;
                    <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-1" style="text-align: right;">Fantasia:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-5">
                            <input name="nomefantasia" id="nomefantasia" type="text" value="<?php echo isset($fornecedor[0]['nomefantasia']) ? $fornecedor[0]['nomefantasia'] : null; ?>" style="text-transform: uppercase" class="form-control" placeholder="Nome fantasia" required />
                        </div>
                        <label class="col-md-1" style="text-align: right;">Razão:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-5">
                            <input name="razaosocial" id="razaosocial" type="text" value="<?php echo isset($fornecedor[0]['razaosocial']) ? $fornecedor[0]['razaosocial'] : null; ?>" class="form-control" placeholder="Razão Social" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right;">CNPJ:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-3">
                            <input name="cnpj" id="cnpj" type="text" value="<?php echo isset($fornecedor[0]['cnpj']) ? mskCNPJ($fornecedor[0]['cnpj']) : null; ?>" class="form-control" onBlur="ValidarCNPJ(formNovoCliente.cnpj);" maxlength="18" placeholder="CNPJ" onkeypress="mascara(this, cnpj_mask);" />
                        </div>
                        <label class="col-md-2" style="text-align: right;">Nome para contato:</label>
                        <div class="col-md-6">
                            <input name="ncontato" id="ncontato" type="text" value="<?php echo isset($fornecedor[0]['nomecontato']) ? $fornecedor[0]['nomecontato'] : null; ?>" class="form-control" placeholder="Nome para contato" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Endereço:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-5">
                            <input name="endereco" id="endereco" value="<?php echo isset($fornecedor[0]['endereco']) ? $fornecedor[0]['endereco'] : null; ?>" type="text" class="form-control" placeholder="Endereço" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Bairro:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="bairro" id="bairro" value="<?php echo isset($fornecedor[0]['bairro']) ? $fornecedor[0]['bairro'] : null; ?>" type="text" class="form-control" placeholder="Bairro" required />
                        </div>

                        <label class="col-md-1" style="text-align: right">Cidade:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-2">
                            <input name="cidade" id="cidade" value="<?php echo isset($fornecedor[0]['cidade']) ? $fornecedor[0]['cidade'] : null; ?>" type="text" class="form-control" placeholder="Cidade" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Estado:</label>
                        <div class="col-md-1">
                            <select class="selectpicker form-control" name="uf" id="uf">
                                <option value="<?php echo isset($fornecedor[0]['uf']) ? $fornecedor[0]['uf'] : null; ?>"><?php echo isset($fornecedor[0]['uf']) ? $fornecedor[0]['uf'] : null; ?></option>
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
                            <input name="telefones" id="telefones" value="<?php echo isset($fornecedor[0]['telefones']) ? $fornecedor[0]['telefones'] : null; ?>" type="text" class="form-control" placeholder="Telefones" required />
                        </div>

                        <label class="col-md-1" style="text-align: right;">CEP:</label>
                        <div class="col-md-2">
                            <input name="cep" id="cep" OnKeyPress="formatar(this, '#####-###')" maxlength="9" value="<?php echo isset($fornecedor[0]['cep']) ? mskCEP($fornecedor[0]['cep']) : null; ?>" maxlength="9" type="text" class="form-control" placeholder="CEP" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right">Email:</label>
                        <div class="col-md-6">
                            <input name="email" id="email" value="<?php echo isset($fornecedor[0]['email']) ? $fornecedor[0]['email'] : null; ?>" type="text" class="form-control" placeholder="Email" />
                        </div>
                        <label class="col-md-1" style="text-align: right">Site:</label>
                        <div class="col-md-4">
                            <input name="site" id="site" value="<?php echo isset($fornecedor[0]['site']) ? $fornecedor[0]['site'] : null; ?>" type="text" class="form-control" placeholder="Site" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-md-1" style="text-align: right;">Observação:&nbsp;<font color="red">*</font></label>
                        <div class="col-md-11">
                            <input name="observacao" id="observacao" value="<?php echo isset($fornecedor[0]['observacao']) ? $fornecedor[0]['observacao'] : null; ?>" type="text" class="form-control" placeholder="Observação" required />
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