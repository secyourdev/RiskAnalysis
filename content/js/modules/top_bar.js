var top_bar_1 = document.getElementById("top_bar_1");
var top_bar_2 = document.getElementById("top_bar_2");
var top_bar_3 = document.getElementById("top_bar_3");
var accordionSidebar = document.getElementById("accordionSidebar");
var sidebarToggleTop = document.getElementById("sidebarToggleTop")

var top_bar_name_2 = document.getElementsByClassName("top_bar_name_2");

var length_1 = top_bar_1.textContent.length; 
var length_2 = top_bar_2.textContent.length; 
var length_3 = top_bar_3.textContent.length; 
var sidebar_active;

/*----------------------------------- TRAITEMENT ---------------------------------------*/
redimensionnement()
sidebarToggleTop.addEventListener('click', redimensionnement,false);
window.addEventListener('resize', redimensionnement, false);




function redimensionnement(){
var hyp1 = length_3>40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 525px)").matches)&&(window.matchMedia("(min-width: 360px)").matches);
var hyp2 = length_3>40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 525px)").matches)&&(window.matchMedia("(min-width: 360px)").matches);
var hyp3 = length_3>40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 660px)").matches)&&(window.matchMedia("(min-width: 526px)").matches);
var hyp4 = length_3>40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 660px)").matches)&&(window.matchMedia("(min-width: 526px)").matches);

var hyp5 = length_3<=40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 615px)").matches)&&(window.matchMedia("(min-width: 360px)").matches);
var hyp6 = length_3<=40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 615px)").matches)&&(window.matchMedia("(min-width: 450px)").matches);
var hyp7 = length_3<=40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 660px)").matches)&&(window.matchMedia("(min-width: 616px)").matches);
var hyp8 = length_3<=40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 660px)").matches)&&(window.matchMedia("(min-width: 616px)").matches);

var hyp9 = (window.matchMedia("(max-width: 359px)").matches);
var hyp10 = (!accordionSidebar.classList.contains('toggled')&&window.matchMedia("(max-width: 450px)").matches);

var hyp11 = length_3<=40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 900px)").matches)&&(window.matchMedia("(min-width: 661px)").matches);
var hyp12 = length_3<=40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 900px)").matches)&&(window.matchMedia("(min-width: 661px)").matches);
var hyp13 = length_3>40&&accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 1100px)").matches)&&(window.matchMedia("(min-width: 661px)").matches);
var hyp14 = length_3>40&&!accordionSidebar.classList.contains('toggled')&&(window.matchMedia("(max-width: 1100px)").matches)&&(window.matchMedia("(min-width: 661px)").matches);

var hyp15 = (length_3<=40&&window.matchMedia("(min-width: 901px)").matches);
var hyp16 = (length_3>40&&window.matchMedia("(min-width: 1100px)").matches);

    if(hyp1==true)      top_bar("none","none","none")
    else if(hyp2==true) top_bar("none","none","none")
    else if (hyp3==true)top_bar("none","none","inline")
    else if(hyp4==true) top_bar("none","none","none")
    else if(hyp5==true) top_bar("none","none","inline")
    else if (hyp6==true)top_bar("none","none","inline")
    else if(hyp7==true) top_bar("inline","inline","inline")
    else if(hyp8==true) top_bar("none","none","inline")
    else if(hyp9==true) top_bar("none","none","none")
    else if(hyp10==true)top_bar("none","none","none")
    else if(hyp11==true)top_bar("inline","inline","inline")
    else if(hyp12==true)top_bar("none","none","inline")
    else if(hyp13==true)top_bar("none","none","inline")
    else if(hyp14==true)top_bar("none","none","inline")
    else if(hyp15==true)top_bar("inline","inline","inline")
    else if(hyp16==true)top_bar("inline","inline","inline")

    if(top_bar_1.offsetHeight>=41||top_bar_2.offsetHeight>=41||top_bar_3.offsetHeight>=41){
        top_bar("none","none","inline")
    }
}

function top_bar(value1,value2,value3){
    top_bar_1.style.display=value1
    top_bar_2.style.display=value2
    top_bar_3.style.display=value3
}

