@extends("layouts.app")
@section("content")
<div class="container ">
  <div class="accordion " id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-utensils"></i>
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="row justify-content-center ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                      <div class="col-md-4" >
                        @include("layouts.sidebar")
                        </div>
                        <div class="col-md-8">
                         <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                        <h3 class="text-secondary"><i class="fas fa-list "></i> Categories</h3>
                        <a href="{{ route('categories.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    
                    </div>
                    <table class=" table table-hover table-responsive-sm ">
                        <thead>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=> $cat )
                            <tr>
                                <td>{{$key+=1}}</td>
                                <td>{{$cat->title}}</td>
                                <td class="  d-flex flex-row justify-content-center align-items-center">                    
                                    <a href="{{ route('categories.edit',$cat->slug)}}" class="btn btn-warning  me-2">
                                        <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy',$cat->slug ) }}" class="" id="{{$cat->id}}" method="POST">
                                        @csrf
                                        @method("DELETE")
    
                                        </form>
                                        <button type="submit" class="btn btn-danger" onclick="deletea({{$cat->id}})"><i class="fas fa-trash-restore"></i></button>
    
                                    </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
            
                    </table>
                    <div class="my-3 d-flex justify-content-center align-items-center">
                      {{$categories->links()}}
    
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