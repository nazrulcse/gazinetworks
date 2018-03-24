@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Other Income Invoices</h1>
@stop

@section('content')
    <section class="contentxx">
        <div class="row">

            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => '/invoices','enctype'=>'multipart/form-data']) !!}
                <div class="box-body">

                    @if (request()->has('other'))
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('other_invoice_title', 'Invoice Title:', ['class' => 'control-label']) !!}
                                {!! Form::text('other_invoice_title', null, ['class' => 'form-control', 'required' => 'required']) !!}

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('invoice_amount', 'Amount:', ['class' => 'control-label']) !!}
                                {!! Form::text('invoice_amount', null, ['class' => 'form-control', 'required' => 'required']) !!}

                            </div>
                        </div>

                    @else
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_id', 'Customer Id:', ['class' => 'control-label']) !!}
                                {!! Form::select('customer_id', $customers,null, ['class' => 'form-control customer_select']) !!}

                            </div>
                        </div>

                    @endif

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('invoice_date', 'Invoice Date:', ['class' => 'control-label']) !!}
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('invoice_date', null, ['class' => 'form-control', "data-date" => Carbon\Carbon::now() ]) !!}
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                </div>
                <div class="box-footer" style="padding: 28px">
                    <button type="submit" class="btn btn-primary pull-right">Create Invoice</button>
                    <a href="{{ URL::previous() }}" class="btn btn-danger pull-right" style="margin-right: 5px">Cancel</a>
                </div>

                {!! Form::close() !!}

                <div class="Jumbotron">
                    <div style="margin-left: 20px">
                        <h1>Create All Invoice of Past Month</h1>
                        <a class="btn btn-lg btn-success action-btn" href="{{ URL::to('/importExport/createinvoice') }}">
                            <i class="fa fa-plus"></i> Create All Invoice
                        </a>
                    </div>

                </div>



            </div>
        </div>
    </section>
@endsection

@section('js')



<script type="text/javascript">

    $(document).ready(function () {
        $('.customer_select').select2()

        $('#invoice_date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });

    });
</script>
@stop