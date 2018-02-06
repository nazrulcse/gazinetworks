@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
Upload Customer

    </h1>
@stop


@section('content')
    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <form action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="import_file" />
                    <button class="btn btn-primary">Import File</button>
                </form>
            </div>
        </div>
    </section>
@stop