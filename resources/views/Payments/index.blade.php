@extends("layouts.app")

@section("style")
<style>
    .parallax {
        /* The image used */

        background-image: url('images/food.jpg');


        /* Set a specific height */
        min-height: 500px;

        /* Create the parallax scrolling effect */

        background-repeat: no-repeat;
        background-size: cover;
    }
</style>


@endsection
@section("content")

<div class="container">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form id="add-sale" action="{{ route('sales.store') }}" method="post">
        
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <a href="" class="btn btn-primary">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-3">
                        <h3 class=" border-bottom text-white">{{Carbon\Carbon::now()}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <a href="{{ route('sales.index') }}" class="btn btn-outline-primary float-end">
                                All Sales
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card bg-primary">
                    <div class="card-body ">
                        <div class="row">
                            @foreach ($tables as $tab )
                            <div class="col-md-3 ">
                                <div
                                    class="card p-2  mb-2 d-flex flex-column justify-content-center align-items-center list-group-item-action ">
                                    <div class="align-self-end ">
                                        <input type="checkbox" name="table_id[]" id="table" value="{{$tab->id}}">

                                    </div>
                                    <i class="fas fa-chair fs-3 text-primary"></i>
                                    <span class="text-mutted font-weight-bold">{{$tab->name}}</span>
                                    <div class="d-flex flex-column justify-content-between align-items-center">
                                        <a href="{{route('sales.edit',$tab->slug)}}" class="btn btn-sm btn-warning">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </div>
                                    <hr>
                                    @foreach ($tab->sales as $sale  )
                                    @if ($sale->created_at >= Carbon\Carbon::today())
                                    <div style="border: 1px dashed red" class=" mb-2 mt-2  shadow w-100 " id="{{$sale->id}}">
                                    <div class="card">
                                        <div class="card-header text-center ">
                                            <h5 class="text-uppercase"><i class="fas fa-utensils " style="color: purple"></i> <span style="color: plum">HSM</span>F😃😃d</h5>
                                        </div>
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                          @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu )
                                             <h5 class="font-weight-bold mt-5">
                                                 {{$menu->title}}
                                             </h5>
                                             <span class="text-muted">{{$menu->price}} DH</span>

                                          @endforeach
                                          <h5 class="font-weight-bold mt-2">
                                              <span class="badge bg-light text-dark">
                                                  Servant :{{$sale->servant->name}}

                                              </span>
                                          </h5>
                                          <h5 class="font-weight-bold mt-2">
                                            <span class="badge  bg-light text-dark">
                                               Quantity :{{$sale->quantity}}

                                            </span>
                                        </h5>
                                    
                                        <h5 class="font-weight-bold mt-2">

                                            <span class="badge bg-light text-dark">
                                               
                                               Payment:
                                               {{$sale->payment_type}} 

                                            </span>
                                            <i class="{{$sale->payment_type==='cash' ? 'fas fa-money-bill-wave text-success' : 'fas fa-money-check'}} "></i>
                                        </h5>
                                        <h5 class="font-weight-bold mt-2">
                                            <span class="badge bg-danger">
                                                Total :{{$sale->total_price}} DH

                                            </span>
                                        </h5>
                                        <h6 class="font-weight-bold mt-2">
                                            <span class=" badge {{$sale->payment_status==='Paid'? 'bg-success' : 'bg-danger'}} ">
                                                Status:
                                                {{$sale->payment_status}}

                                            </span>
                                        </h6>
                                        <hr>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <span> Rue ABC derb doukala</span>
                                            <span><i class="fas fa-phone-volume"></i>: 0608081222</span>
                                             
                                        </div>
                                        
                                        </div>
                                    </div>


                                    </div>
                                        <div class="mt-2 d-flex justify-content-center">
                                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="far fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="imprimer({{$sale->id}})" class="btn btn-sm btn-primary ">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            
                                        </div>
                                    @endif
                                        
                                    @endforeach
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

        

        <div class="row flex-column justify-content-center mt-2  ">
            <div class="col-md-12 card p-3" style="background-color: #45b3e0">
                <ul class=" nav nav-pills   justify-content-center flex-column flex-sm-row  mb-3" id="pills-tab"
                    role="tablist">
                    @foreach ($categories as $category )
                    <li class="nav-item">

                        <button class="nav-link  {{$category->slug==='breakfast' ? 'active' :''}} "
                            id="{{$category->slug}}-tab" data-bs-toggle="pill" data-bs-target="#{{$category->slug}}"
                            type="button" role="tab" aria-controls="{{$category->slug}}" aria-selected="true">

                            {{$category->title}}
                        </button>

                    </li>
                    @endforeach

                </ul>
                <div class="tab-content" id="pills-tabContent" >
                    @foreach ($categories as $category)
                    <div class="tab-pane fade {{$category->slug==='breakfast'? ' show active' : ''}}"
                        id="{{$category->slug}}" role="tabpanel" aria-labelledby="pill-home-tab">
                        <div class="row " >
                            @foreach ($category->menus as $item )
                            <div class="col-md-4 mb-2">
                                <div class="card h-100" >
                                    <div class="card-body  d-flex flex-column justify-content-center align-items-center" >
                                        <div class="align-self-end">
                                            <input type="checkbox" name="menu_id[]" id="menu_id" value="{{$item->id}}">


                                        </div>
                                        <img src="{{ asset('images/menus/'.$item->image) }}"
                                            class="img-fluid rounded-circle" width="100" height="100"
                                            alt="{{$item->title}}">
                                        <h5 class="font-weight-bold mt-2">
                                            {{$item->title}}
                                        </h5>
                                        <h5 class="text-muted">
                                            {{$item->price}} DH
                                        </h5>

                                    </div>
                                </div>
                            </div>



                            @endforeach
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                       
                       
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group mb-3">
                                    <select name="servant_id" id="servant_id" class="form-select">
                                        <option value="" disabled selected>Servant</option>
                                        @foreach ($servants as $servant)
                                        <option value="{{$servant->id}}">{{$servant->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Qt
                                        </div>
                                    </div>
                                    <input type="number"  name="quantity"    class="form-control"    id="quantity"
                                        placeholder="quantity">

                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            $
                                        </div>
                                    </div>
                                    <input type="number" class=" form-control" name="price" placeholder="TotalPrice">
                                    
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            .00
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <select name="payment_type" id="payment_type" class="form-select">
                                        <option value="" disabled selected>Payment_Type</option>
                                        <option value="cash">Cash</option>
                                        <option value="Bank Card">Bank Card</option>

                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <select name="payment_status" id="payment_status" class="form-select">
                                        <option disabled selected>Payment_status</option>
                                        <option value="outstanding payment">outstanding payment</option>
                                        <option value="Paid">Paid</option>

                                    </select>
                                </div>
                               
                                <div class="form-group text-center">
                                    
                                    <button class="btn btn-outline-primary" onclick="addsale()">Validate</button>
                                </div>


                            </div>
                        </div>
                    </div>

                    
                </div>
            

        

    </form>


</div>

@endsection
@section("script")

@if (session()->has("success"))




<script>
    Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{session()->get("success")}}',
  showConfirmButton: false,
  timer: 1500
})

        
        
        
</script>
@endif
<script>
    function addsale(){
event.preventDefault();


document.getElementById("add-sale").submit();
}
function imprimer(id){
 const page=document.body.innerHTML;
 const content=document.getElementById(id).innerHTML;
document.body.innerHTML=content;
window.print();
document.body.innerHTML=page;
}
</script>

@endsection()