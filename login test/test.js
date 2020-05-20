function validateForm() {
    var x = document.forms["perso_form_js"]["fname"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
}