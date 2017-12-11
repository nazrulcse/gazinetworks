{!! Form::open(['url' => '/customers/search', 'id'=>'search-form', 'method' => 'get']) !!}
<div class="box-body">

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('road', 'Road:', ['class' => 'control-label']) !!}
            {!! Form::text('road', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('house', 'House:', ['class' => 'control-label']) !!}
            {!! Form::text('house', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="text-center">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" style="    width: 150px;">Search Customer</button>
        </div>
    </div>

</div>
{!! Form::close() !!}