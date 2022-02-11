@extends("layouts.app")
@section("content")
<div class="container ">
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-utensils"></i>
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="row justify-content-center ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                      
                        <div class="col-md-12">
                         <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                        <h3 class="text-secondary"><i class="fas fa-credit-card "></i> Sales</h3>
                        <a href="{{ route('payment.index')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    
                    </div>
                    <table class=" table table-hover  align-middle table-bordered table-responsive-sm">
                        <thead>
                            <th>ID</th>
                            <th>Menu</th>
                            <th>Table</th>
                            <th>Servant</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment_Type</th>
                            <th>Payment_status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($sales as $key=> $sale )
                            <tr>
                                <td>{{$key+=1}}</td>
                                <td>
                                    @foreach ($sale->menus()->where('sale_id',$sale->id)->get()  as $item )
                                    <div class="col-md-4 mb-2">
                                        <div class="h-100" >
                                            <div class=" d-flex flex-column justify-content-center align-items-center">
                                                
                                                <img src="{{ asset('images/menus/'.$item->image) }}"
                                                    class="img-fluid rounded-circle" width="50" height="50"
                                                    alt="{{$item->title}}">
                                                <h5 class="font-weight-bold mt-2">
                                                    {{$item->title}}
                                                </h5>
                                                
        
                                            </div>
                                        </div>
                                    </div>
        
        
        
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($sale->tables()->where('sale_id',$sale->id)->get()  as $item )
                                    <div class="col-md-4 mb-2">
                                        <div class=" h-100" >
                                            <div class=" d-flex flex-column justify-content-center align-items-center">
                                                <i class="fas fa-chair"></i>
                                                
                                                <h5 class="font-weight-bold mt-2">
                                                    {{$item->name}}
                                                </h5>
                                                
        
                                            </div>
                                        </div>
                                    </div>
        
        
        
                                    @endforeach
                                </td>
                                <td>{{$sale->servant->name}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->total_price}}</td>
                                <td>{{$sale->payment_type}}</td>
                                <td>{{$sale->payment_status}}</td>
                                
                                 
                                <td class="d-flex flex-row justify-content-center align-items-center ">                    
                                    <a href="{{ route('sales.edit',$sale->id)}}" class="btn btn-warning  me-2 mt-4">
                                        <i class="fas fa-edit "></i>
                                        </a>
                                        <form action="{{ route('sales.destroy',$sale->id ) }}"  id="{{$sale->id}}" method="POST">
                                        @csrf
                                        @method("DELETE")

                                        </form>
                                        <button type="submit" class="btn btn-danger mt-4" onclick="deletea({{$sale->id}})"><i class="fas fa-trash-restore "></i></button>

                                    </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
            
                    </table>
                    <div class="my-3 d-flex justify-content-center align-items-center">
                      {{$sales->links()}}
    
                    </div>
                    </div>
                    </div>
                    
                    </div>
                </div>
            </div>
           
        </div>
        </div>
      </div>
    </div>
    
  </div>
   
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

        function deletea(id){
    
 const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById(id).submit()
   
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
}
    </script>
@endsection