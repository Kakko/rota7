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

function addClient() {
    let basket = ''
    let garupa = ''
    let garupa_almofada = ''
    let pedana = ''

    let name = document.querySelector('[name = "name"]').value
    let address = document.querySelector('[name = "address"]').value
    let cpf = document.querySelector('[name = "cpf"]').value
    let birth_date = document.querySelector('[name = "birth_date"]').value
    let email = document.querySelector('[name = "email"]').value
    let phone = document.querySelector('[name = "phone"]').value
    let phone2 = document.querySelector('[name = "phone2"]').value
    let state_id = document.querySelector('[name = "state"]').value
    let city_id = document.querySelector('[name = "city"]').value
    let brand = document.querySelector('[name = "b_brand"]').value
    let model = document.querySelector('[name = "b_model"]').value
    let hoop = document.querySelector('[name = "b_hoop"]').value
    let color = document.querySelector('[name = "b_color"]').value
    let serial = document.querySelector('[name = "b_serial"]').value

    if(document.getElementById('b_basket').checked) {
         basket = document.getElementById('b_basket').value = 'S'
    } else {
         basket = document.getElementById('b_basket').value = 'N'
    }

    if(document.getElementById('b_garupa').checked) {
         garupa = document.getElementById('b_garupa').value = 'S'
    } else {
         garupa = document.getElementById('b_garupa').value = 'N'
    }

    if(document.getElementById('b_garupa_almofada').checked) {
         garupa_almofada = document.getElementById('b_garupa_almofada').value = 'S'
    } else {
         garupa_almofada = document.getElementById('b_garupa_almofada').value = 'N'
    }

    if(document.getElementById('b_pedana').checked) {
         pedana = document.getElementById('b_pedana').value = 'S'
    } else {
         pedana = document.getElementById('b_pedana').value = 'N'
    }

    let obs = document.querySelector('[name = "b_obs"]').value
    

    var formData = new FormData();

    formData.append('name', name)
    formData.append('address', address)
    formData.append('cpf', cpf)
    formData.append('birth_date', birth_date)
    formData.append('email', email)
    formData.append('phone', phone)
    formData.append('phone2', phone2)
    formData.append('state_id', state_id)
    formData.append('city_id', city_id)
    formData.append('brand', brand)
    formData.append('model', model)
    formData.append('hoop', hoop)
    formData.append('color', color)
    formData.append('serial', serial)
    formData.append('basket', basket)
    formData.append('garupa', garupa)
    formData.append('garupa_almofada', garupa_almofada)
    formData.append('pedana', pedana)
    formData.append('obs', obs)
    formData.append('action', 'addClient')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert(xhr.responseText);
                window.location.reload();
            }
        }
    }
    xhr.send(formData);
}

function openEditModal(id) {

    var formData = new FormData();

    formData.append('id', id)
    formData.append('action', 'editClient')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('editClientArea').innerHTML = xhr.responseText
                $('#editModal').modal('show');

            }
        }
    }
    xhr.send(formData);
}

function updClient() {
    let basket = ''
    let garupa = ''
    let garupa_almofada = ''
    let pedana = ''

    let id = document.querySelector('[name = "id"]').value
    let name = document.querySelector('[name = "name"]').value
    let address = document.querySelector('[name = "address"]').value
    let cpf = document.querySelector('[name = "cpf"]').value
    let birth_date = document.querySelector('[name = "birth_date"]').value
    let email = document.querySelector('[name = "email"]').value
    let phone = document.querySelector('[name = "phone"]').value
    let phone2 = document.querySelector('[name = "phone2"]').value
    let state_id = document.querySelector('[name = "state"]').value
    let city_id = document.querySelector('[name = "city"]').value
    let b_id = document.querySelector('[name = "b_id"]').value
    let brand = document.querySelector('[name = "b_brand"]').value
    let model = document.querySelector('[name = "b_model"]').value
    let hoop = document.querySelector('[name = "b_hoop"]').value
    let color = document.querySelector('[name = "b_color"]').value
    let serial = document.querySelector('[name = "b_serial"]').value

    if(document.getElementById('b_basket').checked) {
         basket = document.getElementById('b_basket').value = 'S'
    } else {
         basket = document.getElementById('b_basket').value = 'N'
    }

    if(document.getElementById('b_garupa').checked) {
         garupa = document.getElementById('b_garupa').value = 'S'
    } else {
         garupa = document.getElementById('b_garupa').value = 'N'
    }

    if(document.getElementById('b_garupa_almofada').checked) {
         garupa_almofada = document.getElementById('b_garupa_almofada').value = 'S'
    } else {
         garupa_almofada = document.getElementById('b_garupa_almofada').value = 'N'
    }

    if(document.getElementById('b_pedana').checked) {
         pedana = document.getElementById('b_pedana').value = 'S'
    } else {
         pedana = document.getElementById('b_pedana').value = 'N'
    }

    let obs = document.querySelector('[name = "b_obs"]').value
    

    var formData = new FormData();

    formData.append('id', id)
    formData.append('name', name)
    formData.append('address', address)
    formData.append('cpf', cpf)
    formData.append('birth_date', birth_date)
    formData.append('email', email)
    formData.append('phone', phone)
    formData.append('phone2', phone2)
    formData.append('state_id', state_id)
    formData.append('city_id', city_id)
    formData.append('b_id', b_id)
    formData.append('brand', brand)
    formData.append('model', model)
    formData.append('hoop', hoop)
    formData.append('color', color)
    formData.append('serial', serial)
    formData.append('basket', basket)
    formData.append('garupa', garupa)
    formData.append('garupa_almofada', garupa_almofada)
    formData.append('pedana', pedana)
    formData.append('obs', obs)
    formData.append('action', 'updClient')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert(xhr.responseText);
                window.location.reload();
            }
        }
    }
    xhr.send(formData);
}

$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.phone_with_ddd').mask('(00) 0 0000-0000');
    $('.date').mask('00/00/0000');
})