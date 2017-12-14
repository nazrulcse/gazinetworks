@extends('adminlte::page')

@section('title', 'Announcement')

@section('content_header')
    <h1>Create Announcement </h1>
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
                {!! Form::open(['url' => '/announcements','enctype'=>'multipart/form-data']) !!}
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('text', 'Announcement Text*:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::textarea('text', null, ['class' => 'form-control', 'style' => 'height: 100px;'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('publish_date', 'Publish Date*:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('publish_date', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('expire_date', 'Expire Date*:', ['class' => 'control-label']) !!}
                            {!! 
                                Form::text('expire_date', '', ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <div class='clear'></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create Announcement </button>
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
            $('#publish_date, #expire_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });
        });
    </script>
@stop