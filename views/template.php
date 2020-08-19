<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Market System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/template.css">
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
					<a href="<?php echo BASE_URL; ?>cadastro"><li>Cadastro</li></a>
					<a href="<?php echo BASE_URL; ?>vendas"><li>Vendas</li></a>
					<a href="<?php echo BASE_URL; ?>login/logout"><li>Sair</li></a>
				</ul>
			</div>
		</div>
		<!-- <?php
		$this->loadViewInTemplate($viewName, $viewData);
		?> -->
	</body>
</html>