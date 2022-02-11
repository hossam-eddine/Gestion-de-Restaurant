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
                    <h3 class="text-secondary"><i class="fas fa-user-plus"></i> Add Servants</h3>

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
                 <form action="{{ route('servants.store') }}" method="POST">
                @csrf
                <div class="mb-3 ">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">

                </div>
                <div class="mb-3 ">
                    <input type="text" name="adress" id="adress" class="form-control" placeholder="Adress">

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
