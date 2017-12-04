@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Invoice of {{$user->name}}</h1>
@stop

@section('content')
    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12" >


                        <div class="panel panel-info">

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
                                                <tr>

                                                    <td>Customer ID</td>
                                                    <td>{{$user->customer_id}}</td>
                                                </tr>
                                            <tr>

                                                    <td><h3>Invoice Month</h3></td>
                                                    <td><h3>{{$invoice->month.', '.$invoice->year}}</h3></td>
                                                </tr>
                                            <tr>

                                                    <td><h3>Invoice Amount</h3></td>
                                                    <td><h3>{{$user->customer_monthly_bill}}</h3></td>
                                                </tr>


                                            </tbody>
                                        </table>

                                        @if($invoice->status == 0 )
                                            <a class="" style="width: 40px">
                                                {{ Form::open(array('url' => '/payments?invoice='.$invoice->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                                {{ Form::hidden('_method', 'POST') }}
                                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-money"></i> Collect Bill</button>
                                                {{ Form::close() }}
                                            </a>
                                        @endif

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
