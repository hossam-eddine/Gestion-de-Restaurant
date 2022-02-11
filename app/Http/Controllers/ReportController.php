<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Sale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        
    }
    public function index(){
        return view('report.index');
    }
    public function generate(Request $request){
    // validate data
        $this->validate($request,[
            "from"=>"required",
            "to"=>"required",
        ]);
        //get date
         $startdate=date("Y-m-d H:i:s",strtotime($request->from."00:00:00"));
         $enddate=date("Y-m-d H:i:s",strtotime($request->to."23:59:59"));
         $sale=Sale::whereBetween("created_at",[$startdate,$enddate])
         ->where("payment_status","Paid")->get();
         return view("Report.index")->with(
             [
                "startdate"=>$startdate,
             "enddate"=>$enddate,
             "total"=>$sale->sum("total_price"),
             "sales"=>$sale
            ]);

        
    }
    public function export(Request $req){
        return Excel::download(new SaleExport($req->from,$req->to),"sales.xlsx");
    
    }
}
