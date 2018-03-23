@extends('admin.admin')
@section('title','Images')
@section('description','myDescription to images info')
@section('keywords','myKeyWords to images info')
@section('admin_main_content')
    <div class="row text-center">
        <div class="col-12 m-lg-2 p-lg-3">
            <p class="h4 text-center mt-lg-1">Зображення</p>
            @foreach($images as $image)
                <div class="card d-inline-block m-1" style="width: 18rem;">
                    <img class="card-img-top w-75" src="{{url($image)}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$image}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection