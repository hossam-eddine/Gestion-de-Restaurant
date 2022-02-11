<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Servant;
use App\Models\Category;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index(){
        return view("Payments.index")->with([
            "tables"=>Table::all(),
            "categories"=>Category::all(),
            "servants"=>Servant::all()
        ]);
    }
}
