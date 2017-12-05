@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        All Complains

    </h1>
@stop


@section('content')

    <section class="contentxx">
        <div class="row">
                @include('flash::message')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            Complain List
                        </h3>
                    </div>

                    <div class="box-body">
                        <table id="example2" class="table table-hover beaccount-table table-striped">
                            <thead>
                            <tr>
                                <th>Complain By</th>
                                <th>Customer Id</th>
                                <th>Subject</th>
                                <th>Category</th>
                                <th>Message</th>
                                <th>Complain Date</th>
                                @role('admin')
                                <th>Actions</th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($complains as $complain )
                                <tr>
                                    <td>{{$complain->user->name}}</td>
                                    <td>{{$complain->user->customer_id}}</td>
                                    <td>{{$complain->subject}}</td>
                                    <td>{{$complain->category}}</td>
                                    <td>{{$complain->message}}</td>
                                    <td>{{ date('d/m/Y', strtotime($complain->created_at))}}</td>
                                    @role('admin')
                                    <td class="text-right">
                                        <a class="" style="width: 40px">
                                            {{ Form::open(array('url' => 'complains/' . $complain->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
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
