function addClient() {

    let name = document.querySelector('[name = "name"]').value
    let address = document.querySelector('[name = "address"]').value
    let cpf = document.querySelector('[name = "cpf"]').value
    let email = document.querySelector('[name = "email"]').value
    let phone = document.querySelector('[name = "phone"]').value
    let state_id = document.querySelector('[name = "state"]').value
    let city_id = document.querySelector('[name = "city"]').value

    var formData = new FormData();

    formData.append('name', name)
    formData.append('address', address)
    formData.append('cpf', cpf)
    formData.append('email', email)
    formData.append('phone', phone)
    formData.append('state_id', state_id)
    formData.append('city_id', city_id)
    
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

    let id = document.querySelector('[name = "id"]').value
    let name = document.querySelector('[name = "name"]').value
    let address = document.querySelector('[name = "address"]').value
    let cpf = document.querySelector('[name = "cpf"]').value
    let email = document.querySelector('[name = "email"]').value
    let phone = document.querySelector('[name = "phone"]').value
    let state_id = document.querySelector('[name = "state"]').value
    let city_id = document.querySelector('[name = "city"]').value

    var formData = new FormData();

    formData.append('id', id)
    formData.append('name', name)
    formData.append('address', address)
    formData.append('cpf', cpf)
    formData.append('email', email)
    formData.append('phone', phone)
    formData.append('state_id', state_id)
    formData.append('city_id', city_id)
    
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

function deleteClient(id) {
    let c = confirm('Deseja excluir o cliente selecionado?');

    if(c == true) {
        var formData = new FormData()

        formData.append('id', id);
        formData.append('action', 'deleteClient');

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

    } else {
        return false;
    }
}

$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.phone_with_ddd').mask('(00) 0 0000-0000');
    $('.date').mask('00/00/0000');
})