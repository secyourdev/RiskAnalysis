var fixed_page = document.getElementById('fixed_page');
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggle = document.getElementById("sidebarToggle");
var barre_info = document.getElementById("barre_info")
var footer = document.getElementById("footer")


fixed()
sidebarToggleTop.addEventListener('click', fixed,false);
sidebarToggle.addEventListener('click',fixed,false);
window.addEventListener('resize', fixed, false);

function fixed(){
    var hyp1 = accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 767px)").matches)
    var hyp2 = !accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 767px)").matches)
    var hyp3 = accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)
    var hyp4 = !accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(min-width: 768px)").matches)

    if(hyp1==true){
        fixed_page.style.paddingLeft='1.5rem'
        barre_info.style.marginLeft='0rem'
        footer.style.marginLeft='0rem'
    }
    else if(hyp2==true){
        fixed_page.style.paddingLeft='8rem'
        barre_info.style.marginLeft='6.5rem'
        footer.style.marginLeft='6.5rem'
    }
    else if(hyp3==true){
        fixed_page.style.paddingLeft='8rem'
        barre_info.style.marginLeft='6.5rem'
        footer.style.marginLeft='6.5rem'
    }
    else if(hyp4==true){
        fixed_page.style.paddingLeft='14rem'
        fixed_page.style.paddingRight='0rem'
        fixed_page.style.paddingTop='0rem'
        fixed_page.style.marginTop='4.5rem'
        barre_info.style.marginLeft='14rem'
        footer.style.marginLeft='14rem'
    }
}