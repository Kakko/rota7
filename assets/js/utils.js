function deleteItem(id) {
    let c = confirm('Deseja Excluir o item selecionado?')

    if(c == true) {
        var formData = new FormData();

        formData.append('id', id)
        formData.append('utility_action', 'delete_item')

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