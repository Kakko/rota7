function searchProductName(ele) {

    let name = ele.value;

    var formData = new FormData();

    formData.append('name', name)
    formData.append('product_action', 'search_item')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('products_area').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

function edit_item(id) {

    var formData = new FormData();

    formData.append('id', id)
    formData.append('product_action', 'edit_item')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                $('#edit_Product').modal('show');

                document.getElementById('edit_modal_body').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

function delete_product_image(id) {
    let c = confirm('Deseja Excluir a imagem selecionada?')

    if(c == true) {
        var formData = new FormData();

        formData.append('id', id)
        formData.append('product_action', 'delete_product_image')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    alert('Imagem excluida com sucesso!')
                    document.getElementById('product_image_area').innerHTML = xhr.responseText
                }
            }
        }
        xhr.send(formData);
    } else {
        return false;
    }
}