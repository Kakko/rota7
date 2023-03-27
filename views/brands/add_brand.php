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
        <span>Cadastro de Marcas</span>
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
                            <label>Nome da Marca:</label>
                            <input type="text" name="action" value="add" hidden>
                            <input type="text" class="form-control form-control-sm" name="brand_name">
                        </div>
                    </div>
                    <div class="submitButtonArea" style="width: 99%; height: 50px; display: flex; align-items: center; justify-content: right">
                        <input type="submit" class="btn btn-success" style="width: 200px; margin-right: 15px" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>assets/js/supplier.js"></script>
