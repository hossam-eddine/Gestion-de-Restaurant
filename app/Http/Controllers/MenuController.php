<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
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
        return view("Menu.index")
        ->with(["menus"=>Menu::latest()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Menu.create")->with(["categories"=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        if($request->hasFile("image")){
            $file=$request->image;
            $image_Name=time()."_". $file->getClientOriginalName();
            $file->move(public_path("images/menus"),$image_Name);
       
        Menu::create([
            "title"=>$request->title,
            "slug"=>Str::slug($request->title),
            "description"=>$request->description,
            "price"=>$request->price,
            "image"=>$image_Name,
            "category_id"=>$request->category_id

        ]);
    }
        return redirect()->route("menus.index")->with(["success"=>"Menu Added Succesfully"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('Menu.edit')->with(["categories"=>Category::all(),"menu"=>$menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request,[
            "title"=>"required|min:3|unique:menus,title,".$menu->id,
            "description"=>"required|min:5",
            "image"=>"mimes:png,jpg,jpeg|max:2048",
            "price"=>"required|numeric",
            "category_id"=>"required|numeric"
        ]);
        if($request->hasFile("image")){
            unlink(public_path("images/menus/".$menu->image)); 
            $file=$request->image;
            $image_Name=time() ."_". $file->getClientOriginalName();
            $file->move(public_path("images/menus"),$image_Name);
            $menu->update([
                "title"=>$request->title,
                "slug"=>Str::slug($request->title),
                "description"=>$request->description,
                "price"=>$request->price,
                "image"=>$image_Name,
                "category_id"=>$request->category_id
            ]);
            return redirect()->route("menus.index")->with(["success"=>"Menu Updated Succesfully"]);

        }
        else{
            $menu->update([
                "title"=>$request->title,
                "slug"=>Str::slug($request->title),
                "description"=>$request->description,
                "price"=>$request->price,
             
                "category_id"=>$request->category_id
            ]);

            return redirect()->route("menus.index")->with(["success"=>"Menu Updated Succesfully"]);

        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //delete file from folder
        unlink(public_path("images/menus/".$menu->image));
        //delete menu
        $menu->delete();
        return redirect()->route("menus.index")->with(["success"=>"Menu Deleted Succesfully"]);

    }
}
