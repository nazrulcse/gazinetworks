@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        Other Income Invoices List

    </h1>
@stop


@section('content')

    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">

                <div class="box-body">
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Bill Period</th>
                            <th>Creation Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$invoice->other_invoice_title}}</td>
                                <td>{{$invoice->invoice_amount}}</td>
                                <td>{{$invoice->is_paid == 1 ? 'Full' : ($invoice->payments->sum('amount')) }}</td>
                                <td>{{$invoice->is_paid == 1 ? 'None' : ($invoice->invoice_amount - $invoice->payments->sum('amount')) }}</td>
                                <td>{{$invoice->date.' '.$invoice->month.', '.$invoice->year}}</td>
                                <td>{{ date('d/m/Y', strtotime($invoice->created_at))}}</td>
                                @role(['admin','agent'])
                                <td class="text-right">

                                    <a class="btn btn-small btn-success action-btn" href="{{ URL::to('invoices/' . $invoice->id.'?other') }}">
                                        <i class="fa fa-money"></i>
                                    </a>

                                    <a class="btn btn-small btn-info action-btn" href="{{ URL::to('invoices/' . $invoice->id . '/edit?other') }}">
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

    {{--<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>--}}

@stop

@section('js')

    <script type="text/javascript">

        /*        $(document).ready(function () {
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

                });*/
    </script>

@stop