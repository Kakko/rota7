function delete_brand(id) {
    let c = confirm('DESEJA EXCLUIR O REGISTRO SELECIONADO?');

    if(c == true) {
        var formData = new FormData();

        formData.append('id', id)
        formData.append('action', 'delete')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    alert(xhr.responseText)
                    window.location.reload();
                }
            }
        }
        xhr.send(formData);
    } else {
        return false;
    }
}