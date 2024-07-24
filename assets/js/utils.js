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

function search_client_name() {
    let client_name = document.querySelector('[name="search_client_name"]').value

    var formData = new FormData();

    formData.append('client_name', client_name)
    
    formData.append('action', 'search_client_name')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('search_box').innerHTML = xhr.responseText
                document.getElementById('search_box').style.display = 'flex';
            }
        }
    }
    xhr.send(formData);
}

function select_client(props) {
    // let client_name = document.querySelector('[name="search_client_name"]').value

    let id = props.id

    var formData = new FormData();

    formData.append('id', id)
    
    formData.append('action', 'fetchSearchedClientData')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.querySelector('[name="search_client_name"]').innerText = props.innerText
                document.getElementById('client_list').innerHTML = xhr.responseText
                document.getElementById('search_box').style.display = 'none';
            }
        }
    }
    xhr.send(formData);
}

function verifySupplier(ele) {
    let cnpj = ele.value

    var formData = new FormData();

    formData.append('cnpj', cnpj)
    
    formData.append('action', 'verifySupplier')

    let url = '../util/verifying/'

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                if(xhr.responseText == true) {
                    alert('CNPJ já cadastrado no sistema');
                    ele.value = '';
                }
            }
        }
    }
    xhr.send(formData);
}

function verifyBrand(ele) {
    let name = ele.value

    var formData = new FormData();

    formData.append('name', name)
    
    formData.append('action', 'verifyBrand')

    let url = '../util/verifying/'

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {

                if(xhr.responseText == true) {
                    alert('Marca já cadastrado no sistema');
                    ele.value = '';
                }
            }
        }
    }
    xhr.send(formData);
}

function verifyCat(ele) {
    let name = ele.value

    var formData = new FormData();

    formData.append('name', name)
    
    formData.append('action', 'verifyCat')

    let url = '../util/verifying/'

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText);
                if(xhr.responseText == true) {
                    alert('Categoria já cadastrado no sistema');
                    ele.value = '';
                }
            }
        }
    }
    xhr.send(formData);
}

function verifyCPF(ele) {
    let cpf = ele.value

    var formData = new FormData();

    formData.append('cpf', cpf)
    
    formData.append('action', 'verifyCPF')

    let url = '../util/verifying/'

    const xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                if(xhr.responseText == true) {
                    alert('CPF / Cliente já cadastrado no sistema');
                    ele.value = '';
                }
            }
        }
    }
    xhr.send(formData);
}

$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.phone_with_ddd').mask('(00) 0 0000-0000');
    $('.date').mask('00/00/0000');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
})