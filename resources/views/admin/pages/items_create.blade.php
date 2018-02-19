@extends('admin.admin')
@section('title','Items')
@section('description','myDescription to items info')
@section('keywords','myKeyWords to items info')
@section('admin_main_content')
<p class="h4 text-center mt-lg-1">Додати новий продукт</p>
<div class="row justify-content-center">
    <div class="col col-lg-8">

        <form method="post" action="{{ route('items.store') }}" class="form">
            {{ csrf_field() }}

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-name">Назва продукта
                    </span>
                </div>
                <input type="text" class="form-control" id="item-name" placeholder="Назва продукта" name="name" required value="{{ old('name') }}" aria-label="Назва продукта" aria-describedby="item-name">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="brands">Виготовник</label>
                </div>
                <select class="custom-select" id="brands" required name="brand_id">
                    <option selected value="">Оберіть...</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                </div>
                <select class="custom-select" id="item_enabled" required name="enabled">
                    <option selected value="1">Так</option>
                    <option value="0">Ні</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price">Ціна продукта
                    </span>
                </div>
                <input type="number" class="form-control" id="item-price" placeholder="Ціна продукта" name="price" required value="{{ old('price') }}" aria-label="Ціна продукта" aria-describedby="item-price" step="any">
            </div>
            <p class="alert alert-info p-0"><strong>Увага!</strong> Якщо ціни не співпадають, це виведеться на сайті</p>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price-new">Нова ціна
                    </span>
                </div>
                <input type="number" class="form-control" id="item-price-new" placeholder="Нова ціна продукта" name="price_new" required value="{{ old('price_new') }}" aria-label="Ціна продукта" aria-describedby="item-price-new" step="any">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="categories">Категорії</label>
                </div>
                <select class="custom-select" id="cats" required name="cat_id">
                    <option selected value="">Оберіть...</option>
                    @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <a href="#" class="btn btn-primary add_cat" role="button"><i class="fas fa-plus"></i></a>
            </div>
            <div class="input-group"  id="cat_block"></div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Опис</span>
                </div>
                <textarea class="form-control" aria-label="description" name="desc">{{ old('desc') }}</textarea>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Пошукові теги</span>
                </div>
                <textarea class="form-control" aria-label="description" name="tags">{{ old('tags') }}</textarea>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="attribures">Аттрибути</label>
                </div>
                <select class="custom-select" id="attrs" required name="attr_id">
                    <option selected value="">Оберіть...</option>
                    @foreach ($attrs as $attr)
                    <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                    @endforeach
                </select>
                <a href="#" class="btn btn-primary add_attr" role="button"><i class="fas fa-plus"></i></a>
            </div>
            <div class="input-group"  id="attr_block">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for attribute" value="attr_id">text
                    </div>
                </div>
                <input type="text" class="form-control" aria-label="Text input with attribute checkbox" name="attr_value">
            </div>
            </div>


            <div class="col text-center">
              <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Зберегти</button>
          </div>
      </form>
  </div>
</div>
<script type="text/javascript">
    $('.add_cat').on('click',function(event){
        event.preventDefault();
        var id = $('#cats').val();
        if (id=='') return;
        var opt_text = $('#cats :selected').text();
        console.log($('#cats').val(),'-',$('#cats :selected').text());
        $('#cat_block').append('<input type="checkbox" name="cats[]" value="'+id+'" checked class="ml-1">'+opt_text);
    })
</script>
@endsection