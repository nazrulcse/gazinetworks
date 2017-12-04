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
                                            @if (request()->has('agents'))
                                                <tr>
                                                    <td>Salary</td>
                                                    <td>{{$user->monthly_salary}}</td>

                                                </tr>                                                <tr>
                                                    <td>Agent ID</td>
                                                    <td>{{$user->customer_id}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Work Zone</td>
                                                    <td>{{$user->work_zone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>NID</td>
                                                    <td>{{$user->nid}}</td>
                                                </tr>
                                                @else

                                                <tr>

                                                    <td>Customer ID</td>
                                                    <td>{{$user->customer_id}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Road</td>
                                                    <td>{{$user->customer_road}}</td>
                                                </tr>

                                                <tr>
                                                    <td>House</td>
                                                    <td>{{$user->customer_house}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Flat</td>
                                                    <td>{{$user->customer_flat}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Number of TV</td>
                                                    <td>{{$user->customer_tv_count}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Monthly Bill</td>
                                                    <td>{{$user->customer_monthly_bill}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Discount</td>
                                                    <td>{{$user->customer_discount}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Connection Charge</td>
                                                    <td>{{$user->customer_connection_charge}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Zone</td>
                                                    <td>{{$user->customer_zone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Free of charge</td>
                                                    <td>{{$user->customer_is_free == 1 ? 'Yes' : 'No'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Set Top Box iv</td>
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
