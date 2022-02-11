@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card   bg-transparent logo ">
             

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4  d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-clipboard-list fa-5x text-primary logo"></i>
                            <a href="{{route('report.index')}}" class=" mt-2 font-weight-bold btn btn-link text-decoration-none ">Reports</a>
                        </div>
                        <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-cash-register fa-5x text-warning logo"></i>
                            <a href="{{route('payment.index')}}" class="mt-2 font-weight-bold btn btn-link text-decoration-none">Payment</a>
                        </div>
                        <div class="col-sm-4 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-cogs fa-5x text-secondary logo"></i>
                            <a href="{{route('categories.index')}}" class="mt-2 font-weight-bold btn btn-link text-decoration-none">Manage</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    gsap.from(".logo",{duration:2,y:"random(-200,200)",x:"random(-100,200)",opacity:0,stagger:0.25})
</script>
    
@endsection