var options = {
    title: {
        text: 'Cartographie de menace numérique'
    },
    plotOptions: {
        radar: {
            polygons: {
                /*connectorColors: "black",*/
                strokeWidth: 0.5,
                /*strokeColors: ["#3B86FF","#3B86FF", "#FFEA83","#FFEA83", "#FF6565","#FF6565"],*/
                strokeColors: "#d4d4d4",
                fill: {
                    colors: ["#3B86FF", "#3B86FF", "#FFEA83", "#FFEA83", "#FF6565", "#FF6565"]
                }
            }
        }
    },
    yaxis: {
        tickAmount: 6,
        min: 0,
        max: 6,
        reversed: true,
        labels: {
            style: {
                colors: ['black'],
                fontSize: '15px',
                fontFamily: 'Helvetica, Arial, sans-serif',
                fontWeight: 700,
                cssClass: 'apexcharts-yaxis-label',
            },
            /*offsetX: 10,*/
            rotate: 90,
        }
    },
    xaxis: {
        categories: ["R1", "R2", "R3", "R4", "R5", "R6", "R7", "R8", "R9",],
        labels: {
            show: false,
        }
    },
    chart: {
        type: 'radar',
        animations: {
            enabled: true,
            easing: 'easeinout',
            speed: 800,
            animateGradually: {
                enabled: true,
                delay: 150
            },
            dynamicAnimation: {
                enabled: true,
                speed: 350
            }
        }
    },
    stroke: {
        show: false,
    },
    fill: {
        opacity: 0,
    },
    series: [{
        name: 'niveau de risque',
        data: [1, 5, 2, 2, 4, 3, 2, 4, 1]
    }],
    markers: {
        colors: 'red',
        strokeColor: 'black',
        discrete: [
            {
                seriesIndex: 0,
                dataPointIndex: 1,
                size: 7,
                fillColor: 'grey',
                strokeColor: '#000'
            },
            {
                seriesIndex: 0,
                dataPointIndex: 2,
                size: 5,
                fillColor: 'green',
                strokeColor: '#000'
            },
            {
                seriesIndex: 0,
                dataPointIndex: 3,
                size: 4,
                fillColor: 'blue',
                strokeColor: '#000'
            }, {
                seriesIndex: 0,
                dataPointIndex: 4,
                size: 7,
                fillColor: 'rgb(0, 143, 251)',
                strokeColor: '#000'
            },
            {
                seriesIndex: 0,
                dataPointIndex: 5,
                size: 6,
                fillColor: 'orange',
                strokeColor: '#000'
            },
        ]
    }


}

const chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();