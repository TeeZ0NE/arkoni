@extends('admin.admin')
@section('title','SubCategories')
@section('description','myDescription to subcategories info')
@section('keywords','myKeyWords to SubCategories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Створення підкатегорії</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('subcategory.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="input-group mb-3 mt-lg-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select_cat_id">Категорії</label>
                    </div>
                    <select class="custom-select" required name="cat_id" id="select_cat_id">
                        <option value="" selected>Оберіть категорію...</option>
                        @foreach ($cats as $cat)
                            <option value={{ $cat->cat_id }}>{{ $cat->ru_name }}</option>
                        @endforeach
                    </select>
                </div>

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
                                   aria-label="Название категории" aria-describedby="ru_name" name="ru_name" value="{{old('ru_name')}}" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">Заголовок вкладки</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{old('ru_title')}}" name="ru_title" maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Описание страницы</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="ru_desc">{{old('ru_desc')}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-ru">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-ru" value="{{old('ru_h1')}}" name="ru_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-ru">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-ru" value="{{old('ru_h2')}}" name="ru_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control" aria-label="seo text"
                                      name="ru_seo_text"> {{old('ru_seo_text')}}</textarea>
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
                                   value="{{old('uk_name')}}" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru">Заголовок вкладки</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="{{old('uk_title')}}" name="uk_title" maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Опис сторінки</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="uk_desc">{{old('uk_desc')}}</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-uk">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-uk" value="{{old('uk_h1')}}" name="uk_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-uk">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-uk" value="{{old('uk_h2')}}" name="uk_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control" aria-label="seo text"
                                      name="uk_seo_text"> {{old('uk_seo_text')}}</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
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
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection