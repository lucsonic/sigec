<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($marca) ? 'Alteração de marca' : 'Cadastro de marcas'; ?></label>
    </div>
    <form id="formMarca" method="post" class="form-horizontal" action="<?php echo isset($marca[0]['idmarca']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($marca[0]['idmarca']) ? $marca[0]['idmarca'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Marca&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-2" style="text-align: right;">Descrição da Marca:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-10">
                        <input name="descricao" id="descricao" type="text" value="<?php echo isset($marca[0]['descricao']) ? $marca[0]['descricao'] : null; ?>" class="form-control" placeholder="Descrição da marca" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'marcas'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>