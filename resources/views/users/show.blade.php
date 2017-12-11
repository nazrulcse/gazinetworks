@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Profile of {{$user->name}}</h1>
@stop

@section('content')
    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12" >


                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$user->name}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> 
                                      <img src="{{asset($user->image ? $user->image : '/public/images/default.png')}}" class="img-circle img-responsive" style="width: 100px"/>
                                      @if ($user->customer_status)
                                        <div style='margin: 5px 0;'>
                                          <span class='label label-success'> Active </span>
                                        </div>
                                        <a class='btn btn-danger' href="/users/{{$user->id}}/change_status"> Click To Inctive </a>
                                      @else
                                        <div style='margin: 5px 0;'>
                                          <span class='label label-default'> Inactive </span>
                                        </div>
                                        <a class='btn btn-success' href="/users/{{$user->id}}/change_status"> Click To Active </a>
                                      @endif
                                    </div>

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information table-hover table-striped">
                                            <tbody>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone</b></td>
                                                <td>{{$user->phone}}</td>
                                            </tr>


                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{$user->address}}</td>
                                            </tr>
                                            @if (request()->has('agents'))
                                                <tr>
                                                    <td><b>Salary</b></td>
                                                    <td>{{$user->monthly_salary}}</td>

                                                </tr>                                                <tr>
                                                    <td><b>ID</b></td>
                                                    <td>{{$user->customer_id}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>Work Zone</b></td>
                                                    <td>{{$user->work_zone}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>NID</b></td>
                                                    <td>{{$user->nid}}</td>
                                                </tr>
                                                @else

                                                <tr>

                                                    <td><b>ID</b></td>
                                                    <td>{{$user->customer_id}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>Road</b></td>
                                                    <td>{{$user->customer_road}}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>House</b></td>
                                                    <td>{{$user->customer_house}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Flat</b></td>
                                                    <td>{{$user->customer_flat}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Number of TV</b></td>
                                                    <td>{{$user->customer_tv_count}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Monthly Bill</b></td>
                                                    <td>{{$user->customer_monthly_bill}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Discount</b></td>
                                                    <td>{{$user->customer_discount}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Connection Charge</b></td>
                                                    <td>{{$user->customer_connection_charge}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Connection Date</b></td>
                                                    <td>{{date('d/m/Y', strtotime($user->customer_connection_date))}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Zone</b></td>
                                                    <td>{{$user->customer_zone}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Free of charge</b></td>
                                                    <td>{{$user->customer_is_free == 1 ? 'Yes' : 'No'}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Set Top Box iv</b></td>
                                                    <td>{{$user->customer_set_top_box_iv == 1 ? 'Yes' : 'No'}}</td>
                                                </tr>
                                            @endif



                                            </tbody>
                                        </table>

                                       </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
