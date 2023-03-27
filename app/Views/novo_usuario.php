<div class='container-fluid' style="padding-top: 0px;">
    <div class="barra" style="margin-bottom: 5px;">
        <label class="titulos"><?php echo isset($usuario) ? 'Alteração de usuário' : 'Cadastro de usuários'; ?></label>
    </div>
    <form id="formUsuario" method="post" class="form-horizontal" action="<?php echo isset($usuario[0]['id']) ? "atualizar" : "salvar"; ?>">
        <div>
            <input type="hidden" id="id" name="id" value="<?= isset($usuario[0]['id']) ? $usuario[0]['id'] : null; ?>">
            <div class="panel panel-default">
                <div class="padrao_titulo">
                    Dados do Usuário&nbsp;&nbsp;&nbsp;
                    <span style="color:#FF0000; font-size:11px;">(Os campos que possuem (*) são de preenchimento obrigatório.)</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-1" style="text-align: right">Nome</label>&nbsp;<font color="red">*</font>
                        <div class="col-md-4">
                            <input name="nome" id="nome" value="<?php
                                                                echo isset($usuario[0]['nome']) ? $usuario[0]['nome'] : null;
                                                                ?>" type="text" class="form-control" placeholder="Nome" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1" style="text-align: right">E-mail</label>&nbsp;<font color="red">*</font>
                        <div class="col-md-4">
                            <input name="email" id="email" value="<?php
                                                                    echo isset($usuario[0]['email']) ? $usuario[0]['email'] : null;
                                                                    ?>" type="text" class="form-control" placeholder="E-mail" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1" style="text-align: right">Usuário</label>&nbsp;<font color="red">*</font>
                        <div class="col-md-3">
                            <input name="usuario" id="usuario" value="<?php
                                                                        echo isset($usuario[0]['usuario']) ? $usuario[0]['usuario'] : null;
                                                                        ?>" type="text" class="form-control" placeholder="Usuário" required />
                        </div>
                    </div>
                    <?php if (!isset($usuario)) { ?>
                        <div class="form-group">
                            <label class="col-md-1" style="text-align: right">Senha</label>&nbsp;<font color="red">*</font>
                            <span style="background-color: #ffff00; padding: 5px; font-style: italic;">
                                <i class="fas fa-info-circle"></i>
                                &nbsp;A senha deve ter no mínimo 6 caracteres, sendo pelo menos uma maiúscula e também conter número(s).
                            </span>
                            <div class="col-md-3">
                                <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha" required />
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label class="col-md-1" style="text-align: right">Status</label>&nbsp;<font color="red">*</font>
                        <div class="col-md-2">
                            <select class="selectpicker form-control" name="status" id="status">
                                <option value="<?php
                                                echo isset($usuario[0]['status']) ? $usuario[0]['status'] : null;
                                                ?>"><?php
                                                    if (isset($usuario)) {
                                                        if ($usuario[0]['status'] == '1') {
                                                            echo 'Ativo';
                                                        } elseif ($usuario[0]['status'] == '0') {
                                                            echo 'Inativo';
                                                        } else {
                                                            null;
                                                        }
                                                    }
                                                    ?></option>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input type="submit" name="enviar" class="btn btn-success" value="Salvar" />
            <a href="#" OnClick="window.location = 'usuarios'" class="btn btn-danger">Cancelar</a>
        </div>
        <br>
        <br><br><br>
    </form>
</div>