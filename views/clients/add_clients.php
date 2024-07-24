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
                        <input type="text" class="form-control form-control-sm cpf" name="cpf" placeholder="000.000.000-00" onchange="verifyCPF(this)">
                    </div>
                </div>
                <div class="row">  
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="email@email.com.br">
                    </div>
                    <div class="col-sm-2">
                        <label>Telefone 1:</label>
                        <input type="text" class="form-control form-control-sm phone_with_ddd" name="phone" placeholder="(47) 9 9999-9999">
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
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="submitButtonArea" style="width: 99%; height: 50px; display: flex; align-items: center; justify-content: right">
        <button class="btn btn-success" style="width: 200px" onclick="addClient()">Salvar</button>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/clients.js"></script>
