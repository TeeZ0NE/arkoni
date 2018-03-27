@extends('admin.admin')
@section('title','Створення тегів')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Зміна тегів</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('tags.update',$id)}}">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">
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
                                   value="
@if(old('ru_name')){{old('ru_name')}}@else {{$tags->getRuTag['ru_name']}} @endif"
                                   name="ru_name" maxlength="200">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">
                                    <strong>Title<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="
@if(old('ru_title')){{old('ru_title')}}@else{{$tags->getRuTag['title']}}@endif" name="ru_title"
                                   maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="ru_description" maxlength="255" rows="5">@if(old('ru_description')){{old('ru_description')}} @else {{$tags->getRuTag['description']}}@endif</textarea>
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
                                   value="@if(old('uk_name')){{old('uk_name')}}@else{{$tags->getUkTag['uk_name']}}@endif" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">
                                    <strong>Title<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="@if(old('uk_title')){{old('uk_title')}}@else{{$tags->getUkTag['title']}}@endif" name="uk_title"
                                   maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="uk_description" maxlength="255" rows="5">@if(old('uk_description')){{old('uk_description')}}@else{{$tags->getUkTag['description']}}@endif</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>
                {{--url slug--}}
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Поле URL бажано не редагувати після
                    створення сторінки, це може викликати небажані наслідки в структурі сайту.</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="item-url-slug"><strong>URL<sup>*</sup></strong></span>
                    </div>
                    <input type="text" class="form-control" placeholder="URL"
                           aria-label="url" aria-describedby="url-slug"
                           value="{{mb_substr($tags->tag_url_slug,2)}}" required name="tag_url_slug">
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection