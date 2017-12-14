@extends('adminlte::page')

@section('title', 'Announcement')

@section('content_header')
    <h1>Edit Announcement </h1>
@stop


@section('content')
    <section class="contentxxx">
        <div class="row">

            <!-- general form elements -->
            <div class="box box-primary">


                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($announcement, ['method' => 'PATCH','route' => ['announcements.update', $announcement->id],'enctype'=>'multipart/form-data', 'id' => 'announcement-edit-form']) !!}
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
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('publish_date', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('expire_date', 'Expire Date*:', ['class' => 'control-label']) !!}
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('expire_date', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class='clear'></div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update Announcement </button>
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
        $('#publish_date, #expire_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    </script>
@stop
