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
                {!! Form::model($expense_category, ['method' => 'PATCH','route' => ['expense_categories.update', $expense_category->id],'enctype'=>'multipart/form-data', 'id' => 'expense-edit-form']) !!}
                <div class="box-body clearfix">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Category Name:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('name', null, ['class' => 'form-control customer_select'])
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
                    <div style='clear: both'></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update Expense Category </button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger pull-right" style="margin-right: 5px">Cancel</a>
                    </div>
                </div>
                <!-- /.box-body -->

            </div>
        </div>
    </section>

@stop