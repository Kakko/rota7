
function openClientModal() {
    $('#addClient').modal('show');
}
function openBikeModal() {
    $('#addClientBike').modal('show');
}

function verifyBike(ele) {

    var formData = new FormData();

    formData.append('id', ele.value)
    
    formData.append('action', 'search_client_bike')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                document.getElementById('bicicle_id').innerHTML = xhr.responseText
                document.getElementById('bicicle_id').removeAttribute('disabled', false)
                document.getElementById('button_add_bike').removeAttribute('disabled', false)
            }
        }
    }
    xhr.send(formData);
}

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

function addClientBike() {
    let client_id = document.getElementById('client_id').value
    let brand = document.querySelector('[name = "brand"]').value
    let model = document.querySelector('[name = "model"]').value
    let hoop = document.querySelector('[name = "hoop"]').value
    let color = document.querySelector('[name = "color"]').value
    let serial = document.querySelector('[name = "serial"]').value
    let basket = document.querySelector('[name = "basket"]').value
    let garupa = document.querySelector('[name = "garupa"]').value
    let garupa_almofada = document.querySelector('[name = "garupa_almofada"]').value
    let pedana = document.querySelector('[name = "pedana"]').value
    let bike_obs = document.querySelector('[name = "bike_obs"]').value

    var formData = new FormData();

    formData.append('client_id', client_id)
    formData.append('brand', brand)
    formData.append('model', model)
    formData.append('hoop', hoop)
    formData.append('color', color)
    formData.append('serial', serial)
    formData.append('basket', basket)
    formData.append('garupa', garupa)
    formData.append('garupa_almofada', garupa_almofada)
    formData.append('pedana', pedana)
    formData.append('bike_obs', bike_obs)
    
    formData.append('action', 'addBike')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert(xhr.responseText);
                upd_bike();
                $('#addClientBike').modal('hide');

            }
        }
    }
    xhr.send(formData);
}

function upd_bike() {
    let client_id = document.getElementById('client_id').value

    var formData = new FormData();

    formData.append('id', client_id)
    
    formData.append('action', 'search_client_bike')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('bicicle_id').innerHTML = xhr.responseText
                document.getElementById('bicicle_id').removeAttribute('disabled', false)
                document.getElementById('button_add_bike').removeAttribute('disabled', false)
            }
        }
    }
    xhr.send(formData);
}

function save_service() {
    let client_id = document.querySelector('[name = "client_id"]').value
    let bicicle_id = document.querySelector('[name = "bicicle_id"]').value
    let income_date = document.querySelector('[name = "income_date"]').value
    let income_hour = document.querySelector('[name = "income_hour"]').value
    let deliver_date = document.querySelector('[name = "deliver_date"]').value
    let deliver_hour = document.querySelector('[name = "deliver_hour"]').value
    let localizacao = document.querySelector('[name = "localizacao"]').value
    let status = document.querySelector('[name = "status"]').value
    let internal_obs = document.querySelector('[name = "internal_obs"]').value
    let service_obs = document.querySelector('[name = "service_obs"]').value
    let valor = document.querySelector('[name = "valor"]').value
    let paid = document.querySelector('[name = "paid"]:checked').value
    
    var formData = new FormData();

    formData.append('client_id', client_id)
    formData.append('bicicle_id', bicicle_id)
    formData.append('income_date', income_date)
    formData.append('income_hour', income_hour)
    formData.append('deliver_date', deliver_date)
    formData.append('deliver_hour', deliver_hour)
    formData.append('localizacao', localizacao)
    formData.append('status', status)
    formData.append('internal_obs', internal_obs)
    formData.append('service_obs', service_obs)
    formData.append('valor', valor)
    formData.append('paid', paid)
    
    formData.append('action', 'save_service')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert(xhr.responseText)
                window.location.reload()
            }
        }
    }
    xhr.send(formData);
}

function updService(id) {
    let paid = '';
    let client_id = document.querySelector('[name = "client_id"]').value
    let bicicle_id = document.querySelector('[name = "bicicle_id"]').value
    let income_date = document.querySelector('[name = "income_date"]').value
    let income_hour = document.querySelector('[name = "income_hour"]').value
    let deliver_date = document.querySelector('[name = "deliver_date"]').value
    let deliver_hour = document.querySelector('[name = "deliver_hour"]').value
    let localizacao = document.querySelector('[name = "localizacao"]').value
    let status = document.querySelector('[name = "status"]').value
    let internal_obs = document.querySelector('[name = "internal_obs"]').value
    let service_obs = document.querySelector('[name = "service_obs"]').value
    let valor = document.querySelector('[name = "valor"]').value
    if(document.querySelector('[name = "paid"]:checked')){
        paid = 'N'
    } else {
        paid = 'S'
    }
    
    var formData = new FormData();

    formData.append('id', id);
    formData.append('client_id', client_id)
    formData.append('bicicle_id', bicicle_id)
    formData.append('income_date', income_date)
    formData.append('income_hour', income_hour)
    formData.append('deliver_date', deliver_date)
    formData.append('deliver_hour', deliver_hour)
    formData.append('localizacao', localizacao)
    formData.append('status', status)
    formData.append('internal_obs', internal_obs)
    formData.append('service_obs', service_obs)
    formData.append('valor', valor)
    formData.append('paid', paid)
    
    formData.append('action', 'upd_service')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert(xhr.responseText)
                window.location.reload()
            }
        }
    }
    xhr.send(formData);
}

function searchService() {
    let client = '';
    let status = '';
    let income_date = '';
    let deliver_date = '';

    (document.querySelector("[name = 'client_name']") !== '') ?  client = document.querySelector("[name = 'client_name']").value : '';
    (document.querySelector("[name = 'status']") !== '') ?  status = document.querySelector("[name = 'status']").value : '';
    (document.querySelector("[name = 'income_date']") !== '') ?  income_date = document.querySelector("[name = 'income_date']").value : '';
    (document.querySelector("[name = 'deliver_date']") !== '') ?  deliver_date = document.querySelector("[name = 'deliver_date']").value : '';

    var formData = new FormData();

    formData.append('client', client)
    formData.append('status', status)
    formData.append('income_date', income_date)
    formData.append('deliver_date', deliver_date)
    
    formData.append('action', 'search_service')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('services_list').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

function openEditModal(id) {
    var formData = new FormData();

    formData.append('id', id)
    
    formData.append('action', 'edit_service')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                document.getElementById('editServiceArea').innerHTML = xhr.responseText
                $('#editService').modal('show');
            }
        }
    }
    xhr.send(formData);
}

function updPayment(id) {
    var formData = new FormData();

    formData.append('id', id)
    
    formData.append('action', 'upd_payment')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                document.getElementById('updPaymentArea').innerHTML = xhr.responseText
                $('#updPayment').modal('show');
            }
        }
    }
    xhr.send(formData);
}

function upd_payment(id) {
    let original_value = document.querySelector("[name = 'original_value']").value
    let paid_value = document.querySelector("[name = 'paid_value']").value

    paid_value = paid_value.replace(',', '.');
    original_value = original_value.replace(',', '.');


    if(paid_value < original_value) {
        let c = confirm('Valor pago é menor que o devido. Continuar?');

        if(c == false) {
            return false;
        }
    }

    var formData = new FormData();

    formData.append('id', id)
    formData.append('paid_value', paid_value)
    formData.append('original_value', original_value);
    
    formData.append('action', 'upd_client_payment')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                console.log(xhr.responseText)
                alert('Pagamento atualizado com sucesso');
                $('#updPayment').modal('hide');
            }
        }
    }
    xhr.send(formData);
}

function deleteService(id) {
    let c = confirm('Deseja excluir o serviço selecionado?');

    if(c == true) {
        var formData = new FormData();

        formData.append('id', id)
        
        formData.append('action', 'delete_service')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4) {
                if(xhr.status == 200) {
                    console.log(xhr.responseText)
                    if(xhr.responseText == 0) {
                        alert('Serviço excluído com sucesso!');
                        window.location.reload();
                    } else if(xhr.responseText == 1) {
                        alert('Exclusão não realizada. Entre em contato com o Administrador do sistema');
                    } else if(xhr.responseText == 2) {
                        alert('Impossível excluir. Serviço já fechado');
                    }
                }
            }
        }
        xhr.send(formData);
    }
}

function finishService(id) {
    let c = confirm('Deseja fechar o serviço selecionado?');

    if(c == true) {
        var formData = new FormData();

        formData.append('id', id)
        
        formData.append('action', 'finish_service')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4) {
                if(xhr.status == 200) {
                    if(xhr.responseText == true) {
                        document.getElementById(id).style.backgroundColor = '#caffc2';
                    }
                }
            }
        }
        xhr.send(formData);
    }
}