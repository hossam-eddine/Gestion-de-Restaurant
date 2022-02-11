<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Servant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Symfony\Component\Console\Input\Input;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale=Sale::orderBy('created_at','DESC')->paginate(10);   
             return view("sale.index")->with(["sales"=>$sale]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        

        $sale = new Sale();
        $sale->servant_id = $request->servant_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->price;
        $sale->payment_type = $request->payment_type;
        $sale->payment_status= $request->payment_status;
        $sale->save();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);
        return redirect()->back()->with(["success" => "sale Added Succesfully"]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $table=$sale->tables()->where("sale_id",$sale->id)->get();
        $menu=$sale->menus()->where("sale_id",$sale->id)->get();
        return view("sale.edit")->with([
            'tables'=>$table,
            "menus"=>$menu,
            "sale"=>$sale,
            "servant"=>Servant::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        
        $sale->servant_id = $request->servant_id;
        $sale->quantity = $request->quantity;
        $sale->total_price = $request->price;
        $sale->payment_type = $request->payment_type;
        $sale->payment_status= $request->payment_status;
        $sale->update();
        $sale->menus()->sync($request->menu_id);
        $sale->tables()->sync($request->table_id);
        return redirect()->back()->with(["success" => "sale Updated  Succesfully"]); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->back()->with(["success" => "sale Deleted  Succesfully"]); 
    }
}
