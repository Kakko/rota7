<div class="displayArea">
    <div class="topArea">
        <div class="filterArea">
            <label>Nome:</label>
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
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addSupplier">Cadastrar</button>
        </div>
    </div>
    <div class="title">Cadastro de Fornecedores</div>
    <div class="showArea">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>RAZÃO SOCIAL</th>
                    <th>E-MAIL</th>
                    <th>TELEFONE</th>
                    <th>OBSERVAÇÕES</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($suppliers as $supply): ?>
                    <tr>
                        <td><?php echo $supply['id']; ?></td>
                        <td><?php echo $supply['name']; ?></td>
                        <td><?php echo $supply['corporate_name']; ?></td>
                        <td><?php echo $supply['email']; ?></td>
                        <td><?php echo $supply['phone']; ?></td>
                        <td><?php echo $supply['obs']; ?></td>
                        <td>
                            <img src="<?php BASE_URL; ?>assets/icons/edit.png" style="width: 30px; margin-right: 5px; cursor: pointer" onclick="editItem(<?php echo $supply['id']; ?>)">
                            <img src="<?php BASE_URL; ?>assets/icons/delete.png" style="width: 30px; cursor: pointer" onclick="deleteItem(<?php echo $supply['id']; ?>)">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Cadastrar-->
<div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="addSupplier" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Fornecedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
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
                    <input type="text" class="form-control form-control-sm" name="cnpj">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="editSupplier" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Fornecedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
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
                    <input type="text" class="form-control form-control-sm" name="cnpj">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
  </div>
</div>
<script>
    function fetchCities() {
        let id = document.querySelector('[name = "state"]').value;

        var formData = new FormData();

        formData.append('id', id)
        formData.append('action', 'fetchCities')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4) {
                if(xhr.status == 200) {
                    document.getElementById('city').innerHTML = xhr.responseText
                }
            }
        }
        xhr.send(formData);
    }

    function editItem(id) {
        $('#editSupplier').modal('show');
    }

</script>