<script>
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
        <label class="titulos"><?php echo isset($adiantamento) ? 'Alteração de adiantamento' : 'Cadastro de adiantamentos'; ?></label>
    </div>
    <form id="formAdiantamentos" method="post" class="form-horizontal" action="<?php echo isset($adiantamento[0]['idadiantamento']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($adiantamento[0]['idadiantamento']) ? $adiantamento[0]['idadiantamento'] : null; ?>">
        <input type="hidden" id="nparcela" name="nparcela" value="<?= isset($adiantamento[0]['nparcela']) ? $adiantamento[0]['nparcela'] : null; ?>">

        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados do Adiantamento&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Tipo:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-5">
                        <select class="selectpicker form-control" autofocus name="funcionario" id="funcionario" required>
                            <option value="<?php echo isset($adiantamento[0]['idfuncionario']) ? $adiantamento[0]['idfuncionario'] . ';' . $adiantamento[0]['nome_funcionario'] : null; ?>"><?php echo isset($adiantamento[0]['idfuncionario']) ? $adiantamento[0]['nome_funcionario'] : null; ?></option>
                            <?php
                            if ($funcionarios) {
                                foreach ($funcionarios as $funcionario) {
                            ?>
                                    <option value="<?php echo $funcionario['idfuncionario'] . ';' . $funcionario['nome_funcionario']; ?>"><?php echo $funcionario['nome_funcionario']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1" style="text-align: right;">Data:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="data_adt" id="data_adt" type="text" value="<?php echo isset($adiantamento[0]['data_adt']) ? dataBR($adiantamento[0]['data_adt']) : null; ?>" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Parcelas:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="parcelas" id="parcelas" type="text" value="<?php echo isset($adiantamento[0]['parcelas']) ? $adiantamento[0]['parcelas'] : null; ?>" class="form-control" placeholder="Nº Parcelas" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Situação:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <select class="selectpicker form-control" name="situacao" id="situacao" required>
                            <option value="<?php echo isset($adiantamento[0]['situacao']) ? $adiantamento[0]['situacao'] : null; ?>"><?php echo isset($adiantamento[0]['situacao']) ? $adiantamento[0]['situacao'] : null; ?></option>
                            <option value="Em aberto">Em aberto</option>
                            <option value="Fechada">Fechada</option>
                        </select>
                    </div>
                    <label class="col-md-1" style="text-align: right;">Data Pag.:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="data_pag" id="data_pag" type="text" autofocus value="<?php echo isset($adiantamento[0]['data_pag']) ? dataBR($adiantamento[0]['data_pag']) : null; ?>" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data Pag." />
                    </div>
                    <label class="col-md-1" style="text-align: right">Valor:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="valor" id="valor" style="text-align: right" type="text" value="<?php echo isset($adiantamento[0]['valor']) ? mostraVlr($adiantamento[0]['valor']) : null; ?>" onkeypress="mascara(this, mvalor);" maxlength="14" class="form-control" placeholder="Valor" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'adiantamentos'" class="btn btn-danger">Cancelar</a>
        </div>
        <br><br><br><br>
    </form>
</div>