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
        <label class="titulos"><?php echo isset($receita) ? 'Alteração de receita' : 'Cadastro de receitas'; ?></label>
    </div>
    <form id="formReceita" method="post" class="form-horizontal" action="<?php echo isset($receita[0]['idreceita']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($receita[0]['idreceita']) ? $receita[0]['idreceita'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Receita&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Data:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="data_rec" id="data_rec" type="text" autofocus value="<?php echo isset($receita[0]['data_rec']) ? dataBR($receita[0]['data_rec']) : null; ?>" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Descrição:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-8">
                        <input name="descricao_rec" id="descricao_rec" style="text-transform: uppercase" type="text" value="<?php echo isset($receita[0]['descricao_rec']) ? $receita[0]['descricao_rec'] : null; ?>" class="form-control" placeholder="Descrição da receita" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Tipo:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-3">
                        <select class="selectpicker form-control" name="tipo" id="tipo" required>
                            <option value="<?php echo isset($receita[0]['idtipo']) ? $receita[0]['idtipo'] : null; ?>"><?php echo isset($receita[0]['idtipo']) ? $receita[0]['desctiporeceita'] : null; ?></option>
                            <?php
                            if ($tipos) {
                                foreach ($tipos as $tipo) {
                            ?>
                                    <option value="<?php echo $tipo['idtiporeceita']; ?>"><?php echo $tipo['desctiporeceita']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1" style="text-align: left; padding-left: 0px;" data-toggle="tooltip" title="Inseir tipo de receita">
                        <button type="button" class="btn btn-sm btn-primary glyphicon glyphicon-plus" data-toggle="modal" data-target="#modalTipoRec"></button>
                    </div>
                    <label class="col-md-1" style="text-align: right">Valor:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="valor_rec" id="valor_rec" style="text-align: right" type="text" value="<?php echo isset($receita[0]['valor_rec']) ? mostraVlr($receita[0]['valor_rec']) : null; ?>" onkeypress="mascara(this, mvalor);" maxlength="14" class="form-control" placeholder="Valor" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'receitas'" class="btn btn-danger">Cancelar</a>
        </div>
        <br><br><br><br>
    </form>
</div>
<script>
    function validaCamposTipo() {
        var org = frmNovoTiporec.desctiporeceita.value;

        if (org == "") {
            alert('Preencha o campo "Nome do tipo"');
            frmNovoTiporec.desctiporeceita.focus();
            return false;
        } else {
            $('#frmNovoTiporec').submit();
        }
    }
</script>
<div class="modal fade" id="modalTipoRec" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class=" modal-header cortema">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #ffffff; font-weight: bold;">Adicionar Tipo de Receita</h4>
            </div>
            <div class="modal-body">
                <form id="frmNovoTiporec" action="novo_tiporec" name="frmNovoTiporec" method="post">
                    <input name="desctiporeceita" id="desctiporeceita" type="text" class="form-control" placeholder="Nome do tipo" autofocus required />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="return validaCamposTipo()">Salvar</button>
            </div>
        </div>
    </div>
</div>