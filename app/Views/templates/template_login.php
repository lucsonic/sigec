<!DOCTYPE html>
<html lang="pt-br">

<style>
	.toast {
		opacity: 1 !important;
	}
</style>

<head>
	<meta charset="UTF-8">
	<title>SIGEC - Sistema de Gestão Comercial</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
	<link href="<?= base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/AdminLTE_300/plugins/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css" />
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
	<script src="<?= base_url(); ?>/assets/fontawesome/js/all.js"></script>
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
</script>

<body>
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
		?>
		<?php echo $contents; ?>
	</div>
</body>

</html>