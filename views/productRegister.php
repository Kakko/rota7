<div class="sectionTop">
    Cadastro de Produtos
</div>
<div class="productRegister">
    <button class="btn btn-primary" onclick="regProduct()">Cadastrar novo Produto</button>
</div>
<div class="productData">
    <table class="table table-striped table-hover table-sm">
		<thead class="thead-dark">
			<tr>
                <th>Imagem</th>
				<th>Nome do Produto</th>
				<th>Tipo do Produto</th>
				<th>Valor do Produto</th>
                <th>Imposto do Produto</th>
                <th>Quantidade</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody> 
            <?php foreach($products as $prod): ?>
                <tr>
                    <th><image style="width: 50px; height: 50px" src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $prod['url']; ?>"></th>
                    <th><?php echo $prod['name']; ?></th>
                    <th><?php echo $prod['type_id']; ?></th>
                    <th><?php echo $prod['value']; ?></th>
                    <th><?php echo $prod['tax']; ?></th>
                    <th><?php echo $prod['qtd']; ?></th>
                    <th><button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button></th>
                </tr>
            
            <?php endforeach; ?>
		</tbody>
	</table>
</div>

<!-- Register Product Modal-->
<div class="modal fade" id="reg_product" style="overflow: auto">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cadastrar Novo Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" class="form-group" enctype="multipart/form-data"><br />
				<!-- Modal body -->
				<div class="modal-body" id="regNewProduct">
                    <div class="row">
                        <div class="col-sm">
                            <label>Nome do Produto</label>
                            <input type="text" value="addNewProd" name="reg_action" hidden>
                            <input type="text" class="form-control form-control-sm" name="product_name">
                        </div>
                        <div class="col-sm" id="cadType">
                            <label>Tipo do Produto</label>
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="product_type">
                                        <option readonly>Selecione...</option>
                                    <?php foreach($prod_type as $prod): ?>
                                        <option value="<?php echo $prod['id']; ?>"><?php echo $prod['type']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-sm" type="button" onclick="addProdType()"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <label>Imposto sobre o produto (%)</label>
                            <input type="number" class="form-control form-control-sm" name="product_tax">
                        </div>
                        <div class="col-sm">
                            <label>Valor do Produto</label>
                            <input type="number" class="form-control form-control-sm" name="product_value">
                        </div>
                        <div class="col-sm">
                            <label>Quantidade</label>
                            <input type="number" class="form-control form-control-sm" name="product_qtd">
                        </div>
                    </div>
                    <hr/><br/>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Imagem do produto</label>
                            <input type="FILE" name="product_image">
                        </div>
                    </div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Salvar</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Register Product Type Modal-->
<div class="modal fade" id="reg_productType" style="background-color: rgba(0,0,0,0.8)">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Cadastrar Novo Tipo de Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form method="POST" class="form-group"><br />
				<!-- Modal body -->
				<div class="modal-body" id="regNewProductType">
                    <div class="row">
                        <div class="col-sm">
                            <label>Novo Tipo de Produto</label>
                            <input type="text" class="form-control form-control-sm" name="newProdType">
                        </div>
                    </div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="cadNewProdType()" data-dismiss="modal">Salvar</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="./assets/js/productRegister.js"></script>