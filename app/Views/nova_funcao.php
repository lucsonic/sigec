<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($funcao) ? 'Alteração de marca' : 'Cadastro de marcas'; ?></label>
    </div>
    <form id="formMarca" method="post" class="form-horizontal" action="<?php echo isset($funcao[0]['idfuncao']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($funcao[0]['idfuncao']) ? $funcao[0]['idfuncao'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados da Função&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-2" style="text-align: right;">Descrição da Função:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-10">
                        <input name="nomefuncao" id="nomefuncao" type="text" value="<?php echo isset($funcao[0]['nomefuncao']) ? $funcao[0]['nomefuncao'] : null; ?>" class="form-control" placeholder="Descrição da função" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'funcoes'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>