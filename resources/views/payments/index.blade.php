@extends('adminlte::page')

@section('title', 'Payments')

@section('content_header')
    <h1>
        All Payments
    </h1>
@stop


@section('content')
  @include('payments._payment_table')

@stop
@section('js')

    <script type="text/javascript">


        $(document).ready(function () {

            $('div.alert').not('.alert-important').delay(5000).fadeOut(350);

            $('#reservation').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $( "#destroy-form" ).submit(function( event ) {
                event.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "Please click confirm to delete this item",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true
                }).then(function() {
                    $("#destroy-form").off("submit").submit();
                }, function(dismiss) {
                    if (dismiss === 'cancel') {
                        swal('Cancelled', 'Delete Cancelled :)', 'error');
                    }
                })
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
