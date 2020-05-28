var top_bar_1 = document.getElementById("top_bar_1");
var top_bar_2 = document.getElementById("top_bar_2");
var top_bar_3 = document.getElementById("top_bar_3");

var length_1 = top_bar_1.textContent.length; 
var length_2 = top_bar_2.textContent.length; 
var length_3 = top_bar_3.textContent.length; 

function redimensionnement() {
    if(length_1>40 || length_3>40 || (window.matchMedia("(max-width: 825px)").matches && window.matchMedia("(min-width: 510px)").matches)){
        top_bar_1.style.display="none"
        top_bar_2.style.display="none"
    }
    else if(window.matchMedia("(max-width: 510px)").matches){
        top_bar_1.style.display="none"
        top_bar_2.style.display="none"
        top_bar_3.style.display="none"
    }
    else{
        top_bar_1.style.display="inline"
        top_bar_2.style.display="inline"
        top_bar_3.style.display="inline"
    }
}
redimensionnement()
window.addEventListener('resize', redimensionnement, false);
