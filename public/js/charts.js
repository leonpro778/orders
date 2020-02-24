// Get data from SQL
let chartData = null;

function getChartsData() {
    $.ajax({
        type: 'GET',
        url: 'charts/lastMonths',
        dataType: 'JSON',
        async: false,
        success: function(returnData) {
            chartData = returnData;
        },
    });
}

// Load the Visualization API and the piechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

getChartsData();
let chartDataArray = [];
chartData.forEach(el => {
    chartDataArray.push([el.month, {v: el.number, f: el.price}]);
})



// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Wartość');
    data.addColumn('number', 'Wartość');
    data.addRows(chartDataArray.reverse());

    // Set chart options
    var options = {'title':'Wydatki w ostatnich trzech miesiącach',
        'width':1000,
        'height':400,
        'legend': { position: 'none' }
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('googleChartDiv'));
    chart.draw(data, options);
}
