<div class="sectionTop">
    Realizar Venda
</div>
<div class="saleArea">
    <div class="row" style="width: 40%; margin: auto">
        <div class="col-sm-10">
            <label>Produto:</label>
            <select class="form-control form-control-sm" name="productName">
                <option value="" readonly>Selecione...</option>
                <?php foreach($setSales as $prod): ?>
                    <option value="<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label>Quantidade:</label>
            <input type="number" class="form-control form-control-sm" name="saleQtd">
        </div>
    </div>
    <button class="btn btn-primary float-right" style="margin-right: 30%; margin-top: 20px" onclick="addButton()">Adicionar</button>
    <div class="addedProducts">
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Nome do Produto</th>
                    <th>Tipo do Produto</th>
                    <th>Imposto total do Produto (R$)</th>
                    <th>Valor total do Produto (R$)</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody id="addedProducts"> 
                
            </tbody>
        </table>
        <input type="submit" class="btn btn-success float-right" name="finishSale" value="Finalizar Compra" onclick="endSale()">
        <div class="total">
            <label>Total Imposto:</label>
            <input type="text" class="form-control form-control-sm" id="totaltax" disabled>
            <label>Total Valor:</label>
            <input type="text" class="form-control form-control-sm" id="totalProducts" disabled>

        </div>
    </div>
</div>
<script type="text/javascript" src="./assets/js/sales.js"></script>