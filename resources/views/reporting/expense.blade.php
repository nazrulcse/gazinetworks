@extends('adminlte::page')

@section('title', 'Reporting')

@section('content_header')
    <h1>
        Expense History
    </h1>
@stop


@section('content')

    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-body">
	                <form action="" method="get" accept-charset="utf-8" class='form-group' id='search_form'>
		                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
						    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
						    <span></span> <b class="caret"></b>
						</div>
		                <input type='hidden' name='sdate' class='form-control'/>
		                <input type='hidden' name='edate' class='form-control'/>
	                </form>
	              
	                <div id='income_graph' style="min-width: 310px; height: 400px; margin: 10px auto"></div>
	                <h3> Expense Details </h3>
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Voucher No</th>
                            <th>Received By</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense )
                            <tr>
                                <td>{{$expense->category}}</td>
                                <td>{{$expense->title}}</td>
                                <td>{{$expense->voucher_no}}</td>
                                <td>{{$expense->received_by}}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ date('d/m/Y', strtotime($expense->date))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script src='https://code.highcharts.com/highcharts.js'></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript">

    $(document).ready(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"}
        });

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

        var start = moment("{{ Carbon::parse($sdate)->format("Y-m-d") }}", "YYYY-MM-DD");
	    var end = moment("{{ Carbon::parse($edate)->format("Y-m-d") }}", "YYYY-MM-DD");

	    function cb(start, end) {
           $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

	    $('#reportrange').daterangepicker({
	        startDate: start,
	        endDate: end,
	        ranges: {
	           'Today': [moment(), moment()],
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }
	    }, cb).on('apply.daterangepicker', function(ev, picker) {
	    	var form = $('#search_form');
	    	form.find("input[name='sdate']").val(picker.startDate.format('YYYY-MM-DD'));
	    	form.find("input[name='edate']").val(picker.endDate.format('YYYY-MM-DD'));
	    	form.submit();
		});

	    cb(start, end);

	    Highcharts.chart('income_graph', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Expense From {{ Carbon::parse($sdate)->format("F j, Y") }} To {{ Carbon::parse($edate)->format("F j, Y") }}'
		    },
		    subtitle: {
		        text: 'Source: www.gazinetwork.one'
		    },
		    xAxis: {
		        categories: {!! $graph_label !!},
		        title: {
		            text: null
		        }
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Amount (Taka)',
		            align: 'high'
		        },
		        labels: {
		            overflow: 'justify'
		        }
		    },
		    tooltip: {
		        valueSuffix: ' Taka'
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
		        name: 'Expenses',
		        data: {{ $graph_data }}
		    }]
		   });

    });
</script>
@stop
