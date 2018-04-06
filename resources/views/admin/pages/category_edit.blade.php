@extends('admin.admin')
@section('title','Categories')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Редагування категорії</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('cat.update')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$id}}">
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
                            <input type="text" class="form-control" placeholder="Название категории"
                                   aria-label="Название категории" aria-describedby="ru_name"
                                   value="@if(old('ru_name')){{old('ru_name')}}@else{{$cat->RuCategory->ru_name}}@endif" required name="ru_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">
                                    <strong>Title<sup>*</sup></strong>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="title"
                                   aria-describedby="cat-title-ru" value="@if(old('ru_title')){{old('ru_title')}}@else{{$cat->RuCategory->title}}@endif" name="ru_title"                                        maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <strong>Description<sup>*</sup></strong>
                                </span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      required name="ru_desc" maxlength="255"
                                      rows="5">@if(old('ru_desc')){{old('ru_desc')}}@else{{$cat->RuCategory->desc}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-ru">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-ru" value="@if(old('ru_h1')){{old('ru_h1')}}@else{{$cat->RuCategory->h1}}@endif" name="ru_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text"
                                      name="ru_seo_text" rows="5">@if(old('ru_seo_text')){{old('ru_seo_text')}}@else{{$cat->RuCategory->seo_text}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-ru">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-ru" value="@if(old('ru_h2')){{old('ru_h2')}}@else{{$cat->RuCategory->h2}}@endif" name="ru_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст 2</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text 2"
                                      name="ru_seo_text_2" rows="5">@if(old('ru_seo_text_2')){{old('ru_seo_text_2')}}@else{{$cat->RuCategory->seo_text_2}}@endif</textarea>
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
                            <input type="text" class="form-control" placeholder="Название категории"
                                   aria-label="Название категории" aria-describedby="cat-name-uk"
                                   value="@if(old('uk_name')){{old('uk_name')}}@else{{$cat->UkCategory->uk_name}}@endif" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="cat-title-ru"><strong>Title<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="@if(old('uk_title')){{old('uk_title')}}@else{{$cat->UkCategory->title}}@endif" required    name="uk_title">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Description<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      required name="uk_desc" rows="5">@if(old('uk_desc')){{old('uk_desc')}}@else{{$cat->UkCategory->desc}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-uk">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-uk" value="@if(old('uk_h1')){{old('uk_h1')}}@else{{$cat->UkCategory->h1}}@endif" name="uk_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text"
                                      name="uk_seo_text" rows="5">@if(old('uk_seo_text')){{old('uk_seo_text')}}@else{{$cat->UkCategory->seo_text}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-uk">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-uk" value="@if(old('uk_h2')){{old('uk_h2')}}@else{{$cat->UkCategory->h2}}@endif" name="uk_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст 2</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text 2"
                                      name="uk_seo_text_2" rows="5">@if(old('uk_seo_text_2')){{old('uk_seo_text')}}@else{{$cat->UkCategory->seo_text_2}}@endif</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Поле URL бажано не редагувати після створення сторінки, це може викликати небажані наслідки в структурі сайту.</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="cat-url-slug"><strong>URL<sup>*</sup></strong></span>
                    </div>
                    <input type="text" class="form-control" placeholder="URL"
                           aria-label="url" aria-describedby="url-slug"
                           value="@if(old('cat_url_slug')){{old('cat_url_slug')}}@else{{mb_substr($cat->cat_url_slug,2)}}@endif" required name="cat_url_slug" maxlength="250">
                </div>
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Завантажуйте зображення розміром більше 300 px для коректного їх відображення</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Фото</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="img_upload" name="img_upload">
                        <label class="custom-file-label" for="img_upload">Оберіть файл</label>
                    </div>
                </div>
                <img src="{{asset('storage/img').'/'.$cat->cat_photo}}" alt="item photo"
                     class="img-thumbnail d-block mx-auto mb-3">
                <div class="col-10 text-center">
                    <a href="{{route('cats.index')}}" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> До категорій</a>
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                    <a href="{{route('cat.destroy',$cat->id)}}" class="btn btn-secondary"
                       onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i> Видалити</a>
                </div>
            </form>
        </div>
    </div>
@endsection