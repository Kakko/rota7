<div class="add_area">
    <div class="titleAddArea">
        <span>Buscar Fornecedores</span>
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
                    <th>Id</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($suppliers AS $supplier): ?>
                    <tr>
                        <td><?php echo $supplier['id']; ?></td>
                        <td><?php echo $supplier['name']; ?></td>
                        <td><?php echo $supplier['cnpj']; ?></td>
                        <td><?php echo $supplier['phone']; ?></td>
                        <td><?php echo $supplier['city_name']; ?></td>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#" onclick="openEditModal(<?php echo $supplier['id']; ?>)">Editar</a></li>
                                    <li><a class="dropdown-item" href="#">Excluir</a></li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visualizationModalLabel">Editar Fornecedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="POST">
            <div class="modal-body" id="editSupplierArea">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <!-- <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="updSupplier()">Salvar</button> -->
                <input type="submit" class="btn btn-success" value="Salvar">
            </div>
        </form>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/supplier.js"></script>
