function finalSale(){

}
function addButton(){
    let name = $("[name='productName']").val();
    let qtd = $("[name='saleQtd']").val();

    $.post('', {
        sale_action: 'add',
        name: name,
        qtd: qtd,
    }, function(data){
        $('#addedProducts').append(data);
    })
}

function endSale(){
    let total = $('.totProd');
    let tax = $('.tottax');

    let totalValue = 0;
    let totalTax = 0;

    $(total).each(function(index, element){

        totalValue += parseFloat($(element).html());
    })
    $(tax).each(function(index, element){

        totalTax += parseFloat($(element).html());
    })

    $('#totalProducts').val('R$ '+totalValue);
    $('#totaltax').val('R$ '+totalTax);

}