@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create {{ request()->has('is_agent')? "Agent" : "Customer" }}</h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ request()->has('is_agent')? "Agent" : "Customer" }} Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => '/users','enctype'=>'multipart/form-data']) !!}
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone:', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    @if ($flag= request()->has('is_agent'))

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('work_zone', 'Work Zone:', ['class' => 'control-label']) !!}
                                {!! Form::text('work_zone', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('nid', 'NID:', ['class' => 'control-label']) !!}
                                {!! Form::text('nid', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('monthly_salary', 'Monthly Salary:', ['class' => 'control-label']) !!}
                                {!! Form::text('monthly_salary', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    @else
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_id', 'Customer Id:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_id', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_road', 'Road:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_road', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_house', 'House:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_house', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_flat', 'Flat:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_flat', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_tv_count', 'Number of TV:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_tv_count', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_monthly_bill', 'Monthly Bill:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_monthly_bill', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_discount', 'Discount:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_discount', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_connection_charge', 'Connection Charge:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_connection_charge', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_zone', 'Zone:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_zone', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('', 'Additional Info:', ['class' => 'control-label']) !!}</br>
                                {!! Form::myCheckbox('customer_is_free','1','is_free', '', 'Free of charge') !!}
                                {!! Form::myCheckbox('customer_set_top_box_iv','1','set_top_box_iv', '', 'Set-Top Box iv') !!}
                                {!! Form::myCheckbox('customer_status','1','status', '', 'Status') !!}
                            </div>
                        </div>

                    @endif


                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
                            {!! Form::text('password', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('c_password', 'Confirm Password:', ['class' => 'control-label']) !!}
                            {!! Form::text('c_password', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">File input</label>
                            <input type="file" id="image" name="image">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop