@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Invoice</h1>
@stop

@section('content')
    <section class="contentxx">
        <div class="row">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Invoice Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => '/invoices','enctype'=>'multipart/form-data']) !!}
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('customer_id', 'Customer Id:', ['class' => 'control-label']) !!}
                            {!! Form::select('customer_id', $customers,null, ['class' => 'form-control customer_select']) !!}

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('year', 'Year:', ['class' => 'control-label']) !!}
                            {!! Form::selectYear('year', 2010, 2030,null, ['class' => 'form-control customer_select']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('month', 'Month:', ['class' => 'control-label']) !!}
                            {!! Form::selectMonth('month',null, ['class' => 'form-control customer_select']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date', 'Date:', ['class' => 'control-label']) !!}
                            {!! Form::selectYear('date', 1, 31,null, ['class' => 'form-control customer_select']) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </section>
    @endsection

<script src="//code.jquery.com/jquery-1.12.4.js"></script>



<script type="text/javascript">

    $(document).ready(function () {
        $('.customer_select').select2()

    });
</script>
