<div class="displayArea">
    <div class="topArea">
        <div class="filterArea">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-sm">
        </div>
        <div class="filterArea">
            <label>Fornecedor:</label>
            <input type="text" class="form-control form-control-sm">
        </div>
        <div class="filterArea">
            <label>Tipo:</label>
            <input type="text" class="form-control form-control-sm">
        </div>
        <div class="filterArea">
            <label>???:</label>
            <input type="text" class="form-control form-control-sm">
        </div>
        <div class="filterArea">
            <button class="btn btn-sm btn-success">Pesquisar</button>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addProduct">Cadastrar</button>
        </div>
    </div>
    <div class="title">Cadastro de Produtos</div>
    <div class="showArea">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>IMAGEM</th>
                    <th>NOME</th>
                    <th>FORNECEDOR</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td style="width: 100px; height: 80px"><img style="height: 100%" src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $product['url']; ?>"></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['supplier']; ?></td>
                        <td><?php echo $product['qtd']; ?></td>
                        <td>R$ <?php echo number_format($product['sale_cost'],2,',','.'); ?></td>
                        <td>
                            <img src="<?php BASE_URL; ?>assets/icons/edit.png" style="width: 30px; margin-right: 5px; cursor: pointer" onclick="editItem(<?php echo $product['id']; ?>)">
                            <img src="<?php BASE_URL; ?>assets/icons/delete.png" style="width: 30px; cursor: pointer" onclick="deleteItem(<?php echo $product['id']; ?>)">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <label>Nome</label>
                    <input type="text" value="addProduct" name="product_action" hidden>
                    <input type="text" class="form-control form-control-sm" name="product_name" placeholder="Digite o nome do produto" required>
                </div>
                <div class="col-sm-3">
                    <label>Fornecedor</label>
                    <select class="form-control form-control-sm" name="product_supplier">
                        <option value="">Selecione...</option>
                        <?php foreach($suppliers as $supply): ?>
                            <option value="<?php echo $supply['id']; ?>"><?php echo $supply['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Categoria</label>
                    <select class="form-control form-control-sm" name="product_category">
                        <option value="">Selecione...</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Marca</label>
                    <select class="form-control form-control-sm" name="brand">
                        <option value="">Selecione...</option>
                        <?php foreach($brands as $brand): ?>
                            <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>EAN</label>
                    <input type="number" class="form-control form-control-sm" name="product_ean" required>
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
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
  </div>
</div>
<script>
	$(document).ready(function () {
		$('.money').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>