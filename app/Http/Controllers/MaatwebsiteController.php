<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Session;
use Excel;
use App\Invoice;
use Carbon\Carbon;

class MaatwebsiteController extends Controller
{
    public function importExport()
    {
        return view('file_upload.import_export');
    }

/*    public function downloadExcel($type)
    {
        $data = Post::get()->toArray();
        return Excel::create('laravelcode', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }*/
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){

            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['customer_id'] = $row['customer_no'];
                    if ($row['name'] == null){
                        $data['name'] = "N/A";
                    }else{
                        $data['name'] = $row['name'];
                    }
                    $data['email'] = $row['email'];

//                    dd($row['mobile']);
                    if ($row['mobile'] == null){

                        $data['password'] = bcrypt('000000');

                    }else{
                        $data['password'] = bcrypt('0'.$row['mobile']);
                    }

                    $data['phone'] = '0'.$row['mobile'];
                    //dd($data['customer_mobile_no']);
                    $data['customer_flat'] = $row['flat'];
                    $data['customer_house'] = $row['house'];
                    $data['address'] = $row['address'];
                    $data['customer_tv_count'] = (int)$row['tv_no'];
                    if ($row['dish_bill'] ==  'Inactive'){
                        $data['customer_status'] = 0;
                    }else{
                        $data['customer_monthly_bill'] = $row['dish_bill'];
                        $data['customer_status'] = 1;
                    }

                    if ($row['free'] ==  'Free'){
                        $data['customer_is_free'] = 1;
                    }else{
                        $data['customer_is_free'] = 0;
                    }

//                    dd($data);

                    if(!empty($data)) {
//                        DB::table('user')->insert($data);
                        $user = User::create($data);
                        $user->attachRole(Role::where('name','customer')->first());
                    }
                }
            });
        }

        flash('Your file successfully imported in database!!!')->success();

        return back();
    }

    public function createAllInvoice(){

        $date = new Carbon('last day of last month');
        $month_name = $date->format('F');
        $year = $date->year;
        $day = $date->day;

        $users = Role::where('name','customer')->first()->users()->get();

        foreach ($users as $user){
            if(Invoice::where('customer_id', '=' ,$user->id)->where('month', '=' ,$month_name)->where('year', '=' ,$year)->exists()) {

                \Log::info('Invoice of '.$user->customer_id.' already exists for '.$month_name.'/'.$year);

            }else{
                if ($user->customer_is_free != 1 && $user->customer_status != 0 ){

                    Invoice::create([
                        'customer_id' => $user->id,
                        'invoice_amount' => $user->customer_monthly_bill != null ? $user->customer_monthly_bill : 0,
                        'month' => $month_name,
                        'year' => $year,
                        'date' => $day,
                    ]);

                    \Log::info('Invoice of '.$user->customer_id.' for '.$month_name.'/'.$year.' has been created');

                }

            }
        }
    }

}
