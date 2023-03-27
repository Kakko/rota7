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
                console.log(xhr.responseText)
                document.getElementById('city').innerHTML = xhr.responseText
            }
        }
    }
    xhr.send(formData);
}

function openEditModal(id) {
    var formData = new FormData();

    formData.append('id', id)
    formData.append('action', 'editSupplier')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('editSupplierArea').innerHTML = xhr.responseText
                $('#editSupplierModal').modal('show');

            }
        }
    }
    xhr.send(formData);
}