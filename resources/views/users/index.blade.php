@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ request()->has('agents')? "Agents" : "Customers" }}</h1>
@stop


@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('flash::message')

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{request()->has('agents')? "Agent List" : "Customer List"  }}</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Address</th>
                                @if(request()->has('agents'))
                                    <th>Work Zone</th>
                                    <th>NID</th>
                                    <th>Monthly Salary</th>
                                @else
                                    <th>Customer ID</th>
                                    <th>Road</th>
                                    <th>House</th>
                                    <th>Flat</th>
                                    <th>Total TV</th>
                                    <th>Monthly Bill</th>
                                    <th>Discount</th>
                                    <th>Connection Charge</th>
                                    <th>Charge Free?</th>
                                    <th>Set-Top Box iv?</th>
                                    <th>Status?</th>
                                    <th>Zone</th>
                                @endif
                                <th>Actions</th>
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
                                    @else
                                        <td>{{$user->customer_id}}</td>
                                        <td>{{$user->customer_road}}</td>
                                        <td>{{$user->customer_house}}</td>
                                        <td>{{$user->customer_flat}}</td>
                                        <td>{{$user->customer_tv_count}}</td>
                                        <td>{{$user->customer_monthly_bill}}</td>
                                        <td>{{$user->customer_discount}}</td>
                                        <td>{{$user->customer_connection_charge}}</td>
                                        <td>{{$user->customer_is_free}}</td>
                                        <td>{{$user->customer_set_top_box_iv}}</td>
                                        <td>{{$user->customer_status}}</td>
                                        <td>{{$user->customer_zone}}</td>
                                    @endif
                                    <td>
                                        {{--                                        <a class="btn btn-small btn-success action-btn" href="{{ URL::to('users/' . $user->id) }}">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>--}}
                                        @if(request()->has('agents'))
                                            <a class="btn btn-small btn-info action-btn" href="{{ URL::to('users/' . $user->id . '/edit?agents') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-small btn-info action-btn" href="{{ URL::to('users/' . $user->id . '/edit?customers') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                        <a class="" style="width: 40px">
                                            {{ Form::open(array('url' => 'users/' . $user->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button type="submit" class="btn btn-small btn-danger action-btn"><i class="fa fa-remove"></i></button>
                                            {{ Form::close() }}
                                        </a>

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
            "scrollX": '100%',
            "autoWidth": false,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"}
        });

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

    });
</script>
