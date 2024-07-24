<style>
    textarea {
        height: 100px; 
        resize: none; 
        /* margin-left: 2.5%;  */
        border: 1px solid #CCC; 
        border-radius: 5px
    }

    .infoAddArea {
        padding: 10px;
    }
</style>
<div class="add_area">
    <div class="titleAddArea">
        <span>Cadastro de Serviço</span>
    </div>
    <div class="infoAddArea">
        <div class="row">
            <div class="col-sm">
                <label for="">Cliente:</label>
                <div class="input-group mb-3">
                    <select class="form-select form-select-sm" name="client_id" id="client_id" onchange="verifyBike(this)">
                        <option value="">Selecione...</option>
                        <?php foreach($clients->fetchClients() AS $client): ?>
                            <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-success btn-sm" type="button" id="button-addon2" onclick="openClientModal()">+</button>
                </div>
            </div>
            <div class="col-sm">
                <label for="">Bicicleta:</label>
                <div class="input-group mb-3">
                    <select class="form-select form-select-sm" name="bicicle_id" id="bicicle_id" disabled>
                        <option value="">Selecione...</option>

                    </select>
                    <button class="btn btn-success btn-sm" type="button" id="button_add_bike" onclick="openBikeModal()" disabled>+</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <label for="">Data de Entrada</label>
                <input type="date" class="form-control form-control-sm" name="income_date">
            </div>
            <div class="col-sm-2">
                <label for="">Hora</label>
                <input type="time" class="form-control form-control-sm" name="income_hour">
            </div>
            <div class="col-sm-2">
                <label for="">Previsão de Entrega</label>
                <input type="date" class="form-control form-control-sm" name="deliver_date">
            </div>
            <div class="col-sm-2">
                <label for="">Hora</label>
                <input type="time" class="form-control form-control-sm" name="deliver_hour">
            </div>
            <div class="col-sm-2">
                <label for="">Localização</label>
                <select class="form-select" name="localizacao">
                    <option>Selecione...</option>
                    <option>Oficina</option>
                    <option>Depósito</option>
                    <option>Loja</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="">Status</label>
                <select class="form-select" name="status">
                    <option>Selecione...</option>
                    <option>Aguardando Mecânico</option>
                    <option>Aguardando Peça</option>
                    <option>Aguardando Retirada</option>
                    <option>Entregue</option>
                    <option>Cancelado</option>
                    <option>Abandonado</option>
                    <option>Outros</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <label for="">Observações Internas</label>
                <textarea class="form-control" name="internal_obs"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <label for="">Observações Para o Cliente</label>
                <textarea class="form-control" name="service_obs"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <label for="">Valor:</label>
                <input type="text" name="valor" class="form-control form-control-sm money" placeholder="R$">
            </div>
            <div class="col-sm-1">
                <label for="">Pago:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paid" id="paid_y" value="S">
                    <label class="form-check-label" for="paid_y">
                        Sim
                    </label>
                </div>
            </div>
            <div class="col-sm-1">
                <label for=""> </label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paid" id="paid_n" value="N" checked>
                    <label class="form-check-label" for="paid_n">
                        Não
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10"></div>
            <div class="col-sm-2">
                <button class="btn btn-success w-100" onclick="save_service()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cadastrar Cliente-->
<div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="addClient" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
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
                        <input type="text" class="form-control form-control-sm cpf" name="cpf" placeholder="000.000.000-00"  onchange="verifyCPF(this)">
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
            </form>
            </div>          
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="addClient()" value="Salvar">
            </div>
        </div>
  </div>
</div>

<!-- Modal Cadastrar Bicicleta-->
<div class="modal fade" id="addClientBike" tabindex="-1" role="dialog" aria-labelledby="addClientBike" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Nova Bicicleta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm">
                    <label for="">Marca</label>
                    <input type="text" class="form-control form-control-sm" name="brand" placeholder="Marca">
                </div>
                <div class="col-sm">
                    <label for="">Modelo</label>
                    <input type="text" class="form-control form-control-sm" name="model" placeholder="Modelo">
                </div>
                <div class="col-sm">
                    <label for="">Tamanho do Aro</label>
                    <input type="number" class="form-control form-control-sm" name="hoop" placeholder="Ex: 29">
                </div>
                <div class="col-sm">
                    <label for="">Cor</label>
                    <input type="text" class="form-control form-control-sm" name="color" placeholder="Ex: Preta">
                </div>
                <div class="col-sm">
                    <label for="">Serial ou NF</label>
                    <input type="text" class="form-control form-control-sm" name="serial">
                </div>
            </div>
            <br>
            <div class="row" style="border: 1px solid #CCC; background-color: #EEE">
                <label for="">Acessórios</label><br/>
                <div class="col-sm">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">Cesta</label>
                        <input class="form-check-input" type="checkbox" value="S" name="basket">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">Garupa</label>
                        <input class="form-check-input" type="checkbox" value="S" name="garupa">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">Almofada Garupa</label>
                        <input class="form-check-input" type="checkbox" value="S" name="garupa_almofada">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">Pedana</label>
                        <input class="form-check-input" type="checkbox" value="S" name="pedana">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label for="">Observações:</label>
                    <textarea name="bike_obs" class="form-control"></textarea>
                </div>
            </div>
            </div>          
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="addClientBike()" value="Salvar">
            </div>
        </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>assets/js/services.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/utils.js"></script>