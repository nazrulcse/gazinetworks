@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        All Payments

    </h1>
@stop


@section('content')

    <div class="form-group text-center">
        <label>Search Between Date</label>

        <div class="input-group" style="  width: 300px; margin: auto;padding-bottom: 10px;">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservation">
        </div>
        <!-- /.input group -->
    </div>

    @include('payments._payment_table')

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

            $('#reservation').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

        });

        $(document).on('click','.applyBtn', function (e) {


            var dateRange = $('#reservation').val();
            console.log(dateRange);

            $.ajax({
                type: 'get',
                url : '/payments',
                data : {dateRange : dateRange},
                success:function (data) {
                    console.log("Y");
                    $(".contentXX").replaceWith(data);
                    console.log(data);


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

                    $('#reservation').daterangepicker({

                        locale: {
                            format: 'DD/MM/YYYY'
                        }
                    });

                }
            });

        });
    </script>
@stop
