var content = localStorage.tab;

console.log(content);
var elem = document.createElement('div');
elem.setAttribute("id","div");
elem.innerHTML = content;
console.log(elem);

//document.getElementById("#ghost").innerHTML = "element.value";
//var appended = document.createElement('new').appendChild(element);
// domtoimage.toBlob(elem)
//     .then(function (blob) {
//         window.saveAs(blob, 'my-node.png');
//     });

// domtoimage.toPng(elem)
//     .then(function (dataUrl) {
//         var img = new Image();
//         img.src = dataUrl;
//         document.body.appendChild(img);
//     })
//     .catch(function (error) {
//         console.error('oops, something went wrong!', error);
//     });

domtoimage.toJpeg(elem, { quality: 0.95 })
    .then(function (dataUrl) {
        var link = document.createElement('a');
        link.download = 'img.jpg';
        link.href = dataUrl;
        link.click();
    });

// function filter (elem) {
//     //return (elem.tagName !== 'i');
// }
//
// domtoimage.toSvg(elem, {filter: filter})
//     .then(function (dataUrl) {
//         /* do something */
//         var link = document.createElement('a');
//         link.download = 'my-image-name.svg';
//         link.href = dataUrl;
//         link.click();
//     });
