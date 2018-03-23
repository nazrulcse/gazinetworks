@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agent Report (Bill collected from {{Carbon::parse($sdate)->format("d-m-Y")}} to {{Carbon::parse($edate)->format("d-m-Y")}})</h1>
@stop


@section('content')



    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">

                <div class="box-body">
                    <div class="text-center pull-right">
                        <form action="" method="get" accept-charset="utf-8" class='form-group' id='search_form'>
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>
                            <input type='hidden' name='sdate' class='form-control'/>
                            <input type='hidden' name='edate' class='form-control'/>
                        </form>
                    </div>

                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Agent Name</th>
                            <th>Bill Collected</th>
                            <th>Amount Collected</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($agents as $agent)
                            <tr>
                                <td>{{$agent->name}}</td>
                                <td>{{$payment->where('receiver_id', $agent->id)->count()}}</td>
                                <td>{{$payment->where('receiver_id', $agent->id)->sum('amount')}}</td>
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
    <script type="text/javascript">
        var date = new Date(), y = date.getFullYear(), m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);

        $('#reservation').daterangepicker({

            locale: {
                format: 'DD/MM/YYYY'
            },
            startDate: firstDay,
            endDate: lastDay
        });

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

        $(document).on('click','.applyBtn', function (e) {
            $('#agent-report').submit();
        });
    </script>
@stop
