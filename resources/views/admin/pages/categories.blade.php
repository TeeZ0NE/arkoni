@extends('admin.admin')
@section('title','Categories')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')

    <p class="h4 text-center mt-lg-1">Категорії
        <small>в базі: {{ $count }}</small>
    </p>

    <div class="row">
        <div class="col-12 col-lg-2">
            <strong>Додати</strong>
            <br>
            <a href="{{ route('cats.create') }}" class="btn btn-warning" role="button"><i
                        class="fas fa-plus"></i></a>
        </div>
        <div class="col col-lg-10">
            <form method="get" action="{{ route('cats.search') }}" role="search">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <strong>Шукати</strong>
                        <div class="form-group">
                            <input type="text" class="form-control d-inline w-75" placeholder="Назва категорії" name="q"
                                   value="{{ old("q") }}">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <strong>Сортувати</strong>
                        <div class="form-group">
                            <select class="custom-select mr-sm-1 w-50" name="sort">
                                <option value="asc" @if (old('sort')=='asc') selected @endif>А-Я</option>
                                <option value="desc" @if (old('sort')=='desc') selected @endif>Я-А</option>
                            </select>
                            <button type="submit" class="btn btn-warning"><i class="fas fa-sort"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th scope="col" rowspan="2" class="align-middle">ID</th>
                    <th scope="col" colspan="2">Назва категорії</th>
                    <th scope="col" rowspan="2" class="align-middle">Фото</th>
                    <th scope="col" rowspan="2" class="align-middle">Операції</th>
                </tr>
                <tr>
                    <th class="text-center">ru</th>
                    <th class="text-center">uk</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cats as $cat)
                    <tr>
                        <td class="align-middle">{{ $cat->id }}</td>
                        <td class="align-middle">{{$cat->ru_name}}</td>
                        <td class="align-middle">{{$cat->uk_name}}</td>
                        <td class="align-middle text-center">
                            <img src="{{asset('storage/img').'/'.$cat->cat_photo}}" alt="item photo" class="img-thumbnail w-25">
                        </td>
                        <td class="text-right align-middle">
                            <a href="{{route('cat.edit',$cat->id)}}" class="btn btn-warning change-category">
                                <i class="fas fa-pencil-alt"></i></a>
                            <a href="{{route('cat.destroy',$cat->id)}}" class="btn btn-secondary"
                               onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    {{--<td colspan="3">Всього: {{ $cats->total() }} на сторінці: {{ $cats->count() }}--}}
                    {{--</td>--}}
                    {{--                    <td>{{ $cats->appends(['sort'=>$sort])->render() }}</td>--}}
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
