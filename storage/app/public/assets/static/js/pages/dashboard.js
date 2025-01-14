var optionsChart = {
    annotations: {
        position: "back",
    },
    dataLabels: {
        enabled: false,
    },
    chart: {
        type: "bar",
        height: 300,
    },
    fill: {
        opacity: 1,
    },
    plotOptions: {},
    series: [
        {
            name: "sales",
            data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
        },
    ],
    colors: "#435ebe",
    xaxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
    },
}

var chartSales = new ApexCharts(
    document.querySelector("#chart-sales"),
    optionsChart
)
var chartProduction = new ApexCharts(
    document.querySelector("#chart-production"),
    optionsChart
)

chartSales.render()
chartProduction.render()
