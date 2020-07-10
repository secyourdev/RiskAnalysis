$.post("content/php/atelier2c/chart.php", function (data) {

    // var menace = [];
    // var exposition = [];
    // var taille_point = [];
    // var taille_point_hover = [];
    // var fiabilite = [];
    // var labels = [];

    var SROV = [];
    var pertinence = [];
    var choix = [];
    console.log(data);
    // for (var i in data['data_interne']) {
    //     menace.push(data['data_interne'][i].menace); //valeur de menace - pronfondeur en axe y
    //     exposition.push(data['data_interne'][i].exposition); //taille du points
    //     taille_point_hover.push((data['data_interne'][i].exposition) / 2 + 1); //taille du points en hover
    //     taille_point.push((data['data_interne'][i].exposition) / 2 + 2); //taille du points en hover
    //     fiabilite.push(data['data_interne'][i].fiabilite);
    // }
    // for (let i = 0; i < menace.length; i++) {
    //     labels.push('R' + i);
    // }

    for (var i in data['data_SROV']) {
        SROV.push(data['data_SROV'][i].SROV); //valeur de menace - pronfondeur en axe y
        pertinence.push(data['data_SROV'][i].pertinence); //taille du points
        choix.push(data['data_SROV'][i].choix); //taille du points en hover
    }
    // for (let i = 0; i < menace.length; i++) {
    //     labels.push('R' + i);
    // }
    console.log(SROV);
    console.log(pertinence);
    console.log(choix);
    

    var maxgravite = 4;

    var chartdata_srov = {
        labels: SROV,
        datasets: [
            {
                data: pertinence, //valeur de menace - pronfondeur en axe y
                // data_exposition: exposition, //taille du points
                data_choix: choix, //couleur points
                label: 'Sources de risque / Objectifs visés',
                responsive: true,
                backgroundColor: 'rgb(255, 99, 132)',
                fill: false,
                borderWidth: 0,
                pointRadius: 10,
                pointBackgroundColor: function (context) {
                    var index = context.dataIndex;
                    var value = context.dataset.data_choix[index];
                    var color_picker = ["#FF6565", "#4AD991", "#000000"];

                    if (value == "P1") {
                        return color_picker[0]
                    } 
                    if (value == "P2") {
                        return color_picker[1]
                    }
                    else {
                        return color_picker[2]
                    }

                },
                pointHoverRadius: 15,
                borderColor: 'rgb(255, 255, 255, 0)',
            }
        ]
    };

    var chartoption_srov = {
        scale: {
            gridLines: {
                circular: true,
                color: ['rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#FF6565", 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#4AD991", 'rgba(0, 0, 0, 0.1)', "#3B86FF"]
            },
            ticks: {
                beginAtZero: false,
                reverse: true,
                stepSize: 1,
                max: 4
            }
        },
        tooltips: {
            mode: 'index',
            callbacks: {
                footer: function (tooltipItems, data) {
                    var value_pertinence = 0;
                    // var value_menace = 0;
                    // var value_fiabilite = 0;
                    tooltipItems.forEach(function (tooltipItem) {
                        value_pertinence = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        // value_expo = data.datasets[tooltipItem.datasetIndex].data_exposition[tooltipItem.index];
                        // value_fiabilite = data.datasets[tooltipItem.datasetIndex].data_fiabilite[tooltipItem.index];
                    });
                    // return 'Menace: ' + value_menace + '\n' + 'Exposition: ' + value_expo + '\n' + 'Fiabilité cyber: ' + value_fiabilite;
                    return 'Pertinence: ' + value_pertinence;
                },
            },
            footerFontStyle: 'normal'
        },
        hover: {
            mode: 'index',
            intersect: true
        },
    };
 // CREATION DES CANVAS
 var graphTarget_srov = document.getElementById('myChart_srov').getContext('2d');
 

 chart_srov = new Chart(graphTarget_srov, {
     // The type of chart we want to create
     type: 'radar',

     // The data for our dataset
     data: chartdata_srov,

     // Configuration options go here
     options: chartoption_srov
 });


});


