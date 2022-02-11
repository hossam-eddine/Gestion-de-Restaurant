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

    <form id="add-sale" action="{{ route('sales.update',$sale->id) }}" method="post">
        
        @csrf
        @method("PUT")
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <a href="{{ route('payment.index') }}" class="btn btn-secondary">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($tables as $tab )
                            <div class="col-md-3">
                                <div
                                    class="card p-2  mb-2 d-flex flex-column justify-content-center align-items-center list-group-item-action">
                                    <div class="align-self-end">
                                        <input type="checkbox" name="table_id[]" id="table" value="{{$tab->id}}" checked>

                                    </div>
                                    <i class="fas fa-chair fs-3"></i>
                                    <span class="text-mutted font-weight-bold">{{$tab->name}}</span>
                                   
                                    <hr>
                                                             
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

        

        <div class="row flex-column justify-content-center mt-2 ">
            <div class="col-md-12 card p-3">
               
                <div class="tab-content" id="pills-tabContent">
                   
                        <div class="row">
                            @foreach ($menus as $item )
                            <div class="col-md-4 mb-2">
                                <div class="card h-100" >
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <div class="align-self-end">
                                            <input type="checkbox" name="menu_id[]" id="menu_id" value="{{$item->id}}" checked>


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
                  
                </div>
                       
                       
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group mb-3">
                                    <select name="servant_id" id="servant_id" class="form-select">
                                        <option value="" disabled selected>Servant</option>
                                        @foreach($servant as $servant)
                                        <option {{$servant->id===$sale->servant_id ? 'selected' : ''}} value="{{$servant->id}}">{{$servant->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Qt
                                        </div>
                                    </div>
                                    <input type="number"  name="quantity"    class="form-control"    id="quantity" value="{{$sale->quantity}}"
                                        placeholder="quantity">

                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            $
                                        </div>
                                    </div>
                                    <input type="number" class=" form-control" name="price" placeholder="TotalPrice" value="{{$sale->total_price}}">
                                    
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            .00
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <select name="payment_type" id="payment_type" class="form-select">
                                        <option value="{{$sale->payment_type}}"  {{$sale->payment_type==='cash' ? 'selected' : ''}}>Cash</option>
                                    
                                        <option value="{{$sale->payment_type}}" {{$sale->payment_type==='Bank Card' ? 'selected' : ''}}>Bank Card</option>

                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <select name="payment_status" id="payment_status" class="form-select">
                                        <option value="outstanding payment" {{$sale->payment_status=='outstanding payment' ? 'selected' : ''}}>outstanding payment</option>
                                        <option value="Paid" {{$sale->payment_status=='Paid' ? 'selected' : ''}}>Paid</option>

                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    
                                    <button class="btn btn-success" onclick="addsale()">Validate</button>
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
</script>

@endsection()