function regProduct() {
    $('#reg_product').modal('show');
}

function addProdType() {
    $('#reg_productType').modal('show');
}

function cadNewProdType(){
    let type = $("[name='newProdType']").val();
    let tax = $("[name='taxProd']").val();

    $.post('', {
        reg_action: 'addNewProdType',
        type: type,
        tax: tax
    }, function(data){
        $('#cadType').html(data);
    })
}