@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                  <div class="col-md-4">
                    @include("layouts.sidebar")
                    </div>
                    <div class="col-md-8">
                     <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                    <h3 class="text-secondary"><i class="fas fa-plus"></i> Add Table</h3>

                </div>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                 <form action="{{ route('tables.store') }}" method="POST">
                @csrf
                <div class="mb-3 ">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">

                </div>
                <div class="mb-3 ">
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected disabled>Status</option>
                        <option value="1">Empty</option>
                        <option value="0">Not Empty</option>
                        
                      </select>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary" >Add</button>
                    
                </div>
                </form>
                </div>
                </div>
                
                </div>
            </div>
        </div>
       
    </div>
</div>


@endsection
