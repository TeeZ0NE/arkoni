@extends('admin.admin')
@section('title','Редагувати блог')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Редагування статті блогу</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('blog.update', $id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <div class="input-group mb-3 mt-lg-2">
                    <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="cat-name-ru"><strong>Назва<sup>*</sup></strong></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Заголовок (назва статті)"
                           aria-label="Зазва категорії" aria-describedby="cat-name-uk"
                           value="@if(old('title')){{old('title')}}@else{{$blog->title}}@endif" name="title"
                           maxlength="100">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Текст статті<sup>*</sup></strong></span>
                    </div>
                    <textarea class="form-control editor" aria-label="body of article"
                              name="body" rows="5">@if(old('body')){{old('body')}}@else{{$blog->body}}@endif</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                    </div>
                    <select class="custom-select" id="item_enabled" name="published">
                        <option @if($blog->published) selected @endif value="1">Так</option>
                        <option @if(!$blog->published) selected @endif value="0">Ні</option>
                    </select>
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
                           value="@if(old('url_slug')){{old('url_slug')}}@else{{mb_substr($blog->url_slug,2)}}@endif" required name="url_slug" maxlength="255">
                </div>
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Завантажуйте зображення розміром більше
                    300 px для коректного їх відображення</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Фото</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="img_upload" name="img_upload">
                        <label class="custom-file-label" for="img_upload">Оберіть файл</label>
                    </div>
                </div>
                <img src="{{asset('storage/img').'/'.$blog->photo}}" alt="item photo"
                     class="img-thumbnail d-block mx-auto mb-3">
                 <div class="col-12 text-center">
                    <a href="{{route('blog.index')}}" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> До статей</a>
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection