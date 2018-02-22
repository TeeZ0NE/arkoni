@extends('admin.admin')
@section('title','Items')
@section('description','myDescription to items info')
@section('keywords','myKeyWords to items info')
@section('admin_main_content')
<p class="h4 text-center mt-lg-1">Додати новий продукт</p>
<div class="row justify-content-center">
    <div class="col col-lg-8">

        <form method="post" action="{{ route('items.store') }}" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- item name --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-name">Назва продукта
                    </span>
                </div>
                <input type="text" class="form-control" id="item-name" placeholder="Назва продукта" name="name" required value="{{ old('name') }}" aria-label="Назва продукта" aria-describedby="item-name">
            </div>
            {{-- Brand --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="brands">Виробник</label>
                </div>
                <select class="custom-select" id="brands" required name="brand_id">
                    <option selected value="">Оберіть...</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Enabled --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                </div>
                <select class="custom-select" id="item_enabled" required name="enabled">
                    <option selected value="1">Так</option>
                    <option value="0">Ні</option>
                </select>
            </div>
            {{-- Price --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price">Ціна продукта
                    </span>
                </div>
                <input type="number" class="form-control" id="item-price" placeholder="Ціна продукта" name="price" required value="{{ old('price') }}" aria-label="Ціна продукта" aria-describedby="item-price" step="any">
            </div>
            <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Якщо ціни не співпадають, це виведеться на сайті, при умові виведення товара <small>попередній параметр</small></p>
            {{-- New price --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price-new">Нова ціна
                    </span>
                </div>
                <input type="number" class="form-control" id="item-price-new" placeholder="Нова ціна продукта" name="price_new" required value="{{ old('price_new') }}" aria-label="Ціна продукта" aria-describedby="item-price-new" step="any">
            </div>
            {{-- Categories --}}
            <div class="alert alert-dark">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="categories">Категорії</label>
                    </div>
                    <select class="custom-select" id="cats">
                        <option selected value="">Оберіть...</option>
                        @foreach ($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <a href="#" class="btn btn-primary add_cat" role="button"><i class="fas fa-plus"></i></a>
                </div>
                <div class="input-group"  id="cat_block">Категорії:</div>
            </div>
            {{-- Description --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Опис</span>
                </div>
                <textarea class="form-control" aria-label="description" name="desc">{{ old('desc') }}</textarea>
            </div>
            {{-- Tags --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Пошукові теги</span>
                </div>
                <textarea class="form-control" aria-label="description" name="tags">{{ old('tags') }}</textarea>
            </div>
            {{-- Attrs --}}
            <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> При співпадінні назв атрибутів, в базу буде записанний останній</p>
            <div class="alert alert-dark">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="attribures">Аттрибути</label>
                    </div>
                    <select class="custom-select" id="attrs" name="attr_id">
                        <option selected value="">Оберіть...</option>
                        @foreach ($attrs as $attr)
                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                        @endforeach
                    </select>
                    <a href="#" class="btn btn-primary add_attr" role="button"><i class="fas fa-plus"></i></a>
                </div>
                <div class="input-group"  id="attr_block"></div>
            </div>

            {{-- Photo --}}
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
<script type="text/javascript">

    // // add category checkbox
    // $('.add_cat').on('click',function(event){
    //     event.preventDefault();
    //     var id = $('#cats').val();
    //     if (id=='') return;
    //     var opt_text = $('#cats :selected').text();
    //     $('#cat_block').append('<input type="checkbox" name="cats[]" value="'+id+'" checked class="ml-1">'+opt_text);
    // })

    // // add input field for adding attributes and own values
    // $('.add_attr').on('click',function(event){
    //     event.preventDefault();
    //     var id = $('#attrs').val();
    //     if (id=='') return;
    //     var opt_text = $('#attrs :selected').text();
    //     $('#attr_block').append('<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text">'+opt_text+'</span></div><input type="text" class="form-control" placeholder="Параметри" name="values[]" aria-label="'+opt_text+'" aria-describedby="item-name"><input type="hidden" name="attrs[]" value="'+id+'"><a href="#" class="btn btn-danger remove_attr" onclick="javascript:void(0);"><i class="fas fa-trash-alt"></a></div>');
    // });

    // // remove input field from attributes
    // $(document).on('click','a.remove_attr',function(event){
    //     event.preventDefault();
    //     $(this).parent().remove();
    // })

    // // change label on getting file in admin
    // $('#img_upload').on('change',function(){
    //     var file_name = $(this).val().split('\\').slice(-1)[0];
    //     $(this).next('.custom-file-label').html(file_name);
    // })
</script>
@endsection