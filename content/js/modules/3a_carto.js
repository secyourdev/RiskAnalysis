
    console.log( '3a_carto.js');

$.post("content/php/atelier3a/chart.php", function (data) {

    var seuil_danger = [];
    var seuil_controle = [];
    var seuil_veille = [];
    console.log(data);
    for (var i in data['data_seuil']) {
        seuil_danger.push(data['data_seuil'][i].seuil_danger); //valeur de seuil_danger - zone rouge
        seuil_controle.push(data['data_seuil'][i].seuil_controle); //valeur de seuil_danger - zone verte
        seuil_veille.push(data['data_seuil'][i].seuil_veille); //valeur de seuil_danger - zone bleue
    }
    console.log('seuil : ');
    console.log(seuil_danger);
    console.log(seuil_controle);
    console.log(seuil_veille);
    
    color_zone = ['rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)']
    if (seuil_danger[0] !== -1) {
        color_zone[16-seuil_danger[0]] = "#FF6565";
    }
    if (seuil_controle[0] !== -1) {
        color_zone[16-seuil_controle[0]] = "#4AD991";
    }
    if (seuil_veille[0] !== -1) {
        color_zone[16-seuil_veille[0]] = "#3B86FF";
    }
    console.log(color_zone);
    // color_actuel = ['rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#FF6565", 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#4AD991", 'rgba(0, 0, 0, 0.1)', "#3B86FF"]
    // console.log(color_actuel);
    
    
    var menace = [];
    var exposition = [];
    var taille_point = [];
    var taille_point_hover = [];
    var fiabilite = [];
    var labels = [];
    // var nom_partie_prenante = [];
    console.log(data);
    for (var i in data['data_interne']) {
        menace.push(data['data_interne'][i].menace); //valeur de menace - pronfondeur en axe y
        exposition.push(data['data_interne'][i].exposition); //taille du points
        taille_point_hover.push((data['data_interne'][i].exposition) / 2 + 1); //taille du points en hover
        taille_point.push((data['data_interne'][i].exposition) / 2 + 2); //taille du points en hover
        fiabilite.push(data['data_interne'][i].fiabilite);
        labels.push(data['data_interne'][i].nom_partie_prenante)
    }
    // for (let i = 0; i < menace.length; i++) {
    //     labels.push('R' + i);
    // }

    console.log('interne : ');
    console.log(menace);
    // console.log(exposition);
    // console.log(taille_point_hover);
    // console.log(taille_point);
    // console.log(fiabilite);

    var maxmenace = Math.max(...menace) + 0.5;
    console.log("maxmenace : ");
    console.log(maxmenace);
    
    

    var chartdata_interne = {
        labels: labels,
        datasets: [
            {
                data: menace, //valeur de menace - pronfondeur en axe y
                data_exposition: exposition, //taille du points
                data_fiabilite: fiabilite, //couleur points
                label: 'My First dataset',
                responsive: true,
                backgroundColor: 'rgb(255, 99, 132)',
                fill: false,
                borderWidth: 0,
                pointRadius: taille_point,
                pointBackgroundColor: function (context) {
                    var index = context.dataIndex;
                    var value = context.dataset.data_fiabilite[index];
                    var color_picker = ["#FF6565", "#FFEA83", "#4AD991", "#3B86FF"];

                    if (value < 4) {
                        return color_picker[0]
                    } else if (value >= 4 && value <= 5) {
                        return color_picker[1]
                    } else if (value >= 6 && value <= 7) {
                        return color_picker[2]
                    } else if (value > 7) {
                        return color_picker[3]
                    }

                },
                pointHoverRadius: taille_point_hover,
                borderColor: 'rgb(255, 255, 255, 0)',
            }
        ]
    };

    var chartoption_interne = {
        scale: {
            gridLines: {
                circular: true,
                color: color_zone
            },
            ticks: {
                beginAtZero: true,
                reverse: true,
                suggestedMax: 16.5,
                stepSize: 1
            }
        },
        tooltips: {
            mode: 'index',
            callbacks: {
                footer: function (tooltipItems, data) {
                    var value_expo = 0;
                    var value_menace = 0;
                    var value_fiabilite = 0;
                    tooltipItems.forEach(function (tooltipItem) {
                        value_menace = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        value_expo = data.datasets[tooltipItem.datasetIndex].data_exposition[tooltipItem.index];
                        value_fiabilite = data.datasets[tooltipItem.datasetIndex].data_fiabilite[tooltipItem.index];
                    });
                    return 'Menace: ' + value_menace + '\n' + 'Exposition: ' + value_expo + '\n' + 'Fiabilité cyber: ' + value_fiabilite;
                },
            },
            footerFontStyle: 'normal'
        },
        hover: {
            mode: 'index',
            intersect: true
        },
    };

    // $.post("content/php/atelier3a/chart_externe.php", function (data) {

    var menace = [];
    var exposition = [];
    var taille_point = [];
    var taille_point_hover = [];
    var fiabilite = [];
    var labels = [];
    for (var i in data['data_externe']) {
        menace.push(data['data_externe'][i].menace); //valeur de menace - pronfondeur en axe y
        exposition.push(data['data_externe'][i].exposition); //taille du points
        taille_point_hover.push((data['data_externe'][i].exposition) / 2 + 1); //taille du points en hover
        taille_point.push((data['data_externe'][i].exposition) / 2 + 2); //taille du points en hover
        fiabilite.push(data['data_externe'][i].fiabilite);
        labels.push(data['data_externe'][i].nom_partie_prenante)
    }
    // for (let i = 0; i < menace.length; i++) {
    //     labels.push('R' + i);
    // }

    console.log('externe : ');
    console.log(menace);
    // console.log(exposition);
    // console.log(taille_point_hover);
    // console.log(taille_point);
    // console.log(fiabilite);

    var maxmenace = Math.max(...menace) + 0.5;
    console.log("maxmenace : ");
    console.log(maxmenace);
    

    var chartdata_externe = {
        labels: labels,
        datasets: [
            {
                data: menace, //valeur de menace - pronfondeur en axe y
                data_exposition: exposition, //taille du points
                data_fiabilite: fiabilite, //couleur points
                label: 'My First dataset',
                responsive: true,
                backgroundColor: 'rgb(255, 99, 132)',
                fill: false,
                borderWidth: 0,
                pointRadius: taille_point,
                pointBackgroundColor: function (context) {
                    var index = context.dataIndex;
                    var value = context.dataset.data_fiabilite[index];
                    var color_picker = ["#FF6565", "#FFEA83", "#4AD991", "#3B86FF"];

                    if (value < 4) {
                        return color_picker[0]
                    } else if (value >= 4 && value <= 5) {
                        return color_picker[1]
                    } else if (value >= 6 && value <= 7) {
                        return color_picker[2]
                    } else if (value > 7) {
                        return color_picker[3]
                    }

                },
                pointHoverRadius: taille_point_hover,
                borderColor: 'rgb(255, 255, 255, 0)',
            }
        ]
    };
    var chartoption_externe = {
        scale: {
            gridLines: {
                circular: true,
                color: color_zone
            },
            ticks: {
                beginAtZero: true,
                reverse: true,
                suggestedMax: 16.5,
                stepSize: 1
            }
        },
        tooltips: {
            mode: 'index',
            callbacks: {
                footer: function (tooltipItems, data) {
                    var value_expo = 0;
                    var value_menace = 0;
                    var value_fiabilite = 0;
                    tooltipItems.forEach(function (tooltipItem) {
                        value_menace = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        value_expo = data.datasets[tooltipItem.datasetIndex].data_exposition[tooltipItem.index];
                        value_fiabilite = data.datasets[tooltipItem.datasetIndex].data_fiabilite[tooltipItem.index];
                    });
                    return 'Menace: ' + value_menace + '\n' + 'Exposition: ' + value_expo + '\n' + 'Fiabilité cyber: ' + value_fiabilite;
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
    var graphTarget_interne = document.getElementById('myChart_interne').getContext('2d');
    var graphTarget_externe = document.getElementById('myChart_externe').getContext('2d');

    chart_interne = new Chart(graphTarget_interne, {
        // The type of chart we want to create
        type: 'radar',

        // The data for our dataset
        data: chartdata_interne,

        // Configuration options go here
        options: chartoption_interne
    });

    chart_externe = new Chart(graphTarget_externe, {
        // The type of chart we want to create
        type: 'radar',

        // The data for our dataset
        data: chartdata_externe,

        // Configuration options go here
        options: chartoption_externe
    });
    // });

});
