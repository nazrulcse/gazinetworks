<section class="contentXX">
    <div class="row">
        @include('flash::message')

        <div class="box">
            <div class="box-body">
                <div class="text-center pull-right" style='margin-bottom: -50px;'>
                    <div class="input-group" style="  width: 300px; margin: auto;padding-bottom: 10px;">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="reservation">
                    </div>
                </div>
                <table id="example2" class="table table-hover beaccount-table table-striped">
                    <thead>
                    <tr>
                        <th>Payment Of</th>
                        <th>Customer Id</th>
                        <th>Received By</th>
                        <th>Bill Period</th>
                        <th>Invoice Amount</th>
                        <th>Paid</th>
                        <th>Payment Date</th>
                        @role('admin')
                        <th>Actions</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment )
                        <tr>
                            <td>{{$payment->invoice->user->name}}</td>
                            <td>{{$payment->invoice->user->customer_id}}</td>
                            <td>{{$payment->user->name}}</td>
                            <td>{{$payment->invoice->month.', '.$payment->invoice->year}}</td>
                            <td>{{$payment->invoice->invoice_amount}}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ date('d/m/Y', strtotime($payment->date))}}</td>
                            @role('admin')
                            <td class="text-right">
                                <a class="" style="width: 40px">
                                    {{ Form::open(array('url' => 'payments/' . $payment->id, 'style'=>'margin-bottom:0;display:inline-block;', "id" => 'destroy-form')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    <button type="submit" class="btn btn-small btn-danger action-btn destroy"><i class="fa fa-remove"></i></button>
                                    {{ Form::close() }}
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
