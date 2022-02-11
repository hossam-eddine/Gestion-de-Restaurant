@extends("layouts.app")
@section("content")
<div class="container ">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-utensils"></i>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row justify-content-center ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div
                                                class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                                                <h3 class="text-secondary"><i class="fas fa-chart-bar"></i> Reports</h3>
                                                <a href="{{ route('report.index')}}" class="btn btn-outline-primary"><i
                                                        class="fas fa-chevron-circle-right"></i></a>

                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3 shadow mx-auto p-2">
                                                            <form action="{{ route('report.generate') }}" method="POST">
                                                                @csrf
                                                                <div class="form-group mt-2 ">
                                                                    <input type="date" name="from" id=""
                                                                        class="form-control" placeholder="start Date">
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <input type="date" name="to" id=""
                                                                        class="form-control" placeholder="end Date">
                                                                </div>
                                                                <div class="form-group mt-2 text-center">
                                                                    <button class="btn btn-sm btn-primary">Show
                                                                        report</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @isset($total)



                                            <h5 class="text-secondary font-weight-bold my-4 text-center">Report from
                                                {{$startdate}} to {{$enddate}}</h5>

                                            <table
                                                class=" table table-hover  align-middle table-bordered table-responsive-sm ">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Menu</th>
                                                    <th>Table</th>
                                                    <th>Servant</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Payment_Type</th>
                                                    <th>Payment_status</th>

                                                </thead>
                                                <tbody>
                                                    @foreach ($sales as $key=> $sale )
                                                    <tr>
                                                        <td>{{$key+=1}}</td>
                                                        <td>
                                                            @foreach ($sale->menus()->where('sale_id',$sale->id)->get()
                                                            as $item )
                                                            <div class="col-md-4 mb-2">
                                                                <div class="h-100">
                                                                    <div
                                                                        class=" d-flex flex-column justify-content-center align-items-center">

                                                                        <img src="{{ asset('images/menus/'.$item->image) }}"
                                                                            class="img-fluid rounded-circle" width="50"
                                                                            height="50" alt="{{$item->title}}">
                                                                        <h5 class="font-weight-bold mt-2">
                                                                            {{$item->title}}
                                                                        </h5>


                                                                    </div>
                                                                </div>
                                                            </div>



                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($sale->tables()->where('sale_id',$sale->id)->get()
                                                            as $item )
                                                            <div class="col-md-4 mb-2">
                                                                <div class=" h-100">
                                                                    <div
                                                                        class=" d-flex flex-column justify-content-center align-items-center">
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



                                                    </tr>
                                                    @endforeach

                                                </tbody>

                                            </table>
                                            <p class="text-danger text-center font-weight-bold">
                                                <span class="border border-danger">
                                                Total : {{$total}} DH    
                                                </span></div>
                                            </p>
                                            <form action="{{ route('report.export') }}" method="post">
                                                @csrf
                                                <div class="form-group mt-2 ">
                                                    <input type="hidden"  name="from" id="" 
                                                        class="form-control" value="{{$startdate}}">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="hidden" name="to" id=""
                                                        class="form-control" value="{{$enddate}}">
                                                </div>
                                                <div class="form-group mt-2 text-center">
                                                    <button class="btn btn-sm btn-success">export excel
                                                        </button>
                                                </div>
                                            </form>

                                            @endisset


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