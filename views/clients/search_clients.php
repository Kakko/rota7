<div class="add_area">
    <div class="titleAddArea">
        <span>Buscar Cliente</span>
    </div>
    <div class="infoAddArea">
        <div class="row">
            <div class="col-sm-5" style="margin-left: 10px">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nome do Cliente" aria-label="Pesquisar" aria-describedby="basic-addon2" name="search_client_name" onkeyup="search_client_name()">
                    <div class="search_box" id="search_box">

                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="client_list">
                <?php foreach($clients AS $client): ?>
                    <tr>
                        <td><?php echo $client['name']; ?></td>
                        <td><?php echo $client['address']; ?></td>
                        <td><?php echo $client['phone']; ?></td>
                        <td><?php echo $client['city_name']; ?></td>
                        <th>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#" onclick="openEditModal(<?php echo $client['id']; ?>)">Editar</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="deleteClient(<?php echo $client['id']; ?>)">Excluir</a></li>
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
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visualizationModalLabel">Visualizar Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="editClientArea">
        
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="updClient()">Salvar</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/clients.js"></script>
