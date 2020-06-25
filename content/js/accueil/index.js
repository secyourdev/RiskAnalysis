sleep(100).then(() => {
//document.getElementById('id_projet0').disabled=true
//document.getElementById('id_projet0').style.display="none"
})

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}