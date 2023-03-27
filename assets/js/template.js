function showDropDown(ele) {
    if(document.getElementById(ele.id+'_drop').style.height == "") {
        document.getElementById(ele.id+'_drop').style.height = "100px";
        document.getElementById(ele.id).style.background = "#26354A";
    } else {
        document.getElementById(ele.id+'_drop').style.height = "";
        document.getElementById(ele.id).style.background = "#31435d";
    }
}