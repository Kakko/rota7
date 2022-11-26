<div class="displayArea">
    <div class="topArea">
        <div class="filterArea">
            <!-- <button class="btn btn-sm btn-success">Pesquisar</button> -->
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addClient">Cadastrar</button>
        </div>
    </div>
    <div class="title">Cadastro de Clientes</div>
    <div class="showArea">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clients as $client): ?>
                    <tr>
                        <td style="width: 5%"><?php echo $client['id']; ?></td>
                        <td style="width: 90%"><?php echo $client['name']; ?></td>
                        <td style="width: 5%">
                            <img src="<?php BASE_URL; ?>assets/icons/delete.png" style="width: 30px; cursor: pointer" onclick="deleteItem()">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Cadastrar-->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addClient" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-5">
                    <label>Nome:</label>
                    <input type="text" value="add" name="action" hidden>
                    <input type="text" class="form-control form-control-sm" name="name" required>
                </div>
                <div class="col-sm-5">
                    <label>Endereço:</label>
                    <input type="text" class="form-control form-control-sm" name="address">
                </div>
                <div class="col-sm-2">
                    <label>CPF:</label>
                    <input type="text" class="form-control form-control-sm" name="cpf">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label>E-mail:</label>
                    <input type="email" class="form-control form-control-sm" name="email">
                </div>
                <div class="col-sm-2">
                    <label>Telefone:</label>
                    <input type="text" class="form-control form-control-sm" name="phone">
                </div>
                <div class="col-sm-3">
                    <label>Estado:</label>
                    <select class="form-control form-control-sm" name="state" onchange="fetchCities()">
                        <option value="">Selecione...</option>
                        <?php foreach($states as $state): ?>
                            <option value="<?php echo $state['id']; ?>"><?php echo $state['estado']; ?> / <?php echo $state['uf']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label>Cidade:</label>
                    <select class="form-control form-control-sm" name="city" id="city">
                        <option value="">Selecione...</option>
                    </select>
                </div>
            </div>
        </div>          
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Salvar">
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


