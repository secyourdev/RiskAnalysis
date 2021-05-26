var length_sous_atelier=16
var side_bar_scroll = document.getElementsByClassName('side_bar_scroll')
var rounded_button = document.getElementById('rounded_button')

for(let i=1;i<length_sous_atelier;i++){
    var nom_sous_atelier = document.getElementById("nom_sous_atelier_"+i)
    var value_nom_sous_atelier = nom_sous_atelier.innerText
    var modified_nom_sous_atelier;

    if(value_nom_sous_atelier.length>20){
        modified_nom_sous_atelier = value_nom_sous_atelier.substring(0,20)+"..."
        nom_sous_atelier.innerHTML=modified_nom_sous_atelier
    }
}

if(window.innerHeight<1920)
        rounded_button.style.display='none'
else
        rounded_button.style.display='inline'

window.addEventListener('resize', function(){
    accordionSidebar.classList.remove('toggled')
    if(window.innerHeight<1920)
        rounded_button.style.display='none'
    else
        rounded_button.style.display='inline'
})