<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;

class TableController extends Controller
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
        $tables=Table::paginate(5);
        return view("Tables.index")->with(["tables"=>$tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Tables.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTableRequest $request)
    {
        Table::create([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "status"=>$request->status
        ]);
        return redirect()->route("tables.index")
        ->with(["success"=>"Table Added Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return view("Tables.edit")->with(["table"=>$table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $this->validate($request,[
            "name"=>"required|min:3|unique:tables,name,".$table->id,
            "status"=>"required|boolean"
        ]);
        $table->update([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "status"=>$request->status
        ]);
        return redirect()->route("tables.index")
        ->with(["success"=>"Table Updated  Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route("tables.index")
        ->with(["success"=>"Table Deleted  Successfully"]);
    }
}
