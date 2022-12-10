function editSupplier(id) {
    var formData = new FormData();

    formData.append('id', id)
    formData.append('action', 'edit_item')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                $('#editSupplier').modal('show');

                document.getElementById('edit_supplier').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

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