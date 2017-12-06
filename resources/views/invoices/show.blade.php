@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Invoice of {{$user->name}}</h1>
@stop

@section('content')
    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12" >


                        <div class="panel panel-info">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img src="{{asset($user->image)}}" class="img-circle img-responsive" style="height: 100px; width: 100px"> </div>

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                            <tr>
                                                <td>Email:</td>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td>{{$user->phone}}</td>
                                            </tr>


                                            <tr>
                                                <td>Address</td>
                                                <td>{{$user->address}}</td>
                                            </tr>
                                            <tr>

                                                <td>Customer ID</td>
                                                <td>{{$user->customer_id}}</td>
                                            </tr>
                                            <tr>

                                                <td><h4><b>Invoice Month</b></h4></td>
                                                <td><h4>{{$invoice->month.', '.$invoice->year}}</h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4><b>Invoice Amount</b></h4></td>
                                                <td id="invoice_amount"><h4>{{$user->customer_monthly_bill}}</h4></td>
                                            </tr>
                                            @if($invoice->is_paid == 0)
                                                <tr>
                                                    <td><h4><b>Paid</b></h4></td>
                                                    <td><h4>{{$invoice->payments->sum('amount')}}</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4><b>Due</b></h4></td>
                                                    <td id="invoice_due"><h4>{{$user->customer_monthly_bill - $invoice->payments->sum('amount')}}</h4></td>
                                                </tr>
                                            @else

                                                <tr>
                                                    <td style="color: green"><b>Full paid</b></td>
                                                    <td style="color: green"><i class="fa fa-check"></i></td>
                                                </tr>

                                            @endif


                                            </tbody>

                                        </table>

                                        @if($invoice->is_paid == 0 )
                                            <div class="col-md-12">
                                                {{ Form::open(array('url' => '/payments?invoice='.$invoice->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                                <div class="form-group">

                                                    {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                                                    {!! Form::text('amount', null, ['class' => 'form-control']) !!}

                                                    {!! Form::myCheckbox('full_pay','1','full_pay', '', 'Full Payment') !!}


                                                </div>

                                                <button type="submit" class="btn btn-primary"><i class="fa fa-money"></i> Collect Bill</button>
                                                {{ Form::close() }}
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">Payment History</h3>
                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-hover beaccount-table table-striped">
                            <thead>
                            <tr>

                                <th>Received By</th>
                                <th>Bill Period</th>
                                <th>Invoice Amount</th>
                                <th>Paid</th>
                                <th>Payment Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->payments as $payment)
                                <tr>
                                    <td>{{$payment->user->name}}</td>
                                    <td>{{$payment->invoice->month.', '.$payment->invoice->year}}</td>
                                    <td>{{$payment->invoice->invoice_amount}}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ date('d/m/Y', strtotime($payment->date))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@stop

@section('js')

    <script type="text/javascript">

        $(document).ready(function () {

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"}
            });

            document.getElementById('full_pay').onchange = function() {
                document.getElementById('amount').readOnly = this.checked;
                var amount = $("#invoice_due").text();
                document.getElementById('amount').value = amount;
            };

        });
    </script>
@stop