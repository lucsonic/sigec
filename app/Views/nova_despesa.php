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
        <label class="titulos"><?php echo isset($despesa) ? 'Alteração de despesa' : 'Cadastro de despesas'; ?></label>
    </div>
    <form id="formDespesa" method="post" class="form-horizontal" action="<?php echo isset($despesa[0]['iddespesa']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($despesa[0]['iddespesa']) ? $despesa[0]['iddespesa'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Despesa&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Data:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="data_desp" id="data_desp" type="text" autofocus value="<?php echo isset($despesa[0]['data_desp']) ? dataBR($despesa[0]['data_desp']) : null; ?>" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Descrição:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-8">
                        <input name="descricao_desp" id="descricao_desp" style="text-transform: uppercase" type="text" value="<?php echo isset($despesa[0]['descricao_desp']) ? $despesa[0]['descricao_desp'] : null; ?>" class="form-control" placeholder="Descrição da despesa" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Tipo:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-3">
                        <select class="selectpicker form-control" name="tipo" id="tipo" required>
                            <option value="<?php echo isset($despesa[0]['idtipo']) ? $despesa[0]['idtipo'] : null; ?>"><?php echo isset($despesa[0]['idtipo']) ? $despesa[0]['desctipodespesa'] : null; ?></option>
                            <?php
                            if ($tipos) {
                                foreach ($tipos as $tipo) {
                            ?>
                                    <option value="<?php echo $tipo['idtipodespesa']; ?>"><?php echo $tipo['desctipodespesa']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1" style="text-align: left; padding-left: 0px;" data-toggle="tooltip" title="Inseir tipo de despesa">
                        <button type="button" class="btn btn-sm btn-primary glyphicon glyphicon-plus" data-toggle="modal" data-target="#modalTipoDesp"></button>
                    </div>
                    <label class="col-md-1" style="text-align: right">Valor:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="valor_desp" id="valor_desp" style="text-align: right" type="text" value="<?php echo isset($despesa[0]['valor_desp']) ? mostraVlr($despesa[0]['valor_desp']) : null; ?>" onkeypress="mascara(this, mvalor);" maxlength="14" class="form-control" placeholder="Valor" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'despesas'" class="btn btn-danger">Cancelar</a>
        </div>
        <br><br><br><br>
    </form>
</div>
<script>
    function validaCamposTipo() {
        var org = frmNovoTipodesp.desctipodespesa.value;

        if (org == "") {
            alert('Preencha o campo "Nome do tipo"');
            frmNovoTipodesp.desctipodespesa.focus();
            return false;
        } else {
            $('#frmNovoTipodesp').submit();
        }
    }
</script>
<div class="modal fade" id="modalTipoDesp" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class=" modal-header cortema">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #ffffff; font-weight: bold;">Adicionar Tipo de Despesa</h4>
            </div>
            <div class="modal-body">
                <form id="frmNovoTipodesp" action="novo_tiporec" name="frmNovoTiporec" method="post">
                    <input name="desctipodespesa" id="desctipodespesa" type="text" class="form-control" placeholder="Nome do tipo" autofocus required />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="return validaCamposTipo()">Salvar</button>
            </div>
        </div>
    </div>
</div>