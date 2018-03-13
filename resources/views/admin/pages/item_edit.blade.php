@extends('admin.admin')
@section('title','Items')
@section('description','myDescription to items info')
@section('keywords','myKeyWords to items info')
@section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Додати новий продукт</p>
    <div class="row justify-content-center">
        <div class="col col-lg-8">

            <form method="post" action="{{ route('items.update',$id) }}" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ru" role="tab"
                           aria-controls="ru-language" aria-selected="true">RU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#uk" role="tab"
                           aria-controls="uk-language" aria-selected="false">UK</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ru" role="tabpanel" aria-labelledby="ru-language-tab">
                        {{--RU--}}
                        {{-- item name --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                    <span class="input-group-text" id="ru-item-name">Название продукта
                    </span>
                            </div>
                            <input type="text" class="form-control" id="ru-item-name" placeholder="Название продукта"
                                   name="ru_name" value="{{ $item->getRuItem['ru_name']  }}"
                                   aria-label="Название продукта"
                                   aria-describedby="ru-item-name" maxlength="255">
                        </div>
                        {{-- Description --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Описание</span>
                            </div>
                            <textarea class="form-control" aria-label="description"
                                      name="ru_desc">{{ $item->getRuItem['desc'] }}</textarea>
                        </div>
                        {{--/RU--}}
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-language-tab">
                        {{--UK--}}
                        {{-- item name --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                    <span class="input-group-text" id="uk-item-name">Назва продукта
                    </span>
                            </div>
                            <input type="text" class="form-control" id="uk-item-name" placeholder="Назва продукта"
                                   name="uk_name" value="{{ $item->getUkItem['uk_name'] }}" aria-label="Назва продукта"
                                   aria-describedby="uk-item-name" maxlength="255">
                        </div>
                        {{-- Description --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Опис</span>
                            </div>
                            <textarea class="form-control" aria-label="description"
                                      name="uk_desc">{{ $item->getUkItem['desc'] }}</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>

                {{-- Brand --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="brands">Виробник</label>
                    </div>
                    <select class="custom-select" id="brands" required name="brand_id">
                        <option selected value="">Оберіть...</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                    @if ($brand->id == $item->brand_id) selected @endif
                            >{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Enabled --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                    </div>
                    <select class="custom-select" id="item_enabled" name="enabled">
                        <option value="1" @if ($item->enabled==1) selected @endif>Так</option>
                        <option value="0" @if($item->enabled==0) selected @endif>Ні</option>
                    </select>
                </div>
                {{-- Price --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price">Ціна продукта
                    </span>
                    </div>
                    <input type="number" class="form-control" id="item-price" placeholder="Ціна продукта" name="price"
                           value="{{ $item->price }}" aria-label="Ціна продукта" aria-describedby="item-price"
                           step="any">
                </div>
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Якщо ціни не співпадають, це виведеться
                    на сайті, при умові виведення товара
                    <small>попередній параметр</small>
                </p>
                {{-- New price --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price-new">Нова ціна
                    </span>
                    </div>
                    <input type="number" class="form-control" id="item-price-new" placeholder="Нова ціна продукта"
                           name="new_price" value="{{ $item->new_price }}" aria-label="Ціна продукта"
                           aria-describedby="item-price-new" step="any">
                </div>
                {{-- Categories --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="categories">Категорії</label>
                    </div>
                    <select class="custom-select" multiple size="4" name="sub_categories[]">
                        @foreach ($sub_cats as $sc)
                            <option value="{{ $sc->id }}" @if (in_array($sc->id,$item_cats)) selected @endif>
                                {{ $sc->ru_name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Tags --}}
                <select class="custom-select" id="tags" name="tags">
                    <option selected value="" disabled>Оберіть...</option>
                    {{--@foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach--}}
                    <option value="">Tags not added yet</option>
                </select>
                {{-- Attrs --}}
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> При співпадінні назв атрибутів, в базу
                    буде записанний останній</p>

                <div class="alert alert-dark">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="attribures">Аттрибути</label>
                        </div>
                        <select class="custom-select" id="attrs">
                            <option selected value="">Оберіть...</option>
                            @foreach ($attrs as $attr)
                                <option value="{{ $attr->id }}">{{ $attr->ru_name }}</option>
                            @endforeach
                        </select>
                        <a href="#" class="btn btn-primary add_attr" role="button"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="input-group" id="attr_block">
                        @foreach($item_attrs as $ia)
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{$ia->attributesLang['ru_name']}}</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Параметри" name="values[]"
                               aria-label="{{$ia->attributesLang['ru_name']}}" aria-describedby="item-name"
                               value="{{$ia->value}}" required>
                        <input type="hidden" name="attrs[]" value="{{$ia->attr_id}}">
                        <a href="#" class="btn btn-danger remove_attr"
                           onclick="javascript:void(0);"><i class="fas fa-trash-alt"> </i>
                        </a>
                    </div>
                @endforeach
                    </div>
                </div>
                {{--url slug--}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="item-url-slug">URL</span>
                    </div>
                    <input type="text" class="form-control" placeholder="URL"
                           aria-label="url" aria-describedby="url-slug"
                           value="{{mb_substr($item->item_url_slug,2)}}" required name="item_url_slug">
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
                <img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo"
                     class="img-thumbnail d-block mx-auto mb-3">
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