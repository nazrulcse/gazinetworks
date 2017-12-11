@extends('adminlte::page')

@section('title', 'New Expense')

@section('content_header')
    <h1>Create Expense </h1>
@stop

@section('content')
    <section class="contentxx">
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
                {!! Form::open(['url' => '/expenses','enctype'=>'multipart/form-data']) !!}
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
                                Form::text('title', '', ['class' => 'form-control customer_select'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date', 'Expense Date:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('date', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('amount', 'Amount:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('amount', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('received_by', 'Received By:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('received_by', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('voucher_no', 'Voucher number:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('voucher_no', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::textarea('description', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create Expense </button>
                        <a href="{{ URL::previous() }}" class="btn btn-danger pull-right" style="margin-right: 5px">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </section>
    @endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });
            $('.customer_select').select2();
        });
    </script>
@stop