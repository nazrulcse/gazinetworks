@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        All Expenses
        <a class='pull-right btn btn-default' href='/expenses/create'> 
         <i class='fa fa-plus'></i> New Expense 
        </a>
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
                            <th>Date</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Voucher No</th>
                            <th>Received By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense )
                            <tr>
                                <td>{{$expense->date}}</td>
                                <td>{{$expense->category}}</td>
                                <td>{{$expense->title}}</td>
                                <td>{{$expense->description}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->voucher_no}}</td>
                                <td>{{ $expense->received_by }}</td>
                                @role('admin')
                                  <td class="text-right">
                                     <a class="btn btn-small btn-warning action-btn" href="/expenses/{{ $expense->id }}/edit">
                                         <i class="fa fa-pencil-square-o"></i>
                                     </a>

                                     <a style="width: 40px">
                                         {{ Form::open(array('url' => 'expenses/' . $expense->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-small btn-danger action-btn">
                                                  <i class="fa fa-remove"></i>
                                                </button>
                                            {{ Form::close() }}
                                      </a>                                      
                                  </td>
                                @endrole
                                @role('agent')
                                  <td>
                                     <a class="btn btn-small btn-warning action-btn" href="/expenses/{{ $expense->id }}/edit">
                                         <i class="fa fa-pencil-square-o"></i>
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

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

    });
</script>
@stop
