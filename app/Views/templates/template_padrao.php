<!DOCTYPE html>
<html lang="pt-br">

<style>
	.toast {
		opacity: 1 !important;
	}

	.menu_barra:hover {
		font-weight: bold;
		color: white;
	}

	.menu_barra {
		color: #fff;
	}

	#centro {
		position: absolute;
		top: 85%;
		left: 50%;
		margin-right: -50%;
		transform: translate(-50%, -50%);
	}
</style>

<?php
$url = explode('/', $_SERVER["REQUEST_URI"]);
?>

<head>
	<meta charset="UTF-8">
	<title>SIGEC - Sistema de Gestão Comercial</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/assets/js/jquery.js"></script>
	<link href="<?= base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/assets/fontawesome/js/all.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/AdminLTE_300/plugins/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style_template_padrao.css" />
	<link href="<?= base_url(); ?>/assets/css/datepicker.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/animate.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/animate.min.css">
	<script type="text/javascript" src="<?= base_url(); ?>/assets/js/funcoes.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>/assets/js/inputmask.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>/assets/js/helpers.js"></script>
	<script src="<?= base_url(); ?>/assets/js/highcharts.js"></script>
	<script src="<?= base_url(); ?>/assets/js/modules/exporting.js"></script>
	<script src="<?= base_url(); ?>/assets/AdminLTE_300/plugins/datatables/jquery.dataTables.js"></script>
	<script src="<?= base_url(); ?>/assets/AdminLTE_300/plugins/datatables/dataTables.bootstrap4.js"></script>
	<link rel="icon" href="<?= base_url(); ?>/assets/img/favicon.ico" type="image/x-icon">
	<script src="<?= base_url(); ?>/assets/js/sweetalert2.all.min.js"></script>
	<script src="<?= base_url(); ?>/assets/js/toastr.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/toastr.min.css">
</head>

<script>
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	$(function() {
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("active");
		});
	});
</script>
<?php $session = Session(); ?>

<body>
	<div id="wrapper">
		<nav class="navbar cortema navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-brand">
						<a id="menu-toggle" href="javascript:void(0)" class="btn-menu toggle">
							<i class="fa fa-bars"></i>
						</a>
						<?php
						if ($session->get('user')) {
							echo $_SESSION['empresa']['nome'];
						}
						?>
					</div>
				</div>
				<div id="navbar" class="collapse navbar-collapse" style="float: right; padding-top: 15px;">
					<?php
					if ($session->get('user')) {
					?>
						<span style="color: yellow;"><?= $_SESSION['credenciais']["nome"]; ?></span>&nbsp;&nbsp;&nbsp;
					<?php } ?>
					<a class="menu_barra" href="<?= base_url(); ?>/Login/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Sair</a>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>
		<!-- Sidebar -->
		<div id="sidebar-wrapper" style="background-color: #4682B4; border-right: solid 5px #0A438F;">
			<nav style="color: white;">
				<ul class="sidebar-nav nav">
					<li class="sidebar-brand">
						<a href="<?= base_url(); ?>/Login/home" style="color: white;"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>/Home/submenu?op=cadastros" style="color: white;"><i class="fas fa-folder-plus"></i>&nbsp;&nbsp;Módulo de Cadastros</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>/Home/submenu?op=financeiro" style="color: white;"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Módulo Financeiro</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>/Home/submenu?op=relatorios" style="color: white;"><i class="fas fa-print"></i>&nbsp;&nbsp;Módulo de Relatórios</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>/Login/logout" style="color: white;"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Sair</a>
					</li>
				</ul>
			</nav>
			<?php if (end($url) != 'home' && end($url) != 'autentica') : ?>
				<img class="img-responsive" id="centro" src="<?php echo base_url(); ?>/assets/img/sigec.png" width="50%" alt="Imagem" />
			<?php endif ?>
		</div>
		<!-- Page content -->
		<div id="page-content-wrapper">
			<div class="page-content">
				<div class="container-fluid">
					<?php
					$session = session();
					if ($session->getFlashdata('error')) {
					?>
						<script>
							toastr["error"]("<?php echo $session->get('error'); ?>", "SIGEC");
						</script>
					<?php
					}
					if ($session->getFlashdata('success')) {
					?>
						<script>
							toastr["success"]("<?php echo $session->get('success'); ?>", "SIGEC");
						</script>
					<?php
					}
					if ($session->getFlashdata('info')) {
					?>
						<script>
							toastr["info"]("<?php echo $session->get('info'); ?>", "SIGEC");
						</script>
					<?php
					}
					if ($session->getFlashdata('warning')) {
					?>
						<script>
							toastr["warning"]("<?php echo $session->get('warning'); ?>", "SIGEC");
						</script>
					<?php
					}
					?>
					<?php echo $contents; ?>
				</div>
			</div>
		</div>
	</div>

</body>

<div class='row navbar-fixed-bottom cortema' style="bottom: 0; padding-top: 3px; padding-bottom: 3px;">
	<table width="100%" border="0" valign="middle" cellpadding="0" cellspacing="0" style='color: white;'>
		<tr>
			<td valign=middle align=center style='font-size:11pt'>
				<b><?php echo 'SIGEC - Sistema de Gestão Comercial'; ?></b>
			</td>
		</tr>
		<tr>
			<td valign=middle align=center style='font-size:8pt'>
				Desenvolvido por: lucsonic@gmail.com
			</td>
		</tr>
	</table>
</div>

</html>