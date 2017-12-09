@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class='row'>
    <div class='box'>
      <div class='body-box box-body'>
      <div class='row'>
       <div class='col-lg-12'>
         <div class='col-sm-6'>
             <div id='newconnection' style="min-width: 310px; height: 400px; margin: 10px auto"></div>
         </div>
         <div class='col-sm-6'>
             <div id='complain' style="min-width: 310px; height: 400px; margin: 10px auto"></div>
         </div>
       </div>
      </div>
       <hr/>
       <div id="container" style="min-width: 310px; height: 400px; margin: 10px auto"></div>
       <hr/>
       <div id="incomevsexpense" style="min-width: 310px; height: 400px; margin: 10px auto"></div>
      </div>
    </div>
 </div>
@stop

@section('custom_js')
<script src='https://code.highcharts.com/highcharts.js'></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script type='text/javascript'>
  $(function() {
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Invoice vs Payment'
    },
    subtitle: {
        text: 'Source: www.gazinetwork.one'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (Taka)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Taka</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
      },
      series: [{
          name: 'Invoice',
          data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }, {
            name: 'Payment',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }
     ]
    });
    
    // Expense Vs Income

    Highcharts.chart('incomevsexpense', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Income Vs Expense'
    },
    subtitle: {
        text: 'Source: www.gazinetwork.one'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Amount (Taka)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Income',
        data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
    }, {
        name: 'Expense',
        data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }]
   });

   // New Connection
   Highcharts.chart('newconnection', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly New Connection'
    },
    subtitle: {
        text: 'Source: www.gazinetwork.one'
    },
    xAxis: {
        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Connection (number)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' number'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'horizontal',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'New Connection',
        data: {{ $dashboard['connection'] }}
    }]
   });
   // Complain Graph
   Highcharts.chart('complain', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Complain By Customer'
    },
    subtitle: {
        text: 'Source: www.gazinetwork.one'
    },
    xAxis: {
        categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Complain (number)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' number'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'horizontal',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Complain',
        data: {{ $dashboard['complain'] }}
    }]
   });
  });
</script>
@stop