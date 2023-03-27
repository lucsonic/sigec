<script language='JavaScript'>
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
        <label class="titulos">Histórico de Ações</label>
    </div>
    <form id="formHistorico" method="post" class="form-horizontal" action="buscaLogs">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Preencha as datas&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Inicial:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="dtini" id="dtini" type="text" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data inicial" required />
                    </div>
                    <label class="col-md-1" style="text-align: right">Final:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="dtfim" id="dtfim" type="text" OnKeyPress="formatar(this, '##/##/####')" maxlength="10" class="form-control" placeholder="Data final" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Buscar" />
            <a href="#" OnClick="window.location = '<?= base_url(); ?>/Home/submenu?op=relatorios'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>