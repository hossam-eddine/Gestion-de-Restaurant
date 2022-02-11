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
                    <h3 class="text-secondary"><i class="fas fa-plus"></i> Add Menu</h3>

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
                 <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                    <div class="mb-3 ">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
    
                    </div>
                    <div class=" input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" name="price" id="" class="form-control"  placeholder="Price">
                        <div class="input-group-append">
                            <div class="input-group-text">.00</div>
                        </div>
                      
                    </div>
               
                
                
                  <div class="row my-3">
                    <div class="col-md-6 ">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected disabled>Categories</option>
                            @foreach ($categories as $cat )
                                
                            
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                            
                          </select>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
            
                  </div>

                  <div class="mb-3">
                    
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a  description here" id="floatingTextarea" name="description"></textarea>
                        <label for="floatingTextarea">Description</label>
                      </div>
                  </div>
                

                <div class="text-center">
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
