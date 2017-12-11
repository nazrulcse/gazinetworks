@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Search Result</h1>
@stop


@section('content')



    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">



                    @include ('users._search_cusomer')

               

                <div class="box-body">
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Image</th>
                            <th>Address</th>
                            @if(request()->has('agents'))
                                <th>Zone</th>
                                <th>NID</th>
                                <th>Salary</th>
                                <th>ID</th>
                            @else
                                <th>ID</th>
                                <th>TV</th>
                                <th>Bill</th>
                            @endif
                            @role('admin')
                            <th>Actions</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td><img src="{{$user->image}}" style="height: 50px; width: 50px"></td>
                                <td>{{$user->address}}</td>
                                @if(request()->has('agents'))
                                    <td>{{$user->work_zone}}</td>
                                    <td>{{$user->nid}}</td>
                                    <td>{{$user->monthly_salary}}</td>
                                    <td>{{$user->customer_id}}</td>
                                @else
                                    <td>{{$user->customer_id}}</td>
                                    <td>{{$user->customer_tv_count}}</td>
                                    <td>{{$user->customer_monthly_bill}}</td>
                                @endif

                                <td class="text-right">
                                    @if(request()->has('agents'))
                                        <a class="btn btn-small btn-success action-btn" href="{{ URL::to('users/' . $user->id . '?agents') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-small btn-success action-btn" href="{{ URL::to('users/' . $user->id . '?customers') }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endif
                                    @if(request()->has('agents'))
                                        <a class="btn btn-small btn-info action-btn" href="{{ URL::to('users/' . $user->id . '/edit?agents') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-small btn-info action-btn" href="{{ URL::to('users/' . $user->id . '/edit?customers') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @role('admin')
                                    <a class="" style="width: 40px">
                                        {{ Form::open(array('url' => 'users/' . $user->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        <button type="submit" class="btn btn-small btn-danger action-btn"><i class="fa fa-remove"></i></button>
                                        {{ Form::close() }}
                                    </a>
                                    @endrole

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
    </section>

    {{--<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>--}}

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
                "scrollX": '100%',
                "autoWidth": false,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"}
            });

            $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

        });
    </script>
@stop
