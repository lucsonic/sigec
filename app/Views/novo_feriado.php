<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($feriado) ? 'Alteração de feriado' : 'Cadastro de feriados'; ?></label>
    </div>
    <form id="formFeriados" method="post" class="form-horizontal" action="<?php echo isset($feriado[0]['idferiado']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($feriado[0]['idferiado']) ? $feriado[0]['idferiado'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados do Feriado&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Dia:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="dia" id="dia" type="text" class="form-control" value="<?php echo isset($feriado[0]['dia']) ? $feriado[0]['dia'] : null; ?>" placeholder="Dia" required />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Mês:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <select class="selectpicker form-control" name="mes" id="mes" required>
                            <option value="<?php echo isset($feriado[0]['mes']) ? $feriado[0]['mes'] : null; ?>"><?php echo isset($feriado[0]['mes']) ? nomeMes($feriado[0]['mes']) : null; ?></option>
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
                        <input name="ano" id="ano" type="text" value="<?php echo isset($feriado[0]['ano']) ? $feriado[0]['ano'] : null; ?>" class="form-control" placeholder="Ano" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Descrição:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-11">
                        <input name="descricao" id="descricao" type="text" value="<?php echo isset($feriado[0]['descricao']) ? $feriado[0]['descricao'] : null; ?>" class="form-control" placeholder="Descrição" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'feriados'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>