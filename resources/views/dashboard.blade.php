@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class='row'>
    <div class='box'>
      <div class='body-box box-body'>
        @role('admin')
          <div class='graph-header'>
            Expense Analysis - {{ date('F') }} {{ date('Y') }}
          </div>
          <div class='graph-body'>
            <div class='row'>
             <div class='col-lg-12'>
               <div class='col-sm-6 braph-bg'>
                   <div id="incomevsexpense" style="min-width: 310px; height: 300px; margin: 10px auto"></div>
               </div>
               <div class='col-sm-6 braph-bg'>
                   <div id='expensesanalysis' style="min-width: 310px; height: 300px; margin: 10px auto"></div>
               </div>
             </div>
            </div>
          </div>
        @endrole

        <div class='graph-header'>
          Invoice - {{ date('F') }} {{ date('Y') }}
        </div>
        <div class='graph-body clearfix'>
            <div class='col-lg-12 braph-bg' style='padding-top: 15px; padding-bottom: 15px;'>
                <div class='col-lg-12' style='background: #ffffff;'>
                    <label> 
                     Unpaid 
                     <span class='pull-right'> 
                      {{ $invoice_data['unpaid_per'] }}% 
                     </span>
                    </label>
                    <div class="progress">
                      <div data-percentage="0%" style="width: {{ $invoice_data['unpaid_per'] }}%;" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <label> 
                      Partialy Paid 
                      <span class='pull-right'> {{ $invoice_data['partial_per'] }}% </span>
                    </label>
                    <div class="progress">
                      <div data-percentage="0%" style="width: {{ $invoice_data['partial_per'] }}%;" class="progress-bar progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <label> 
                      Paid 
                      <span class='pull-right'> {{ $invoice_data['paid_per'] }}% </span>
                    </label>
                    <div class="progress">
                      <div data-percentage="0%" style="width: {{ $invoice_data['paid_per'] }}%;" class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @role('admin')
                      <div class='row'>
                        <div class='col-lg-12 statictics'>
                          <div class='col-sm-6'>
                             <h3> Weekly Statistics </h3>
                             <ul>
                                 <li> Total Invoice Generated: {{ $invoice_data['total_amount'] }} Taka </li>
                                 <li> Total Paid: {{ $invoice_data['total_paid'] }} Taka </li>
                                 <li> Total Due: {{ $invoice_data['total_amount'] - $invoice_data['total_paid'] }} Taka </li>
                             </ul>
                          </div>
                          <div class='col-sm-6'>
                              <h3> Monthly Statistics </h3>
                             <ul>
                                 <li> Total Invoice Generated: {{ $invoice_data['total_amount'] }} Taka </li>
                                 <li> Total Paid: {{ $invoice_data['total_paid'] }} Taka </li>
                                 <li> Total Due: {{ $invoice_data['total_amount'] - $invoice_data['total_paid'] }} Taka </li>
                             </ul>
                          </div>
                        </div>
                      </div>
                    @endrole
                </div>
            </div>
          </div>
          <div class='graph-header'>
            Recent Invoice - {{ date('F') }} {{ date('Y') }}
          </div>
          <div class='graph-body' style='padding: 10px 0;'>
            <table class='custom-gray-table'>
             <thead>
              <tr>
               <th> # </th>
               <th> Account </th>
               <th> Amount </th>
               <th> Invoice Date </th>
               <th> Paid </th>
               <th> Status </th>
              </tr>
             </thead>
             <tbody>
               @foreach ($recent_invoices as $invoice)
                <tr>
                   <td> {{ $invoice->id }} </td>
                   <td> {{ $invoice->user->name }} </td>
                   <td> {{ $invoice->invoice_amount }} Taka </td>
                   <td> {{ $invoice->created_at }} </td>
                   <td>
                       {{ $invoice->payments->sum('amount') }} Taka
                   </td>
                   <td> 
                     @if($invoice->payments->sum('amount') > 0)
                       <a class='btn-outline-success'> Paid </a>
                     @else
                       <a class='btn-outline-danger'> Unpaid </a>
                     @endif
                   </td>
                </tr>
               @endforeach
             </tbody>
            </table>
          </div>
          @role('admin')
            <div class='graph-header'>
              Income vs Expense - {{ date('F') }} {{ date('Y') }}
            </div>
            <div class='graph-body'>
              <div id='d_chart' style='min-width: 310px; height: 300px; margin: 10px auto'></div>
            </div>
          @endrole
        </div>
      </div>
    </div>
 </div>
@stop

@section('custom_js')

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="http://demo.cloudonex.com/ui/lib/chartjs.min.js?ver=1"></script>

<script type='text/javascript'>
  var ib_graph_primary_color = '#2196f3';
  var ib_graph_secondary_color = '#dc171d';

  $(function() {
    // Income vs Expense
    $.getJSON("/dashboard/graph_income_expense", function( data ) {
        var income_expense = new CanvasJS.Chart("incomevsexpense", {
        animationEnabled: true,
        colorSet: [ib_graph_primary_color, ib_graph_secondary_color],
        data: [{
            type: "doughnut",
            startAngle: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label}",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: data.income, label: "Income" },
                { y: data.expense, label: "Expense" }
            ]
         }]
        });
        income_expense.render();
    });

   // Expense analysis

   $.getJSON("/dashboard/graph_expense", function( data ) {
        var income_expense = new CanvasJS.Chart("expensesanalysis", {
        animationEnabled: true,
        data: [{
            type: "pie",
            startAngle: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - {y}",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: data.graph_data
          }]
        });
       income_expense.render();
    });

  $.getJSON("/dashboard/graph_inex", function( data ) {
    var c3_opt =  {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['Income', 'Expense']
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [
                    '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15',
                    '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30',
                    '31'
                ]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name: 'Income',
                type:'bar',
                color: [
                    ib_graph_primary_color
                ],
                smooth:true,
                itemStyle: {
                    normal: {

                        areaStyle: { type: 'default' }

                    }
                },
                markPoint : {
                    data : [
                        { type : 'max', name: 'Maximum' }
                    ],
                    label : {
                        normal : {
                            position : 'top',
                            textStyle : {
                                color : ib_graph_secondary_color
                            }
                        }
                    }
                },
                markLine : {
                    data : [
                        { type : 'average', name : 'Average' }
                    ]
                },
                data: data.income
            },
            {
                name: 'Expense',
                type:'bar',
                color: [
                    ib_graph_secondary_color
                ],
                smooth:true,
                itemStyle: {
                    normal: {
                        areaStyle: { type: 'default' }
                    }
                },
                markPoint : {
                    data : [
                        { type : 'max', name: 'Maximum' }
                    ],
                    label : {
                        normal : {
                            position : 'top',
                            textStyle : {
                                color : ib_graph_secondary_color
                            }
                        }
                    }
                },
                markLine : {
                    data : [
                        { type : 'average', name : 'Average' }
                    ]
                },

                data: data.expense
            }
        ]
      };

      var c3_d = chartjs.init(document.getElementById('d_chart'));
      c3_d.setOption(c3_opt);
    });
  });
</script>
@stop