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
        <span>Cadastro do Fornecedor</span>
    </div>
    <div class="infoAddArea">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Dados Básicos</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="padding: 10px">
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <form method="POST">
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
                            <input type="text" class="form-control form-control-sm cnpj" name="cnpj" onchange="verifySupplier(this)">
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
                            <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone" placeholder="(XX) X XXXX-XXXX">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Observações</label>
                            <textarea class="form-control form-control-sm" name="obs" style="resize: none; height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="submitButtonArea" style="width: 99%; height: 50px; display: flex; align-items: center; justify-content: right">
    <!-- <button class="btn btn-success" style="width: 200px; margin-right: 20px" onclick="addSupplier()">Salvar</button> -->
    <input type="submit" class="btn btn-success" style="width: 200px; margin-right: 15px" value="Salvar">
</div>
                </form>
            </div>
            <!-- <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">Endereço</div> -->
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/supplier.js"></script>
