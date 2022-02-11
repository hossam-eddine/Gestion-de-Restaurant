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
                    <h3 class="text-secondary"><i class="fas fa-plus"></i> Update Menu</h3>

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
                 <form action="{{ route('menus.update',$menu->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
               @method("PUT")
                    <div class="mb-3 ">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{$menu->title}}">
    
                    </div>
                    <div class=" input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" name="price" id="" class="form-control"  placeholder="Price" value="{{$menu->price}}">
                        <div class="input-group-append">
                            <div class="input-group-text">.00</div>
                        </div>
                      
                    </div>
               
                
                
                  
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            @foreach ($categories as $cat )
                                
                            
                            <option
                            {{$cat->id==$menu->category_id ? "selected" :""}}
                            
                            value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                            
                          </select>
                    </div>
                    <div class="mb-3  input-group">
                       
                        <input class="form-control" type="file" id="formFile" name="image" value="{{$menu->image}}" >
                        <div class="input-group-append">
                            <div class="input-group-text"><img src="{{ asset('images/menus/'.$menu->image)}}" alt="" class="img-fluid" width="60" height="60" id="preview">
                            </div>
                        </div>
                    </div>
            
                

                  <div class="mb-3">
                    
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a  description here" id="floatingTextarea" name="description" >{{$menu->description}}</textarea>
                        <label for="floatingTextarea">Description</label>
                      </div>
                  </div>
                

                <div class="text-center">
                    <button type="submit" class="btn btn-success" >Update</button>
                    
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
@section("script")
<script>
    
   
    document.getElementById('formFile').onchange = function () {
        
    document.getElementById("preview").src=window.URL.createObjectURL(this.files[0]);
};
    
</script>
    
@endsection