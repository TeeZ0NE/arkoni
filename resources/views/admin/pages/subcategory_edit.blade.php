@extends('admin.admin')
@section('title','SubCategories')
@section('description','myDescription to subcategories info')
@section('keywords','myKeyWords to SubCategories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Редагування підкатегорії</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('subcategory.update',$id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PUT">
                <div class="input-group mb-3 mt-lg-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="select_cat_id"><strong>Категорії<sup>*</sup></strong></label>
                    </div>
                    <select class="custom-select" required name="cat_id" id="select_cat_id">
                        <option value="" selected>Оберіть категорію...</option>
                        @foreach ($cats as $cat)
                            <option value={{ $cat->cat_id }} @if ($sub_cat->cat_id == $cat->cat_id)selected @endif>{{ $cat->ru_name }}
                            </option>
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
                                <span class="input-group-text" id="cat-name-ru"><strong>Название<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Название пoдкатегории"
                                   aria-label="Название категории" aria-describedby="ru_name" name="ru_name"
                                   value="@if(old('ru_name')){{old('ru_name')}}@else{{$sub_cat->RuSubCategory['name']}}@endif" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru"><strong>Title<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="@if(old('ru_title')){{old('ru_title')}}@else{{$sub_cat->RuSubCategory['title']}}@endif"
                                   name="ru_title" maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="ru_desc" rows="5" maxlength="255">@if(old("ru_desc")){{old("ru_desc")}}@else{{$sub_cat->RuSubCategory['description']}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-ru">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-ru" value="@if(old('ru_h1')){{old('ru_h1')}}@else{{$sub_cat->RuSubCategory['h1']}}@endif" name="ru_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text"
                                      name="ru_seo_text" rows="5">@if(old('ru_seo_text')){{old('ru_seo_text')}}@else{{$sub_cat->RuSubCategory['seo_text']}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-ru">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-ru" value="@if(old('ru_h2')){{old('ru_h2')}}@else{{$sub_cat->RuSubCategory['h2']}}@endif" name="ru_h2">
                        </div>
                         <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст 2</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text 2"
                                      name="ru_seo_text_2" rows="5"> @if(old('ru_seo_text_2')){{old('ru_seo_text_2')}}@else{{$sub_cat->RuSubCategory['seo_text_2']}}@endif</textarea>
                        </div>
                        {{--/RU--}}
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="profile-tab">
                        {{--UK--}}
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-name-ru"><strong>Назва<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Назва підкатегорії"
                                   aria-label="Название категории" aria-describedby="cat-name-uk"
                                   value="@if(old('uk_name')){{old('uk_name')}}@else{{$sub_cat->UkSubCategory['name']}}@endif" name="uk_name" maxlength="255">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-title-ru"><strong>Title<sup>*</sup></strong></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Title" aria-label="Заголовок вкладки"
                                   aria-describedby="cat-title-ru" value="@if(old('uk_title')){{old('uk_title')}}@else{{$sub_cat->UkSubCategory['title']}}@endif"
                                   name="uk_title" maxlength="70">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" aria-label="Page description"
                                      name="uk_desc" rows="5" maxlength="250">@if(old('uk_desc')){{old('uk_desc')}}@else{{$sub_cat->UkSubCategory['description']}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h1-uk">H1</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h1" aria-label="Заголовок h1"
                                   aria-describedby="cat-h1-uk" value="@if(old('uk_h1')){{old('uk_h1')}}@else{{$sub_cat->UkSubCategory['h1']}}@endif" name="uk_h1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text"
                                      name="uk_seo_text" rows="5">@if(old('uk_seo_text')){{old('uk_seo_text')}}@else{{$sub_cat->UkSubCategory['seo_text']}}@endif</textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="cat-h2-uk">H2</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Заголовок h2" aria-label="Заголовок h2"
                                   aria-describedby="cat-h2-uk" value="@if(old('uk_h2')){{old('uk_h2')}}@else{{$sub_cat->UkSubCategory['h2']}}@endif" name="uk_h2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SEO текст 2</span>
                            </div>
                            <textarea class="form-control editor" aria-label="seo text"
                                      name="uk_seo_text_2" rows="5">@if(old('uk_seo_text_2')){{old('uk_seo_text_2')}}@else{{$sub_cat->UkSubCategory['seo_text_2']}}@endif</textarea>
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
                           value="@if(old('sub_cat_url_slug')){{old('sub_cat_url_slug')}}@else{{mb_substr($sub_cat->sub_cat_url_slug,2)}}@endif" required name="sub_cat_url_slug" maxlength="250">
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
                <img src="{{asset('storage/img').'/'.$sub_cat->sub_cat_photo}}" alt="item photo"
                     class="img-thumbnail d-block mx-auto mb-3">
                <div class="col text-center">
                    <a href="{{route('subcategory.index')}}" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> До підкатегорій</a>
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection
