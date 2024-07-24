<div class="add_area">
    <div class="titleAddArea">
        <span>Buscar Serviços</span>
    </div>
    <div class="infoAddArea">
        <div class="row" style="padding: 10px;">
            <div class="col-sm">
                <label for="client_name">Nome do Cliente</label>
                <select class="form-select" name="client_name">
                    <option value="">Selecione o Cliente:</option>
                    <?php foreach($clients->fetchClients()  AS $client): ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm">
                <label for="status">Status do Serviço</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Selecione:</option>
                    <option>Aguardando Mecânico</option>
                    <option>Aguardando Peça</option>
                    <option>Aguardando Retirada</option>
                    <option>Abandonado</option>
                    <option>Cancelado</option>
                    <option>Entregue</option>
                    <option>Outros</option>
                </select>
            </div>
            <div class="col-sm">
                <label for="income_date">Data de Entrada:</label>
                <input type="date" class="form-control form-control-sm" name="income_date">
            </div>
            <div class="col-sm">
                <label for="deliver_date">Data de Entrega:</label>
                <input type="date" class="form-control form-control-sm" name="deliver_date">
            </div>
            <div class="col-sm">
                <label for=""> </label>
                <button class="btn btn-warning w-100" onclick="searchService()">Pesquisar</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Bicicleta</th>
                    <th>Localização</th>
                    <th>Data Entrega</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="services_list">
                
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Atualizar Pagamento-->
<div class="modal fade" id="updPayment" tabindex="-1" role="dialog" aria-labelledby="updPayment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar Pagamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body" id="updPaymentArea">

        </div> 
    </div>
  </div>
</div>

<!-- Modal Editar Serviço-->
<div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-labelledby="edirService" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body" id="editServiceArea">
        </div> 
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="button" class="btn btn-success" onclick="updServices()" value="Salvar">
            </div> -->
        </div>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>assets/js/services.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/utils.js"></script>
