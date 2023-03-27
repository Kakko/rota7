<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento - Rota 7</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/utils.css">

    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/template.js"></script>
</head>
<body>
    <div class="totalArea">
        <div class="container">
            <div class="topArea">
                <div class="brandArea">
                    <h2>Rota 7</h2>
                </div>
                <div class="topInfo"></div>
            </div>
            <div class="sysArea">
                <div class="leftMenu">
                    <div class="itemMenu">
                        <img src="<?php echo BASE_URL; ?>assets/icons/home_icon.png">
                        <span>Home</span>
                    </div>
                    <!-- PDV -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="pdv">
                        <img src="<?php echo BASE_URL; ?>assets/icons/pdv_icon.png">
                        <span>Vendas</span>
                    </div>
                    <div class="dropdownArea" id="pdv_drop">
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>pdv/search_sale" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                                <span class="drop_span">Buscar Clientes</span>
                            </a>
                        </div>
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>pdv/new_sale" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                                <span class="drop_span">Nova Venda</span>
                            </a>
                        </div>
                    </div>
                    <!-- CLIENTES -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="client">
                        <img src="<?php echo BASE_URL; ?>assets/icons/users_icon.png">
                        <span>Clientes</span>
                    </div>
                    <div class="dropdownArea" id="client_drop">
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>clients/search_clients" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                                <span class="drop_span">Buscar Clientes</span>
                            </a>
                        </div>
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>clients/add_clients" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                                <span class="drop_span">Adicionar Clientes</span>
                            </a>
                        </div>
                    </div>
                    <!-- FORNECEDORES -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="supplier">
                        <img src="<?php echo BASE_URL; ?>assets/icons/supplier_icon.png">
                        <span>Fornecedores</span>
                    </div>
                    <div class="dropdownArea" id="supplier_drop">
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>suppliers/search_suppliers" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                                <span class="drop_span">Buscar Fornecedor</span>
                            </a>
                        </div>
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>suppliers/add_supplier" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                                <span class="drop_span">Adicionar Fornecedor</span>
                            </a>
                        </div>
                    </div>
                    <!-- MARCAS -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="brands">
                        <img src="<?php echo BASE_URL; ?>assets/icons/brands_icon.png">
                        <span>Marcas</span>
                    </div>
                    <div class="dropdownArea" id="brands_drop">
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>brands/search_brands" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                                <span class="drop_span">Buscar Marca</span>
                            </a>
                        </div>
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>brands/add_brand" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                                <span class="drop_span">Adicionar Marca</span>
                            </a>
                        </div>
                    </div>
                    <!-- PRODUTOS -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="product">
                        <img src="<?php echo BASE_URL; ?>assets/icons/product_icon.png">
                        <span>Produtos</span>
                    </div>
                    <div class="dropdownArea" id="product_drop">
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>products/search_products" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                                <span class="drop_span">Buscar Produtos</span>
                            </a>
                        </div>
                        <div class="drop_item">
                            <a href="<?php echo BASE_URL; ?>products/add_products" style="text-decoration: none">
                                <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                                <span class="drop_span">Adicionar Produtos</span>
                            </a>
                        </div>
                    </div>
                    <!-- SERVIÇOS -->
                    <div class="itemMenu" onclick="showDropDown(this)" id="services">
                        <img src="<?php echo BASE_URL; ?>assets/icons/services_icon.png">
                        <span>Serviços</span>
                    </div>
                    <div class="dropdownArea" id="services_drop">
                        <div class="drop_item">
                            <img src="<?php echo BASE_URL; ?>assets/icons/magnifier_icon.png">
                            <span class="drop_span">Buscar Serviços</span>
                        </div>
                        <div class="drop_item">
                            <img src="<?php echo BASE_URL; ?>assets/icons/add_icon.png">
                            <span class="drop_span">Adicionar Serviços</span>
                        </div>
                    </div>
                </div>
                <div class="contentArea">
                <?php
                    $this->loadViewInTemplate($viewName, $viewData);
                ?>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>
