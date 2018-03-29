@extends('admin.admin')
@section('title','Створення тегів')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Створення тегів</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('tags.store')}}">
                {{csrf_field()}}
                <ul class="nav nav-tabs" id="categoryTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ru" role="tab"
                           aria-controls="home" aria-selected="true">RU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#uk" role="tab"
                           aria-controls="profile" aria-selected="false">UK</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="home-tab">
                        {{--RU--}}
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-name-ru">
                                    <strong>Название<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Название тега"
                                   aria-label="Название тега" aria-describedby="ru_name"
                                   value="{{old('ru_name')}}" name="ru_name" maxlength="200">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">
                                    <strong>Title<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{old('ru_title')}}" name="ru_title"
                                   maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="ru_description" maxlength="255" rows="5">{{old('ru_description')}}</textarea>
                        </div>
                        {{--/RU--}}
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="profile-tab">
                        {{--UK--}}
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="cat-name-ru"><strong>Назва<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Назва тега"
                                   aria-label="Зазва тега" aria-describedby="cat-name-uk"
                                   value="{{old('uk_name')}}" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">
                                    <strong>Title<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{old('uk_title')}}" name="uk_title"
                                   maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="uk_description" maxlength="255" rows="5">{{old('uk_description')}}</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection