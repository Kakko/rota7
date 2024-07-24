<style>
    textarea {
        height: 150px; 
        resize: none; 
        /* margin-left: 2.5%;  */
        border: 1px solid #CCC; 
        border-radius: 5px
    }
</style>
<div class="add_area">
    <div class="titleAddArea">
        <span>Cadastro de Produtos</span>
    </div>
    <div class="infoAddArea">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Dados do Produto</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="padding: 10px">
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Código</label>
                            <input type="number" class="form-control form-control-sm" name="product_cod" id="product_code" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Fornecedor</label>
                            <div class="input-group mb-3">
                                <select class="form-control form-control-sm" name="product_supplier" id="supplier_id" onchange="verifyProduct()">
                                    <option value="">Selecione...</option>
                                    <?php foreach($suppliers as $supply): ?>
                                        <option value="<?php echo $supply['id']; ?>"><?php echo $supply['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-success btn-sm" type="button" id="button-addon2" onclick="openSupplierModal()">+</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Nome</label>
                            <input type="text" value="addProduct" name="action" hidden>
                            <input type="text" class="form-control form-control-sm" name="product_name" placeholder="Digite o nome do produto" id="product_id" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Categoria</label>
                            <div class="input-group mb-3">
                                <select class="form-control form-control-sm" name="product_category" id="product_category">
                                    <option value="">Selecione...</option>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-success btn-sm" type="button" id="button-addon2" onclick="openCatModal()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Data da compra</label>
                            <input type="date" class="form-control form-control-sm" name="buy_date">
                        </div>
                        <div class="col-sm-2">
                            <label>Marca</label>
                            <div class="input-group mb-3">
                                <select class="form-control form-control-sm" name="brand" id="product_brand">
                                    <option value="">Selecione...</option>
                                    <?php foreach($brands as $brand): ?>
                                        <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button class="btn btn-success btn-sm" type="button" id="button-addon2" onclick="openBrandModal()">+</button>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Cor</label>
                            <input type="text" class="form-control form-control-sm" name="product_color">
                        </div>
                        <div class="col-sm-2">
                            <label>Quantidade</label>
                            <input type="number" class="form-control form-control-sm" name="product_qtd" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Preço de Custo</label>
                            <input type="text" class="form-control form-control-sm money" name="product_bprice" placeholder="R$" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Preço de Venda</label>
                            <input type="text" class="form-control form-control-sm money" name="product_sprice" placeholder="R$" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Descrição</label>
                            <textarea name="obs" class="form-control form-control-sm" style="resize: none" placeholder="Digite a descrição do produto"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label style="display: block">Imagens do produto</label>
                            <input type="FILE" name="product_img[]" multiple>
                        </div>
                    </div>
                    </div>
                    <div class="submitButtonArea" style="width: 99%; height: 50px; display: flex; align-items: center; justify-content: right">
                        <input type="submit" class="btn btn-success" style="width: 200px; margin-right: 15px" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cadastrar Fornecedor-->
<div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="addBrand" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Fornecedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm">
                    <label>Nome: </label>
                    <input type="text" name="action" value="register" hidden>
                    <input type="text" class="form-control form-control-sm" name="name" required>
                </div>
                <div class="col-sm">
                    <label>Razão Social:</label>
                    <input type="text" class="form-control form-control-sm" name="corporate_name">
                </div>
                <div class="col-sm">
                    <label>CNPJ:</label>
                    <input type="text" class="form-control form-control-sm" name="cnpj" onchange="verifySupplier(this)">
                </div>
                <div class="col-sm">
                    <label>E-mail:</label>
                    <input type="mail" class="form-control form-control-sm" name="email">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Endereço:</label>
                    <input type="text" class="form-control form-control-sm" name="address">
                </div>
                <div class="col-sm-2">
                    <label>Estado:</label>
                    <select class="form-control form-control-sm" name="state" onchange="fetchCities()">
                        <option value="">Selecione...</option>
                        <?php foreach($states as $state): ?>
                            <option value="<?php echo $state['id']; ?>"><?php echo $state['estado']; ?> / <?php echo $state['uf']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>Cidade:</label>
                    <select class="form-control form-control-sm" name="city" id="city">
                        <option value="">Selecione...</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>Telefone:</label>
                    <input type="text" class="form-control form-control-sm" name="phone" placeholder="(XX) X XXXX-XXXX">
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label>Observações</label>
                    <textarea class="form-control form-control-sm" name="obs" style="resize: none; height: 100px"></textarea>
                </div>
            </div>
            </div>          
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="saveSupplier()" value="Salvar">
            </div>
        </div>
  </div>
</div>

<!-- Modal Cadastrar Categoria-->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addBrand" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row">
                <span>Nome da Categoria</span>
                <input type="text" class="form-control form-control-sm" name="cat_name" onchange="verifyCat(this)">
            </div>
            </div>          
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="saveCategory()" value="Salvar">
            </div>
        </div>
  </div>
</div>

<!-- Modal Cadastrar Marcas-->
<div class="modal fade" id="addBrands" tabindex="-1" role="dialog" aria-labelledby="addBrand" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Marca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row">
                <span>Nome da Marca</span>
                <input type="text" class="form-control form-control-sm" name="brand_name" onchange="verifyBrand(this)">
            </div>
            </div>          
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="saveBrand()" value="Salvar">
            </div>
        </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>assets/js/products.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/utils.js"></script>