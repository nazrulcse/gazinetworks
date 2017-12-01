@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        @if (request()->has('paid'))
            Paid Invoices
        @elseif (request()->has('due'))
            Due Invoices
        @else
            All Invoices
        @endif

    </h1>
@stop


@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('flash::message')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">

                            @if (request()->has('paid'))
                                Paid Invoice List
                            @elseif (request()->has('due'))
                                Due Invoice List
                            @else
                                All Invoice List
                            @endif

                        </h3>
                    </div>
                    {{--                    @if(request()->has('agents'))
                                            <a class="btn btn-lg btn-primary create-btn" href="{{ URL::to('users/create?is_agent') }}">
                                                Create Agent
                                            </a>
                                        @else
                                            <a class="btn btn-lg btn-primary create-btn" href="{{ URL::to('users/create?is_customer') }}">
                                                Create Customer
                                            </a>
                                        @endif--}}

                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Invoice of</th>
                                <th>Customer Id</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->user->name}}</td>
                                    <td>{{$invoice->user->customer_id}}</td>
                                    <td>{{$invoice->user->customer_monthly_bill}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td>{{$invoice->month}}</td>
                                    <td>{{$invoice->year}}</td>
                                    <td>

                                            <a class="btn btn-small btn-info action-btn" href="{{ URL::to('invoices/' . $invoice->id . '/edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                        <a class="" style="width: 40px">
                                            {{ Form::open(array('url' => 'invoices/' . $invoice->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button type="submit" class="btn btn-small btn-danger action-btn"><i class="fa fa-remove"></i></button>
                                            {{ Form::close() }}
                                        </a>

                                        @if($invoice->status == 0 )
                                        <a class="" style="width: 40px">
                                            {{ Form::open(array('url' => '/payments?invoice='.$invoice->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'POST') }}
                                            <button type="submit" class="btn btn-small btn-success action-btn"><i class="fa fa-money"></i></button>
                                            {{ Form::close() }}
                                        </a>
                                        @endif

                                        {{--                       <a class="btn btn-small btn-danger" href="{{URL::to('users/'. $user->id)}}" onclick="return check_delete();">
                                                                   <i class="fa fa-remove"></i>
                                                               </a>--}}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
