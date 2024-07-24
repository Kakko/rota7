<div class="add_area">
    <div class="titleAddArea">
        <span>Buscar Marcas</span>
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
                    <th style="width: 80%">Nome</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($brands AS $brand): ?>
                    <tr>
                        <td><?php echo $brand['id']; ?></td>
                        <td><?php echo $brand['name']; ?></td>
                        <td><button class="btn btn-danger btn-sm" onclick="delete_brand(<?php echo $brand['id']; ?>)">Excluir</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>assets/js/brands.js"></script>
