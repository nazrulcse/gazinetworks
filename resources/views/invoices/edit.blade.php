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
                    @if (request()->has('other'))
                        <h3 class="box-title">Invoice Title : {{$invoice->other_invoice_title}}</h3></br>
                    @else
                        <h3 class="box-title">Invoice of : {{$invoice->user->name}}</h3></br>
                        <h3 class="box-title">Customer Id : {{$invoice->user->customer_id}}</h3>
                    @endif

                </div>

                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($invoice, ['method' => 'PATCH','route' => ['invoices.update', $invoice->id],'enctype'=>'multipart/form-data']) !!}
                <div class="box-body">
                    @if (request()->has('other'))

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('other_invoice_title', 'Invoice Title:', ['class' => 'control-label']) !!}
                                {!! Form::text('other_invoice_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <input type="hidden" name="other">

                    @endif

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('invoice_date', 'Invoice Date:', ['class' => 'control-label']) !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('invoice_date', $formatted_date, ['class' => 'form-control', ]) !!}
                            </div>
                            <!-- /.input group -->
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

@section('js')



    <script type="text/javascript">

        $(document).ready(function () {

            $('#invoice_date').datepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

        });
    </script>
@stop