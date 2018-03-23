@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Invoice Report (Invoice generated from {{Carbon::parse($sdate)->format("d-m-Y")}} to {{Carbon::parse($edate)->format("d-m-Y")}})</h1>
@stop


@section('content')



    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">

                <div class="box-body">
                    <div class="text-center pull-right">
                        <form action="" method="get" accept-charset="utf-8" class='form-group' id='search_form'>
                            <div class="form-group">
                                <label for="sel1">Select Status:</label>
                                <select class="form-control" id="invoice-status" name="status">
                                    <option value="1" {{request()->has('status') && request('status') == '1' ? 'selected': ''}}>Paid</option>
                                    <option value="0" {{request()->has('status') && request('status') == '0' ? 'selected': ''}}>Unpaid</option>
                                </select>
                            </div>

                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>
                            <input type='hidden' name='sdate' class='form-control'/>
                            <input type='hidden' name='edate' class='form-control'/>
                        </form>
                    </div>
                    <div class='graph-body clearfix'>
                        <div class='col-lg-12 braph-bg' style='padding-top: 15px; padding-bottom: 15px;'>
                            <div class='col-lg-12' style='background: #ffffff;'>
                                <label>
                                    Unpaid <strong>({{$invoice_data['unpaid']}})</strong>
                                    <span class='pull-right'>
                      {{ $invoice_data['unpaid_per'] }}%
                     </span>
                                </label>
                                <div class="progress">
                                    <div data-percentage="0%" style="width: {{ $invoice_data['unpaid_per'] }}%;" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <label>
                                    Partialy Paid <strong> ({{$invoice_data['partial']}})</strong>
                                    <span class='pull-right'> {{ $invoice_data['partial_per'] }}% </span>
                                </label>
                                <div class="progress">
                                    <div data-percentage="0%" style="width: {{ $invoice_data['partial_per'] }}%;" class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <label>
                                    Paid <strong> ({{$invoice_data['paid']}})</strong>
                                    <span class='pull-right'> {{ $invoice_data['paid_per'] }}% </span>
                                </label>
                                <div class="progress">
                                    <div data-percentage="0%" style="width: {{ $invoice_data['paid_per'] }}%;" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2>
                        @if (request()->has('status'))
                            @if(request('status') == '1')
                                Paid Invoices
                            @else
                                Unpaid Invoices
                            @endif
                        @else
                            Due Invoices List
                        @endif

                    </h2>

                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Invoice of</th>
                            <th>Customer Id</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Bill Period</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$invoice->user['name']}}</td>
                                <td>{{$invoice->user['customer_id']}}</td>
                                <td>{{$invoice->user['customer_monthly_bill']}}</td>
                                <td>{{$invoice->is_paid == 1 ? 'Full' : ($invoice->payments->sum('amount')) }}</td>
                                <td>{{$invoice->is_paid == 1 ? 'None' : ($invoice->invoice_amount - $invoice->payments->sum('amount')) }}</td>
                                <td>{{$invoice->month.', '.$invoice->year}}</td>
                                <td>{{ date('d/m/Y', strtotime($invoice->created_at))}}</td>
                                @role(['admin','agent'])
                                <td class="text-right">

                                    <a class="btn btn-small btn-success action-btn" href="{{ URL::to('invoices/' . $invoice->id) }}">
                                        <i class="fa fa-money"></i>
                                    </a>

                                    <a class="btn btn-small btn-info action-btn" href="{{ URL::to('invoices/' . $invoice->id . '/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endrole

                                    @role('admin')

                                    <a class="" style="width: 40px">
                                        {{ Form::open(array('url' => 'invoices/' . $invoice->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        <button type="submit" class="btn btn-small btn-danger action-btn"><i class="fa fa-remove"></i></button>
                                        {{ Form::close() }}
                                    </a>
                                    @endrole

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">{{ $invoices->appends(request()->query())->links() }}</div>
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

        $('#invoice-status').select2();
    </script>
@stop
