<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos">Impressão de Folha de Ponto</label>
    </div>
    <form id="formHistorico" method="post" class="form-horizontal" action="ponto">
        <input type="hidden" id="id" name="id" value="<?= $_GET['id']; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Folha de Ponto&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <span class="col-md-12" style="text-align: left; color: green; font-weight: bold; padding-bottom: 10px;"><?= $_GET['nome']; ?></span>
                </div>
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Mês:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <select class="selectpicker form-control" name="editMes" id="editMes" required>
                            <option value=""></option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <label class="col-md-1" style="text-align: right;">Ano:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="ano" id="ano" type="text" class="form-control" placeholder="Ano" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Gerar Folha" />
            <a href="#" OnClick="window.location = 'funcionarios'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>