
<div class="add_area">
    <div class="titleAddArea">
        <span>Buscar Produtos</span>
    </div>
    <div class="infoAddArea">
        <div class="row">
            <div class="col-sm-5" style="margin-left: 10px">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>IMAGEM</th>
                    <th>NOME</th>
                    <th>FORNECEDOR</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <?php $product['url'] == null ? $img = BASE_URL.'assets/icons/no-image.png' : $img = BASE_URL.'assets/images/products/'.$product['url']; ?>
                    <tr>
                        <td style="width: 100px; height: 80px"><img style="height: 100%" src="<?php echo $img ?>"></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['supplier']; ?></td>
                        <td><?php echo $product['qtd']; ?></td>
                        <td>R$ <?php echo number_format($product['sale_cost'],2,',','.'); ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#" onclick="edit_prod(<?php echo $product['id']; ?>)">Editar</a></li>
                                    <li><a class="dropdown-item" href="#">Excluir</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo BASE_URL; ?>products/search_product?page=1&limit=5">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visualizationModalLabel">Editar Fornecedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="POST">
            <div class="modal-body" id="editProductArea">
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="submit" class="btn btn-success" value="Salvar">
            </div> -->
        </form>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/products.js"></script>
