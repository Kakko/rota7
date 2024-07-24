function openSupplierModal() {
    $('#addSupplier').modal('show');
}

function openCatModal() {
    $('#addCategory').modal('show');
}

function openBrandModal() {
    $('#addBrands').modal('show');
}

//SUPPLIER FUNCTIONS
function saveSupplier() {
    
    let name = document.querySelector('[name = "name"]').value
    let corporate_name = document.querySelector('[name = "corporate_name"]').value
    let cnpj = document.querySelector('[name = "cnpj"]').value
    let email = document.querySelector('[name = "email"]').value
    let address = document.querySelector('[name = "address"]').value
    let state_id = document.querySelector('[name = "state"]').value
    let city_id = document.querySelector('[name = "city"]').value
    let phone = document.querySelector('[name = "phone"]').value
    let obs = document.querySelector('[name = "obs"]').value
    

    var formData = new FormData();

    formData.append('name', name)
    formData.append('corporate_name', corporate_name)
    formData.append('cnpj', cnpj)
    formData.append('email', email)
    formData.append('address', address)
    formData.append('phone', phone)
    formData.append('state_id', state_id)
    formData.append('city_id', city_id)
    formData.append('obs', obs)
    formData.append('action', 'addSupplier')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                reloadSupplier()
            }
        }
    }
    xhr.send(formData);
}

function reloadSupplier() {
    var formData = new FormData();

    formData.append('action', 'reloadSupplier')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('supplier_id').innerHTML = xhr.responseText
                $('#addSupplier').modal('toggle');
            }
        }
    }
    xhr.send(formData);
}

//CATEGORY FUNCTIONS
function saveCategory() {
    let name = document.querySelector('[name = "cat_name"]').value
    var formData = new FormData();

    formData.append('name', name)
    formData.append('action', 'addCategory')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                reloadCategory()
            }
        }
    }
    xhr.send(formData);
}

function reloadCategory() {
    var formData = new FormData();

    formData.append('action', 'reloadCategory')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('product_category').innerHTML = xhr.responseText
                $('#addCategory').modal('toggle');
            }
        }
    }
    xhr.send(formData);
}

//BRANDS FUNCTIONS
function saveBrand() {
    let name = document.querySelector('[name = "brand_name"]').value
    var formData = new FormData();

    formData.append('name', name)
    formData.append('action', 'addBrands')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                reloadBrands()
            }
        }
    }
    xhr.send(formData);
}

function reloadBrands() {
    var formData = new FormData();

    formData.append('action', 'reloadBrands')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('product_brand').innerHTML = xhr.responseText
                $('#addBrands').modal('toggle');
            }
        }
    }
    xhr.send(formData);
}

//EDIT PRODUCT
function edit_prod(id) {

    $('#editProductModal').modal('show');

    var formData = new FormData();

    formData.append('id', id)
    formData.append('action', 'edit_item')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('editProductArea').innerHTML = xhr.responseText
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
        formData.append('action', 'delete_product_image')

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

//FETCH CITIES
function fetchCities() {
    let id = document.querySelector('[name = "state"]').value;

    var formData = new FormData();

    formData.append('id', id)
    formData.append('action', 'fetchCities')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('city').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

//VERIFY IF PRODUCT IS ALREADY REGISTERED
function verifyProduct() {

    let supplier_id = document.getElementById('supplier_id').value;
    let product_code = document.getElementById('product_code').value;

    var formData = new FormData();

    formData.append('supplier_id', supplier_id)
    formData.append('product_code', product_code)
    formData.append('action', 'verify_product')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
                if(xhr.responseText == 1) {
                    alert('PRODUTO JÁ CADASTRADO NESSE FORNECEDOR');
                    document.getElementById('supplier_id').value = '';
                    return false;
                }
            }
        }
    }
    xhr.send(formData);
}

//SEARCH PRODUCTS
function search_product(ele) {

    let product_name = ele.value;

    var formData = new FormData();

    formData.append('product_name', product_name)
    formData.append('action', 'search_product')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
                document.getElementById('prod_list').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

//DELETE PRODUCT
function delete_product(id) {
    let c = confirm('Deseja excluir o produtol?')

    if(c == true ) {
        var formData = new FormData();

        formData.append('id', id)
        formData.append('action', 'delete_product')
    
        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    console.log(xhr.responseText)
                    alert(xhr.responseText);
                    window.location.reload();
                }
            }
        }
        xhr.send(formData);
    } else {
        return false;
    }

}