@extends('admin.admin')@section('title','Images')@section('description','myDescription to images info')@section('keywords','myKeyWords to images info')@section('admin_main_content')

        {{-- Photo --}}


        <form method="post" action="{{ route('image.store') }}" class="form row mt-3 mx-auto"
              enctype="multipart/form-data">{{ csrf_field() }}
            <div class="col-10">
                <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text">Додати фото на сервер</span></div>
                    <div class="custom-file"><input type="file" class="custom-file-input" id="img_upload"
                                                    name="img_upload"
                                                    accept="image/*">
                        <label class="custom-file-label" for="img_upload">Оберіть
                            файл
                        </label>
                    </div>
                </div>
            </div>
                <div class="col">
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Завантажити</button>
                </div>
        </form>



    <div class="row text-center">
        <div class="col-12 m-lg-2 p-lg-3"><p class="h4 text-center mt-lg-1">Зображення</p>@foreach($images as $image)
                <div class="card d-inline-block m-1" style="width: 18rem;"><img class="card-img-top w-75"
                                                                                src="{{url($image)}}"
                                                                                alt="Card image cap">
                    <div class="card-body"><p class="card-text"><a href="{{url($image)}}">{{$image}}</a></p></div>
                </div>@endforeach</div>
    </div>@endsection