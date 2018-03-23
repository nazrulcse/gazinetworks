@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Customer Report</h1>
@stop


@section('content')



    <section class="contentxx">
        <div class="row">
            @include('flash::message')

            <div class="box">

                <div class="col-md-4">
                    <div class="customer-card">
                        <img src="{{asset('public/images/active.png')}}" alt="Avatar" style="width:100%">
                        <div class="customer-card-container">
                            <h2><b>Active Users - {{ $active }}</b></h2>
                            <p><a class="btn btn-primary" href="{!! url('/users?customers&active'); !!}">View All</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="customer-card">
                        <img src="{{asset('public/images/inactive.png')}}" alt="Avatar" style="width:100%">
                        <div class="customer-card-container">
                            <h2><b>Inctive Users - {{ $inactive }}</b></h2>
                            <p><a class="btn btn-primary" href="{!! url('/users?customers&inactive'); !!}">View All</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="customer-card">
                        <img src="{{asset('public/images/free.png')}}" alt="Avatar" style="width:100%">
                        <div class="customer-card-container">
                            <h2><b>Free Users - {{ $free }}</b></h2>
                            <p><a class="btn btn-primary" href="{!! url('/users?customers&free'); !!}">View All</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop




@section('js')

@stop
