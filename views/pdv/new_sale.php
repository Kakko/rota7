<div class="add_area">
    <div class="titleAddArea">
        <span>Nova Venda</span>
        <span style="padding-right: 10px">Funcionário: <?php echo $user_data['name']; ?></span>
    </div>
    <div class="pdv_area">
        <div class="left_pdv">
            <div class="cod_input_area">
                <label>Nome do Produto</label>
                <input type="text" class="form-control form-control-sm" id="name_input" onkeyup="fetchProducts(this)" autocomplete="off">
                <div class="prod_list" id="prod_list" style="display: none"></div>
            </div>
            <div class="sales_itens_area">
                <label>Itens da Venda</label>
            </div>
            <div class="selected_prod_info" id="selected_prod_info">

            </div>
        </div>
        <div class="right_pdv">
            <div class="right_pdv_top" id="prod_img_area">

            </div>
            <div class="right_pdv_bottom">
                <button class="btn btn-warning w-100">Adicionar à Venda</button>
                <button class="btn btn-success w-100">Concluir Venda</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/pdv.js"></script>