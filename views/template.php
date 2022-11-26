<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Rota 7 - Gerenciamento</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/products.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/sales.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/suppliers.css">

		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="<?php BASE_URL; ?>assets/js/template.js"></script>
		<script src="<?php BASE_URL; ?>assets/js/utils.js"></script>
	</head>
	<body>
		<div class="topBar">
			<div class="topBarLeft">
				<h1>Rota 7</h1>
			</div>
			<div class="topBarRight">
				<p>Olá <?php echo $viewData['user_name']; ?></p>
			</div>
		</div>
		<div class="menuBar">
			<div class="menuItens">
				<ul>
					<a href="<?php echo BASE_URL; ?>sales"><li>Vendas</li></a>
					<li onclick="showAddArea()">Cadastros <img src="<?php BASE_URL; ?>assets/icons/down-arrow.png" style="width: 15px; margin-left: 35px"></li>
					<div id="addArea" style="padding-left: 30px">
						<a href="<?php echo BASE_URL; ?>products"><li>Produtos</li></a>
						<a href="<?php echo BASE_URL; ?>suppliers"><li>Fornecedores</li></a>
						<a href="<?php echo BASE_URL; ?>brands"><li>Marcas</li></a>
						<a href="<?php echo BASE_URL; ?>categories"><li>Categorias</li></a>
						<a href="<?php echo BASE_URL; ?>clients"><li>Clientes</li></a>
					</div>
					<a href="<?php echo BASE_URL; ?>services"><li>Serviços</li></a>
					<a href="<?php echo BASE_URL; ?>configs"><li>Configurações</li></a>
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
	<!-- <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
</html>