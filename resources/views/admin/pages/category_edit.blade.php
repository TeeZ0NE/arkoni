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
                                <span class="input-group-text" id="cat-name-ru">Название</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Название категории"
                                   aria-label="Название категории" aria-describedby="ru_name"
                                   value="{{$cat->RuCategory->ru_name}}" required name="ru_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">Заголовок вкладки</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{$cat->RuCategory->title}}" name="ru_title"
                                   maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Описание страницы</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      required name="ru_desc" maxlength="255">{{$cat->RuCategory->desc}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-ru">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-ru" value="{{$cat->RuCategory->h1}}" name="ru_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-ru">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-ru" value="{{$cat->RuCategory->h2}}" name="ru_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control" aria-label="seo text"
                                      name="ru_seo_text"> {{$cat->RuCategory->seo_text}}</textarea>
                        </div>
                        {{--/RU--}}
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="profile-tab">
                        {{--UK--}}
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-name-ru">Назва</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Название категории"
                                   aria-label="Название категории" aria-describedby="cat-name-uk"
                                   value="{{$cat->UkCategory->uk_name}}" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">Заголовок вкладки</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{$cat->UkCategory->title}}" required
                                   name="uk_title">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Опис сторінки</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      required name="uk_desc">{{$cat->UkCategory->desc}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-uk">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-uk" value="{{$cat->UkCategory->h1}}" name="uk_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-uk">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-uk" value="{{$cat->UkCategory->h2}}" name="uk_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control" aria-label="seo text"
                                      name="uk_seo_text"> {{$cat->UkCategory->seo_text}}</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="cat-url-slug">URL</span>
                    </div>
                    <input type="text" class="form-control" placeholder="URL"
                           aria-label="url" aria-describedby="url-slug"
                           value="{{$cat->cat_url_slug}}" required name="cat_url_slug">
                </div>
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
                    <a href="{{route('cats.index')}}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> До категорій</a>
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Зберегти</button>
                    <a href="{{route('cat.destroy',$cat->id)}}" class="btn btn-danger"
                       onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i> Видалити</a>
                </div>
            </form>
        </div>
    </div>
@endsection