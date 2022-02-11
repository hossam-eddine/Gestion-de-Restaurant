<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServantRequest;
use App\Http\Requests\UpdateServantRequest;

class ServantController extends Controller
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
        return view('Servant.index')->with(["servants"=>Servant::latest()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Servant.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServantRequest $request)
    {
        Servant::create([
            "name"=>$request->name,
            "adress"=>$request->adress
        ]);
        return redirect()->route("servants.index")->with([
            "success"=>"Servant Added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function show(Servant $servant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function edit(Servant $servant)
    {
         return view("Servant.edit",compact("servant"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServantRequest  $request
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servant $servant)
    {
        $this->validate($request,[
            "name"=>"required|unique:servants,name,".$servant->id,
            "adress"=>'required'
          
        ]);
        $servant->update([
            "name"=>$request->name,
            "adress"=>$request->adress
        ]);
        return redirect()->route("servants.index")->with([
            "success"=>"Servant Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servant  $servant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servant $servant)
    {
        $servant->delete();
        return redirect()->route("servants.index")->with([
            "success"=>"Servant Deleted successfully"
        ]);

    }
}
