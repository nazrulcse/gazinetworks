@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        All Payments

    </h1>
@stop


@section('content')

    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-header">

                </div>

                <div class="box-body">
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Payment Of</th>
                            <th>Customer Id</th>
                            <th>Received By</th>
                            <th>Bill Period</th>
                            <th>Invoice Amount</th>
                            <th>Paid</th>
                            <th>Payment Date</th>
                            @role('admin')
                            <th>Actions</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment )
                            <tr>
                                <td>{{$payment->invoice->user->name}}</td>
                                <td>{{$payment->invoice->user->customer_id}}</td>
                                <td>{{$payment->user->name}}</td>
                                <td>{{$payment->invoice->month.', '.$payment->invoice->year}}</td>
                                <td>{{$payment->invoice->invoice_amount}}</td>
                                <td>{{ $payment->amount }}</td>
                                    <td>{{ date('d/m/Y', strtotime($payment->date))}}</td>
                                    @role('admin')
                                    <td class="text-right">
                                        <a class="" style="width: 40px">
                                            {{ Form::open(array('url' => 'payments/' . $payment->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button type="submit" class="btn btn-small btn-danger action-btn"><i class="fa fa-remove"></i></button>
                                            {{ Form::close() }}
                                        </a>

                                    </td>
                                    @endrole
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{--<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>--}}

@stop

<script src="//code.jquery.com/jquery-1.12.4.js"></script>

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

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

    });
</script>
