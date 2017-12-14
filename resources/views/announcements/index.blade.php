@extends('adminlte::page')

@section('title', 'Announcement')

@section('content_header')
    <h1>
        Announcement Listing
        <a class='pull-right btn btn-default' href='/announcements/create'> 
         <i class='fa fa-plus'></i> New Announcement 
        </a>
    </h1>
@stop


@section('content')

    <section class="contentXX">
        <div class="row">
            @include('flash::message')

            <div class="box">
                <div class="box-header">

                </div>

                <div class="box-body">
                    <table id="example2" class="table table-hover beaccount-table table-striped">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th>Published</th>
                            <th>Expired</th>
                            <th>Announcement</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($announcements as $announcement )
                            <tr>
                                <td> {{ $announcement->id }} </td>
                                <td>{{$announcement->publish_date}}</td>
                                <td>{{$announcement->expire_date}}</td>
                                <td>{{$announcement->text}}</td>
                                <td>
                                    @if(date("Y-m-d") >= $announcement->publish_date and date("Y-m-d") <= $announcement->expire_date)
                                     <span class='btn-outline-success'> Active </span>
                                    @else
                                      <span class='btn-outline-danger'> Expired </span>
                                    @endif
                                </td>
                                @role('admin')
                                  <td class="text-right">
                                     <a class="btn btn-small btn-warning action-btn" href="/announcements/{{ $announcement->id }}/edit">
                                         <i class="fa fa-pencil-square-o"></i>
                                     </a>

                                     <a style="width: 40px">
                                         {{ Form::open(array('url' => 'announcements/' . $announcement->id, 'style'=>'margin-bottom:0;display:inline-block;')) }}
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
                                     <a class="btn btn-small btn-warning action-btn" href="/announcements/{{ $announcement->id }}/edit">
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
                "sSwfPath": "/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"},
            "order": [[ 0, "desc" ]]
        });

        $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

    });
</script>
@stop
