@extends('adminlte::page')

@section('title', 'Expense Category')

@section('content_header')
    <h1>
        All Expenses
        <a class='pull-right btn add-new-btn btn-default' href='javascript:void(0)'> 
         <i class='fa fa-plus'></i> New Expense Category 
        </a>
    </h1>
@stop


@section('content')

    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="new-expense-category" style="display: {{ $errors->any() ? 'block' : 'none' }};">
                    <div class='panel panel-default'>
                     <div class='panel-heading'> Create New Expense Category </div>
                     <div class='panel-body'>
                         @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                           </div>
                         @endif
                         {!! Form::open(['url' => '/expense_categories','enctype'=>'multipart/form-data']) !!}
                          <div class="box-bodyxx clearfix">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      {!! Form::label('name', 'Category Name:', ['class' => 'control-label']) !!}
                                      {!! 
                                          Form::text('name', null, ['class' => 'form-control'])
                                      !!}
                                  </div>
                              </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                      {!! Form::label('description', 'Category Description:', ['class' => 'control-label']) !!}
                                      {!! 
                                          Form::textarea('description', null, ['class' => 'form-control', 'style' => 'height: 70px;'])
                                      !!}
                                  </div>
                              </div>
                              <div class="box-footer" style='border: none;'>
                                <button type="submit" class="btn btn-primary pull-right">
                                  Create Expense Category 
                                </button>
                                <a href="javascript:void(0);" class="btn btn-danger btn-cancel-category pull-right" style="margin-right: 5px">
                                  Cancel
                                </a>
                              </div>
                          </div>
                        {!! Form::close() !!}
                     </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expense_categories as $category )
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                @role('admin')
                                  <td class="text-right">
                                    <a class="btn btn-small btn-warning action-btn" href="/expense_categories/{{ $category->id }}/edit">
                                         <i class="fa fa-pencil-square-o"></i>
                                     </a>

                                     <a style="width: 40px">
                                         {{ Form::open(array('url' => 'expense_categories/' . $category->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-small btn-danger action-btn">
                                                  <i class="fa fa-remove"></i>
                                                </button>
                                            {{ Form::close() }}
                                      </a>                                      
                                  </td>
                                @endrole
                                @role('agent')
                                  <td>
                                   <a class="btn btn-small btn-warning action-btn" href="/expense_categories/{{ $category->id }}/edit">
                                         <i class="fa fa-pencil-square-o"></i>
                                   </a>
                                  </td>
                                @endrole

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"}
        });

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

        $('.add-new-btn').click(function() {
          $('.new-expense-category').slideDown(500);
        });

        $('.btn-cancel-category').click(function() {
         $('.new-expense-category').slideUp(500);
        });
    });
</script>
@stop
