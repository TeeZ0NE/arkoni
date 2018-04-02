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
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                    <span class="input-group-text" id="ru-item-name">
                        <strong>Название продукта<sup>*</sup></strong>
                    </span>
                            </div>
                            <input type="text" class="form-control" id="ru-item-name" placeholder="Название продукта"
                                   name="ru_name" value="{{old('ru_name')}}" aria-label="Название продукта"
                                   aria-describedby="ru-item-name" maxlength="255">
                        </div>
                        {{-- Description --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Описание<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control editor" aria-label="description"
                                      name="ru_desc" rows="5">{{old('ru_desc')}}</textarea>
                        </div>
                        {{--/RU--}}
                    </div>
                    <div class="tab-pane fade" id="uk" role="tabpanel" aria-labelledby="uk-language-tab">
                        {{--UK--}}
                        {{-- item name --}}
                        <div class="input-group mb-3 mt-lg-2">
                            <div class="input-group-prepend">
                    <span class="input-group-text" id="uk-item-name">
                        <strong>Назва продукта<sup>*</sup></strong>
                    </span>
                            </div>
                            <input type="text" class="form-control" id="uk-item-name" placeholder="Назва продукта"
                                   name="uk_name" value="{{old('uk_name')}}" aria-label="Назва продукта"
                                   aria-describedby="uk-item-name" maxlength="255">
                        </div>
                        {{-- Description --}}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><strong>Опис<sup>*</sup></strong></span>
                            </div>
                            <textarea class="form-control editor" aria-label="description"
                                      name="uk_desc" rows="5">{{old('uk_desc')}}</textarea>
                        </div>
                        {{--/UK--}}
                    </div>
                </div>
                {{-- Brand --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="brands"><strong>Виробник<sup>*</sup></strong></label>
                    </div>
                    <select class="custom-select" id="brands" required name="brand_id">
                        <option selected value="">Оберіть...</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                    @if ($brand->id == old('brand_id')) selected @endif> {{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Enabled --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="item_enabled">Виводиться на сайті</label>
                    </div>
                    <select class="custom-select" id="item_enabled" name="enabled">
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
                    @php $price = (old('price'))?old('price'):'0.00' @endphp
                    <input type="number" class="form-control" id="item-price" placeholder="Ціна продукта" name="price"
                           value="{{ $price }}" aria-label="Ціна продукта" aria-describedby="item-price"
                           step="0.01">
                </div>
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> При заповненні поля "Стара ціна" на
                    сайті зявитсья перекреслена ціна, поруч із основною. Цe поле повинно бути завжди більше основної
                    ціни.
                </p>
                {{-- New price --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="item-price-new">Стара ціна&nbsp;<small> (перекпеслена)</small>
                    </span>
                    </div>
                    @php $new_price = (old('old_price'))?old('old_price'):'0.00' @endphp
                    <input type="number" class="form-control" id="item-price-new" placeholder="Нова ціна продукта"

                           name="old_price" value="{{$new_price}}"
                           aria-label="Перекреслена ціна продукта"
                           aria-describedby="item-price-new" step="0.01">
                </div>
                {{-- Categories --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="categories">
                            <strong>Категорії<sup>*</sup></strong></label>
                    </div>
                    <select class="custom-select" multiple size="4" name="sub_categories[]" required>
                        @foreach ($sub_cats as $sc)
                            <option value="{{ $sc->id }}"
                                    @if(old('sub_categories'))
                                    @if (in_array($sc->id,old('sub_categories'))) selected @endif @endif>
                                {{ $sc->ru_name }} ({{$sc->cat_name}})
                            </option>
                        @endforeach
                    </select>
                </div>
                {{--Shortcuts--}}
                <div class="mb-3">
                    <p class="alert alert-secondary">Ярлики</p>
                    @foreach($shortcuts as $shortcut)
                        <div class="form-check  form-check-inline">
                            <input type="checkbox" class="form-check-input" id="sh-{{$shortcut->id}}" name="shortcuts[]"
                                   value="{{$shortcut->id}}">
                            <label class="form-check-label" for="sh-{{$shortcut->id}}">{{$shortcut->name}}</label>
                        </div>
                    @endforeach
                </div>
                {{-- Tags --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="categories">Теги</label>
                    </div>
                    <select class="custom-select" multiple size="4" name="tags[]">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                    @if(old('tags'))@if (in_array($tag->id,old('tags'))) selected @endif @endif>{{ $tag->getRuTagsName['ru_name'] }}</option>
                        @endforeach
                    </select>
                </div>
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
                                <option value="{{ $attr->id }}">{{$attr->ru_name}}</option>
                            @endforeach
                        </select>
                        <a href="#" class="btn btn-warning add_attr" role="button"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="input-group" id="attr_block"></div>
                </div>
                {{-- Photo --}}
                <p class="alert alert-info p-0 pl-md-2"><strong>Увага!</strong> Завантажуйте зображення розміром більше
                    300 px для коректного їх відображення</p>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Фото</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="img_upload" name="img_upload" accept="image/*">
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