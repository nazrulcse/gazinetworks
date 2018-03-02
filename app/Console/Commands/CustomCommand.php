<?php

namespace App\Console\Commands;

use App\Invoice;
use Illuminate\Console\Command;
use App\Role;
use App\User;
use Carbon\Carbon;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates invoices monthly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = new Carbon('last day of last month');
        $month_name = $date->format('F');
        $year = $date->year;
        $day = $date->day;

        $users = Role::where('name','customer')->first()->users()->get();

        foreach ($users as $user){
            if(Invoice::where('customer_id', '=' ,$user->id)->where('month', '=' ,$month_name)->where('year', '=' ,$year)->exists()) {

                \Log::info('Invoice of '.$user->customer_id.' already exists for '.$month_name.'/'.$year);

            }else{

                Invoice::create([
                    'customer_id' => $user->id,
                    'invoice_amount' => $user->customer_monthly_bill,
                    'month' => $month_name,
                    'year' => $year,
                    'date' => $day
                ]);

                \Log::info('Invoice of '.$user->customer_id.' for '.$month_name.'/'.$year.' has been created');

            }
        }
//        \Log::info($users);
    }
}
