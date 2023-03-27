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
        <label class="titulos"><?php echo isset($produto) ? 'Alteração de produto' : 'Cadastro de produtos'; ?></label>
    </div>
    <form id="formMarca" method="post" class="form-horizontal" action="<?php echo isset($produto[0]['idproduto']) ? "atualizar" : "salvar"; ?>">
        <input type="hidden" id="id" name="id" value="<?= isset($produto[0]['idproduto']) ? $produto[0]['idproduto'] : null; ?>">
        <div class="panel panel-default">
            <div class="padrao_titulo">
                Dados do Produto&nbsp;&nbsp;&nbsp;
                <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Descrição:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-6">
                        <input name="descricao" id="descricao" autofocus style="text-transform: uppercase" type="text" value="<?php echo isset($produto[0]['dsc_produto']) ? $produto[0]['dsc_produto'] : null; ?>" class="form-control" placeholder="Descrição do produto" required />
                    </div>
                    <label class="col-md-1" style="text-align: right">Marca:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-4">
                        <select class="selectpicker form-control" name="marca" id="marca" required>
                            <option value="<?php echo isset($produto[0]['idmarca']) ? $produto[0]['idmarca'] : null; ?>"><?php echo isset($produto[0]['idmarca']) ? $produto[0]['dsc_marca'] : null; ?></option>
                            <?php
                            if ($marcas) {
                                foreach ($marcas as $marca) {
                            ?>
                                    <option value="<?php echo $marca['idmarca']; ?>"><?php echo $marca['descricao']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right;">Modelo:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-3">
                        <input name="modelo" id="modelo" type="text" value="<?php echo isset($produto[0]['modelo']) ? $produto[0]['modelo'] : null; ?>" class="form-control" placeholder="Modelo" required />
                    </div>
                    <label class="col-md-2" style="text-align: right; padding-top: 5px; color:darkblue;">Quantidades&nbsp;<i class="fas fa-arrow-right"></i></label>
                    <label class="col-md-1" style="text-align: right;">Atual:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-1">
                        <input name="qtd_atual" id="qtd_atual" type="text" value="<?php echo isset($produto[0]['qtd_atual']) ? $produto[0]['qtd_atual'] : null; ?>" class="form-control" placeholder="Qtd. Atual" required />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Mínima:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-1">
                        <input name="qtd_minima" id="qtd_minima" type="text" value="<?php echo isset($produto[0]['qtd_minima']) ? $produto[0]['qtd_minima'] : null; ?>" class="form-control" placeholder="Qtd. Mínima" required />
                    </div>
                    <label class="col-md-1" style="text-align: right;">Crítica:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-1">
                        <input name="qtd_critica" id="qtd_critica" type="text" value="<?php echo isset($produto[0]['qtd_critica']) ? $produto[0]['qtd_critica'] : null; ?>" class="form-control" placeholder="Qtd. Crítica" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Fornecedor:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-6">
                        <select class="selectpicker form-control" name="fornecedor" id="fornecedor" required>
                            <option value="<?php echo isset($produto[0]['idfornecedor']) ? $produto[0]['idfornecedor'] : null; ?>"><?php echo isset($produto[0]['idfornecedor']) ? $produto[0]['nomefantasia'] : null; ?></option>
                            <?php
                            if ($fornecedores) {
                                foreach ($fornecedores as $fornecedor) {
                            ?>
                                    <option value="<?php echo $fornecedor['idfornecedor']; ?>"><?php echo $fornecedor['nomefantasia']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-2" style="text-align: right;">Código de Barras:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-3">
                        <input name="cbarras" id="cbarras" type="text" maxlength="13" value="<?php echo isset($produto[0]['cbarras']) ? $produto[0]['cbarras'] : null; ?>" class="form-control" placeholder="Código de barras" required />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-1" style="text-align: right">Grupo:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-4">
                        <select class="selectpicker form-control" name="grupo" id="grupo" required>
                            <option value="<?php echo isset($produto[0]['idgrupo']) ? $produto[0]['idgrupo'] : null; ?>"><?php echo isset($produto[0]['idgrupo']) ? $produto[0]['dsc_grupo'] : null; ?></option>
                            <?php
                            if ($grupos) {
                                foreach ($grupos as $grupo) {
                            ?>
                                    <option value="<?php echo $grupo['idgrupo']; ?>"><?php echo $grupo['descricao']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <label class="col-md-1" style="text-align: right; padding-top: 5px; color:darkblue;">Valores&nbsp;<i class="fas fa-arrow-right"></i></label>
                    <label class="col-md-1" style="text-align: right">Compra:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="vlr_compra" id="vlr_compra" style="text-align: right" type="text" value="<?php echo isset($produto[0]['vlr_compra']) ? mostraVlr($produto[0]['vlr_compra']) : null; ?>" onkeypress="mascara(this, mvalor);" maxlength="14" class="form-control" placeholder="Valor compra" required />
                    </div>
                    <label class="col-md-1" style="text-align: right">Venda:&nbsp;<font color="red">*</font></label>
                    <div class="col-md-2">
                        <input name="vlr_venda" id="vlr_venda" style="text-align: right" type="text" value="<?php echo isset($produto[0]['vlr_venda']) ? mostraVlr($produto[0]['vlr_venda']) : null; ?>" onkeypress="mascara(this, mvalor);" maxlength="14" class="form-control" placeholder="Valor venda" required />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'produtos'" class="btn btn-danger">Cancelar</a>
        </div>
        <br><br><br><br>
    </form>
</div>