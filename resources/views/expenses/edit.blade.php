@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit {{ request()->has('agents')? "Agent" : "Customer" }}</h1>
@stop


@section('content')
    <section class="contentxxx">
        <div class="row">

            <!-- general form elements -->
            <div class="box box-primary">


                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($expense, ['method' => 'PATCH','route' => ['expenses.update', $expense->id],'enctype'=>'multipart/form-data', 'id' => 'expense-edit-form']) !!}
                <div class="box-body">
                   <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('category', 'Category:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::select('category', $category, null, ['class' => 'form-control customer_select'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('title', 'Expense Title:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('title', null, ['class' => 'form-control customer_select'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date', 'Expense Date:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('date', null, ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('amount', null, ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('received_by', 'Received By:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('received_by', null, ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('voucher_no', 'Voucher number:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('voucher_no', null, ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::textarea('description', null, ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update Expense </button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger pull-right" style="margin-right: 5px">Cancel</a>
                    </div>
                </div>
                <!-- /.box-body -->

            </div>
        </div>
    </section>

@stop

@section('js')
    <script>
        $('#date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
        $('.customer_select').select2();
    </script>
@stop
