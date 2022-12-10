<div class="displayArea">
    <div class="topArea">
        <div class="filterArea">
            <!-- <button class="btn btn-sm btn-success">Pesquisar</button> -->
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addBrand">Cadastrar</button>
        </div>
    </div>
    <div class="title">Cadastro de Marcas</div>
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
                <?php foreach($brands as $brand): ?>
                    <tr>
                        <td style="width: 5%"><?php echo $brand['id']; ?></td>
                        <td style="width: 90%"><?php echo $brand['name']; ?></td>
                        <td style="width: 5%">
                            <img src="<?php BASE_URL; ?>assets/icons/delete.png" style="width: 30px; cursor: pointer" onclick="deleteItem(<?php echo $brand['id']; ?>)">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Cadastrar-->
<div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="addBrand" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm">
                    <label>Nome:</label>
                    <input type="text" value="add" name="action" hidden>
                    <input type="text" class="form-control form-control-sm" name="name" required>
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


