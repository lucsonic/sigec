<?php $url = explode('/', $_SERVER['REQUEST_URI']); ?>
<style>
	#centro {
		position: absolute;
		top: 50%;
		left: 50%;
		margin-right: -50%;
		transform: translate(-50%, -50%);
		width: 100%;
	}

	#divHeading {
		color: white;
		background-color: #0A438F;
		text-align: center;
	}

	h3 {
		margin-top: 0px;
		color: yellow;
	}

	h1 {
		color: yellow;
		font-weight: bold;
	}
</style>

<script language="Javascript">
	function capLock(e) {
		kc = e.keyCode ? e.keyCode : e.which;
		sk = e.shiftKey ? e.shiftKey : ((kc == 16) ? true : false);
		if (((kc >= 65 && kc <= 90) && !sk) || ((kc >= 97 && kc <= 122) && sk))
			document.getElementById('divCaps').style.visibility = 'visible';
		else
			document.getElementById('divCaps').style.visibility = 'hidden';
	}
</script>

<body>
	<div id="centro" class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div id="divHeading" class="panel-heading">
						<h3 class="panel-title">
							<span class="glyphicon glyphicon-user"></span>
							&nbsp;Autenticação do Usuário
						</h3>
					</div>
					<div id="divSiged" class="text-center" style="padding-bottom: 15px;">
						<h1>S I G E C</h1>
						<h3>Sistema de Gestão Comercial</h3>
					</div>
					<div class="panel-body">
						<?php
						$metodo = '/sigec/Login/autentica';
						?>
						<form accept-charset="UTF-8" role="form" method="post" action="<?= $metodo; ?>">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Usuário" name="usuario" id="usuario" type="text">
								</div>
								<div class="form-group">
									<input class="form-control" onkeypress="capLock(event)" placeholder="Senha" name="senha" id="senha" type="password">
								</div>
								<div class="form-group" id="divCaps" style="visibility:hidden; color: red; font-size: 13px;">Atenção! Caps Lock "Ligado".</div>
								<input class="btn btn-lg btn-primary btn-block" type="submit" value="L o g i n">
							</fieldset>
						</form>
					</div>
					<div class="panel-footer text-center" style="background-color: #0a438f; font-size: 13px; color: white;">&copy; Corporation - <?= date('Y'); ?></div>
				</div>
			</div>
		</div>
	</div>
</body>