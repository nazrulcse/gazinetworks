@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Invoice</h1>
@stop


@section('content')
    <section class="contentXX">
        <div class="row">



            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Invoice of : {{$invoice->user->name}}</h3></br>
                    <h3 class="box-title">Customer Id : {{$invoice->user->customer_id}}</h3>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($invoice, ['method' => 'PATCH','route' => ['invoices.update', $invoice->id],'enctype'=>'multipart/form-data']) !!}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('year', 'Year:', ['class' => 'control-label']) !!}
                            {!! Form::selectYear('year', 2010, 2030,null, ['class' => 'form-control customer_select']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('month', 'Month:', ['class' => 'control-label']) !!}
                            {!! Form::selectMonth('month',$month, ['class' => 'form-control customer_select']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('invoice_amount', 'Invoice Amount:', ['class' => 'control-label']) !!}
                            {!! Form::text('invoice_amount', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection