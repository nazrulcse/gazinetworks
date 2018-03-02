@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create {{ request()->has('is_agent')? "Agent" : "Customer" }}</h1>
@stop

@section('content')
    <section class="contentxxx">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => '/users','enctype'=>'multipart/form-data', 'id'=>'agent-form']) !!}
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                            {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('customer_id', 'ID:', ['class' => 'control-label']) !!}
                            {!! Form::text('customer_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
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

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}<span id="message" ></span>
                                {!! Form::text('password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('c_password', 'Confirm Password:', ['class' => 'control-label']) !!}
                                {!! Form::text('c_password', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    @else

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
                                {!! Form::text('customer_monthly_bill', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                                {!! Form::label('customer_connection_date', 'Connection Date:', ['class' => 'control-label']) !!}
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('customer_connection_date', null, ['class' => 'form-control', "data-date" => Carbon\Carbon::now() ]) !!}
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_zone', 'Zone:', ['class' => 'control-label']) !!}
                                {!! Form::text('customer_zone', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('', 'Additional Info:', ['class' => 'control-label']) !!}</br>
                                {!! Form::myCheckbox('customer_is_free','1','is_free', '', 'Free of charge') !!}
                                {!! Form::myCheckbox('customer_set_top_box_iv','1','set_top_box_iv', '', 'Set-Top Box iv') !!}
                            </div>
                        </div>

                    @endif

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Agent photo</label>
                            <input type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create {{ request()->has('is_agent')? "Agent" : "Customer" }}</button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger pull-right" style="margin-right: 5px">Cancel</a>
                    </div>
                </div>
                <!-- /.box-body -->


                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop


@section('js')
    <script>

        $('#customer_connection_date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

        $(document).ready(function () {

            var random = Math.floor(Math.random() * (100000 - 1) + 1);

            if ($('#work_zone').length) {
                $('#customer_id').val('AG' + random);
            } else {
                $('#customer_id').val('CU' + random);
            }

        });


        $('#password, #c_password').on('keyup', validatePassword);


        function validatePassword () {
            var passwordVal  = $('#password').val();
            var comfirmVal = $('#c_password').val();
            if( passwordVal &&  comfirmVal){
                if (passwordVal.length >= 6 ){
                    if ($('#password').val() == $('#c_password').val()) {
                        $('#message').html(' -Password matched.').css('color', 'green');
                        return true;
                    } else
                        $('#message').html(' -Password not matched.').css('color', 'red');
                    return false;
                }
                else{
                    $('#message').html(' -Password should not be less than 6 characters.').css('color', 'red');
                    return false;
                }
            }
        }

        $('#agent-form').on('submit', function (e) {
            var check_validation = validatePassword();
            if(check_validation === false){
                e.preventDefault();
                return false;
            }
        });

    </script>
@stop