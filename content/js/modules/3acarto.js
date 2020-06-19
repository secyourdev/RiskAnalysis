$(document).ready(function () {
    showGraph();
});
function showGraph() {
    {
        $.post("data.php",
            function (data) {
                console.log(data);
                var name = [];
                var marks = [];

                for (var i in data) {
                    name.push(data[i].student_name);
                    marks.push(data[i].marks);
                }

                var chartdata = {
                    labels: name,
                    datasets: [
                        {
                            label: 'Student Marks',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }
                    ]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
    }
}




var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'radar',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            data: [0, 10, 5, 2, 20, 30, 45], //valeur de menace - pronfondeur en axe y
            data_exposition: [1, 5, 4, 2, 3, 6, 4], //taille du points
            data_fiabilite: [9, 8, 7, 6, 5, 4, 3], //couleur points
            label: 'My First dataset',
            responsive: true,
            backgroundColor: 'rgb(255, 99, 132)',
            fill: false,
            borderWidth: 0,
            pointRadius: function (context) {
                var index = context.dataIndex;
                var value = 2 * context.dataset.data_exposition[index];
                return value;
            },
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
            pointHoverRadius: 7,
            borderColor: 'rgb(255, 255, 255, 0)',
        }]
    },

    // Configuration options go here
    options: {
        scale: {
            gridLines: {
                circular: true,
                color: ['rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#FF6565", 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#4AD991", 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', "#3B86FF"]
            },
            ticks: {
                beginAtZero: true,
                reverse: true
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
    }
});
// var color = Chart.helpers.color;
// chartColors = {
//     red: 'rgb(255, 99, 132)',
//     orange: 'rgb(255, 159, 64)',
//     green: 'rgb(75, 192, 192)',
//     yellow: 'rgb(255, 205, 86)',
//     blue: 'rgb(54, 162, 235)',
//     purple: 'rgb(153, 102, 255)',
//     grey: 'rgb(201, 203, 207)'
// };

// var colorNames = Object.keys(chartColors);
// document.getElementById('addDataset').addEventListener('click', function () {
//     var colorName = colorNames[chart.data.datasets.length % colorNames.length];
//     var newColor = chartColors[colorName];

//     var newDataset = {
//         label: 'Dataset ' + chart.data.datasets.length,
//         borderColor: newColor,
//         backgroundColor: color(newColor).alpha(0.2).rgbString(),
//         pointBackgroundColor: newColor,
//         data: [],
//         data_exposition_taille: [],


//         responsive: true,
//         backgroundColor: newColor,
//         fill: false,
//         borderWidth: 0,
//         pointRadius: 4,
//         pointBackgroundColor: newColor,
//         pointRadius: function (context) {
//             var index = context.dataIndex;
//             var value = context.dataset.data_exposition_taille[index];
//             return value;
//         },
//         borderColor: 'rgb(255, 255, 255, 0)',
//     };

//     for (var index = 0; index < chart.data.labels.length; {
//         newDataset.data.push(20);
//         newDataset.data_exposition_taille.push(8);
//     }

//     chart.data.datasets.push(newDataset);
//     chart.update();
// });

// document.getElementById('addData').addEventListener('click', function () {
//     if (chart.data.datasets.length > 0) {
//         chart.data.labels.push('dataset #' + chart.data.labels.length);

//         chart.data.datasets.forEach(function (dataset) {
//             dataset.data.push(20);
//         });

//         chart.update();
//     }
// });

// document.getElementById('removeDataset').addEventListener('click', function () {
//     chart.data.datasets.pop();
//     chart.update();
// });

// document.getElementById('removeData').addEventListener('click', function () {
//     chart.data.labels.pop(); // remove the label first

//     chart.data.datasets.forEach(function (dataset) {
//         dataset.data.pop();
//     });

//     chart.update();
// });
