@extends('admin.admin')
@section('title','Створити блог')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Створення статті блогу</p>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <form method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="input-group mb-3 mt-lg-2">
                    <div class="input-group-prepend">
                                <span class="input-group-text"
                                      id="cat-name-ru"><strong>Назва<sup>*</sup></strong></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Заголовок (назва статті)"
                           aria-label="Зазва категорії" aria-describedby="cat-name-uk"
                           value="{{old('title')}}" name="title" maxlength="100">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Текст статті<sup>*</sup></strong></span>
                    </div>
                    <textarea class="form-control editor" aria-label="body of article"
                              name="body" rows="5">{{old('body')}}</textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                    </div>
                    <select class="custom-select" id="item_enabled" name="published">
                        <option selected value="1">Так</option>
                        <option value="0">Ні</option>
                    </select>
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
                <div class="col text-center">
                    <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection