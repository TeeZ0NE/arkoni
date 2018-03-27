@extends('admin.admin') @section('title','Items') @section('description','myDescription to items info') @section('keywords','myKeyWords to items info') @section('admin_main_content')
    <p class="h4 text-center mt-lg-1">Продуктів
        <small>в базі: {{ $count }} </small>
    </p>
    <div class="row">
        <div class="col-2 align-self-center">
            <strong>Створити</strong>
            <a href="{{ route('items.create') }}" class="btn btn-warning" role="button"><i class="fas fa-plus"></i></a>
        </div>
        <div class="col-10">
            <form method="get" action="{{ route('items.search') }}" role="search">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <strong>Шукати</strong>
                        <div class="form-group">
                            <input type="text" class="form-control d-inline w-75" placeholder="Шукати" name="q"
                                   value="{{ old("q") }}">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <strong>Сортувати</strong>
                        <div class="form-group">
                            <select class="custom-select  mr-sm-1 w-50" name="sort">
                                <option value="asc_iname" @if (old('sort')=='asc_iname') selected @endif>А-Я Назва
                                    товара
                                </option>
                                <option value="desc_iname" @if (old('sort')=='desc_iname') selected @endif>Я-А Назва
                                    товара
                                </option>
                                <option value="asc_brand" @if (old('sort')=='asc_brand') selected @endif>А-Я Виробник
                                </option>
                                <option value="desc_brand" @if (old('sort')=='desc_brand') selected @endif>Я-А
                                    Виробник
                                </option>
                                <option value="asc_price" @if (old('sort')=='asc_price') selected @endif>А-Я Ціна
                                </option>
                                <option value="desc_price" @if (old('sort')=='desc_price') selected @endif>Я-А Ціна
                                </option>
                                <option value="asc_enabled" @if (old('sort')=='asc_enabled') selected @endif>А-Я
                                    Виводиться
                                </option>
                                <option value="desc_enabled" @if (old('sort')=='desc_enabled') selected @endif>Я-А
                                    Виводиться
                                </option>
                            </select>
                            <button type="submit" class="btn btn-warning"><i class="fas fa-sort"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Виробник</th>
                    <th>Виводиться</th>
                    <th>URL</th>
                    <th>Ціна</th>
                    <th>Нова ціна</th>
                    <th>Створено</th>
                    <th>Змінено</th>
                    <th>Операції</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <span class="alert-info">RU</span> {{ $item->ru_name }}<br>
                            <span class="alert-info">UK</span> {{$item->uk_name}}</td>
                        <td>{{ $item->b_name }}</td>
                        <td>{{ $item->enabled }}</td>
                        <td>{{ $item->item_url_slug }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->old_price }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="text-center">
                            <form method="post" action="{{ route('items.destroy',$item->id) }}" class="mt-1 mb-1">
                                {{ csrf_field() }}
                                <a href="{{ route('items.edit',$item->id) }}" class="btn btn-warning m-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-secondary" type="submit"
                                        onclick="return confirm('Ви впевнені?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="border">
                                <p class="text-center border-bottom lead alert-warning">Опис</p>
                                <p class="p-2">{!!  $item->desc !!}</p>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="border">
                                <p class="text-center border-bottom lead alert-warning">Тегі</p>
                                <p class="p-2">N\A{{--$item->tags--}}</p>
                            </div>
                        </td>
                        <td colspan="2"><img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo"
                                             class="img-fluid"></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">Всього: {{ $items->total() }} на сторінці: {{ $items->count() }}
                        {{ $items->appends(['sort'=>$sort])->render() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
