<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Market System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/template.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/register.css">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="topBar">
			<div class="topBarLeft">
				<h1>Market</h1>
			</div>
			<div class="topBarRight">
				<p>Olá <?php echo $viewData['user_name']; ?></p>
			</div>
		</div>
		<div class="menuBar">
			<div class="menuItens">
				<ul>
					<a href="<?php echo BASE_URL; ?>register"><li>Cadastro</li></a>
					<a href="<?php echo BASE_URL; ?>vendas"><li>Vendas</li></a>
					<a href="<?php echo BASE_URL; ?>login/logout"><li>Sair</li></a>
				</ul>
			</div>
		</div>
		<div class="data">
			<?php
			$this->loadViewInTemplate($viewName, $viewData);
			?>
		</div>
	</body>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>