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
        <span>Cadastro de Cliente</span>
    </div>
    <div class="infoAddArea">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Dados Básicos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Bicicleta</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">Endereço</button>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent" style="padding: 10px">
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <form method="POST" id="formTest">
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
                        <input type="text" class="form-control form-control-sm cpf" name="cpf" placeholder="000.000.000-00">
                    </div>
                </div>
                <div class="row">  
                    <div class="col-sm-3">
                        <span>Data de Nascimento</span>
                        <input type="date" class="form-control form-control-sm" name="birth_date">
                    </div>
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="email@email.com.br">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Telefone 1:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone" placeholder="(47) 9 9999-9999">
                    </div>
                    <div class="col-sm-2">
                        <label>Telefone 2:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone2" placeholder="(47) 9 9999-9999">
                    </div>
                    <div class="col-sm-4">
                        <label>Estado:</label>
                        <select class="form-control form-control-sm" name="state" onchange="fetchCities()">
                            <option value="">Selecione...</option>
                            <?php foreach($states as $state): ?>
                                <option value="<?php echo $state['id']; ?>"><?php echo $state['estado']; ?> / <?php echo $state['uf']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Cidade:</label>
                        <select class="form-control form-control-sm" name="city" id="city">
                            <option value="">Selecione...</option>
                        </select>
                    </div>
                </div>
            </div>
            </form>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-sm-3">
                        <span>Marca</span>
                        <input type="text" class="form-control form-control-sm" name="b_brand">
                    </div>
                    <div class="col-sm-3">
                        <span>Modelo</span>
                        <input type="text" class="form-control form-control-sm" name="b_model">
                    </div>
                    <div class="col-sm-2">
                        <span>Aro</span>
                        <input type="number" class="form-control form-control-sm" name="b_hoop">
                    </div>
                    <div class="col-sm-2">
                        <span>Cor</span>
                        <input type="text" class="form-control form-control-sm" name="b_color">
                    </div>
                    <div class="col-sm-2">
                        <span>Nº de Série</span>
                        <input type="text" class="form-control form-control-sm" name="b_serial">
                    </div>
                </div>
                <div class="row" style="padding-bottom: 10px; padding-top: 10px">
                    <div style="width: 300px; height: 110px; border: 1px solid #EEE; margin-left: 10px; border-radius: 5px">
                        <div class="form-check">
                            <label class="form-check-label" for="b_basket">
                                Cesta
                            </label>
                            <input class="form-check-input" type="checkbox" id="b_basket" name="b_basket">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="b_garupa">
                                Garupeira
                            </label>
                            <input class="form-check-input" type="checkbox" id="b_garupa" name="b_garupa">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="b_garupa_almofada">
                                Garupeira com Almofadinha
                            </label>
                            <input class="form-check-input" type="checkbox" id="b_garupa_almofada" name="b_garupa_almofada">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="b_pedana">
                                Pedana
                            </label>
                            <input class="form-check-input" type="checkbox" id="b_pedana" name="b_pedana">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label>Observações</label>
                    <textarea name="b_obs"></textarea>
                </div>
            </div>
            <!-- <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">Endereço</div> -->
        </div>
    </div>
</div>
<div class="submitButtonArea" style="width: 99%; height: 50px; display: flex; align-items: center; justify-content: right">
    <button class="btn btn-success" style="width: 200px; margin-right: 20px" onclick="addClient()">Salvar</button>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/clients.js"></script>
