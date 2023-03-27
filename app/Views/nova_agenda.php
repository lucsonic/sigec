<script>
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
        <label class="titulos"><?php echo isset($agenda) ? 'Alteração de marca' : 'Cadastro de marcas'; ?></label>
    </div>
    <form id="formMarca" method="post" class="form-horizontal" action="<?php echo isset($agenda[0]['idagenda']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($agenda[0]['idagenda']) ? $agenda[0]['idagenda'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Marca&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Data:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="data_comp" id="data_comp" type="text" value="<?php echo isset($agenda[0]['data_comp']) ? dataBR($agenda[0]['data_comp']) : null; ?>" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Descrição:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-8">
                        <input name="compromisso" id="compromisso" type="text" value="<?php echo isset($agenda[0]['compromisso']) ? $agenda[0]['compromisso'] : null; ?>" class="form-control" placeholder="Descrição do agendamento" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Horário:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="horario" id="horario" type="text" value="<?php echo isset($agenda[0]['horario']) ? $agenda[0]['horario'] : null; ?>" OnKeyPress="formatar(this, '##:##')" maxlength="5" class="form-control" placeholder="Horário" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Local:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-8">
                        <input name="local" id="local" type="text" value="<?php echo isset($agenda[0]['local']) ? $agenda[0]['local'] : null; ?>" class="form-control" placeholder="Local" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Contato:</label>
                    <div class="col-md-3">
                        <input name="nome_contato" id="nome_contato" type="text" value="<?php echo isset($agenda[0]['nome_contato']) ? $agenda[0]['nome_contato'] : null; ?>" class="form-control" placeholder="Nome para contato" />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Telefones:</label>
                    <div class="col-md-4">
                        <input name="telefones" id="telefones" type="text" value="<?php echo isset($agenda[0]['telefones']) ? $agenda[0]['telefones'] : null; ?>" class="form-control" placeholder="Telefones" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'agenda'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>