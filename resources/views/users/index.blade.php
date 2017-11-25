@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User list</h3>
                </div>
                <a class="btn btn-lg btn-primary" href="{{ URL::to('users/create') }}">
                    Create User
                </a>                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Image</th>
                            <th>Work Zone</th>
                            <th>NID</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Monthly Salary</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->image}}</td>
                                <td>{{$user->work_zone}}</td>
                                <td>{{$user->nid}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->monthly_salary}}</td>
                                <td>
                                    <a class="btn btn-small btn-success" href="{{ URL::to('users/' . $user->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-small btn-info" href="{{ URL::to('users/' . $user->id . '/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{ Form::open(array('url' => 'users/' . $user->id)) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-remove"></i></button>
                                    {{ Form::close() }}

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
    });
</script>
