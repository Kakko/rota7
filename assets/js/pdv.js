function fetchProducts(ele) {
    document.getElementById('prod_list').style.display = 'block';
    let name = ele.value

    let formData = new FormData();

    formData.append('name', name)
    formData.append('pdv_action', 'fetch_pdv_products');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('prod_list').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.send(formData);
}

function select_item(ele) {
    document.getElementById('prod_list').style.display = 'none';
    let id = ele.id;

    let formData = new FormData();

    formData.append('id', id)
    formData.append('pdv_action', 'fetch_pdv_product_info');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('selected_prod_info').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.send(formData);

    fetch_item_img(id);
}

function fetch_item_img(id) {

    let formData = new FormData();

    formData.append('id', id)
    formData.append('pdv_action', 'fetch_pdv_product_img');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                // console.log(xhr.responseText)
                document.getElementById('prod_img_area').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.send(formData);
}