@extends('admin.admin')
@section('title','SubCategories')
@section('description','myDescription to subcategories info')
@section('keywords','myKeyWords to SubCategories info')
@section('admin_main_content')

    <p class="h4 text-center mt-lg-1">Категорії
        <small>в базі: {{ $count }}</small>
    </p>
    <div class="row">
        <div class="col-12 col-lg-2">
            <strong>Додати</strong>
            <br>
            <a href="{{ route('subcategory.create') }}" class="btn btn-primary" role="button"><i
                        class="fas fa-plus"></i></a>
        </div>
        <div class="col col-lg-10">
            <form method="get" action="{{ route('subcategory.search') }}" role="search">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <strong>Шукати</strong>
                        <div class="form-group">
                            <input type="text" class="form-control d-inline w-75" placeholder="Назва категорії" name="q"
                                   value="{{ old("q") }}">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <strong>Сортувати</strong>
                        <div class="form-group">
                            <select class="selectpicker mr-sm-1" name="sort">
                                <option value="asc" @if (old('sort')=='asc') selected @endif>А-Я</option>
                                <option value="desc" @if (old('sort')=='desc') selected @endif>Я-А</option>
                            </select>
                            <button type="submit" class="btn btn-info"><i class="fas fa-sort"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <table class="table">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th scope="col" class="align-middle">ID</th>
                    <th scope="col">Назва підкатегорії</th>
                    <th scope="col">Категорія</th>
                    <th scope="col">Фото</th>
                    <th scope="col" class="align-middle">Операції</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subcats as $subcat)
                    <tr>
                        <td rowspan="2" class="align-middle text-center">{{$subcat->id}}</td>
                        <td><span class="alert-info">RU</span> {{$subcat->ru_name}}</td>
                        <td>{{$subcat->c_ru_name}}</td>
                        <td rowspan="2" class="align-middle text-center">
                            <img src="{{asset('storage/img').'/'.$subcat->sub_cat_photo}}" alt="item photo"
                                 class="img-thumbnail w-25">
                        </td>
                        <td rowspan="2" class="align-middle">
                            <form method="post" action="{{ route('subcategory.destroy',$subcat->id) }}"
                                  class="form-inline justify-content-end">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Ви впевнені?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="{{route('subcategory.edit',$subcat->id)}}"
                                   class="btn btn-info change-category ml-1">
                                    <i class="fas fa-pencil-alt"></i></a>
                            </form>
                        </td>
                    </tr>
                    <tr>

                        <td><span class="alert-info">UK</span> {{$subcat->uk_name}}</td>
                        <td>{{$subcat->c_uk_name}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">Всього: {{ $subcats->total() }} на сторінці: {{ $subcats->count() }}
                    </td>
                    <td>{{ $subcats->appends(['sort'=>$sort])->render() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script type="text/javascript">
    </script>
@endsection
