@extends('admin.admin')
@section('title','Attributes')
@section('description','myDescription to attributes warning')
@section('keywords','myKeyWords to attributes warning')
@section('admin_main_content')

    <p class="h4 text-center mt-lg-1">Атрибути (параметри)
        <small>в базі: {{ $count }}</small>
    </p>
    <div class="row">
        <div class="col-12 col-lg-5">
            <strong>Додати</strong>
            <form method="post" action="{{ route('attr.store') }}" class="form-inline">
                {{ csrf_field() }}
                <div class="col-12 row align-items-center mx-auto">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="input-group mb-1 col-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="ru-addon">ru</span>
                                </div>
                                <input type="text" class="form-control  d-inline"
                                       placeholder="Атрибут" name="ru_name" required value="{{ old('ru_name') }}">
                            </div>
                            <div class="input-group col-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="uk-addon">uk</span>
                                </div>
                                <input type="text" class="form-control  d-inline"
                                       placeholder="Атрибут" name="uk_name" required value="{{ old('uk_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col col-lg-7">
            <form method="get" action="{{ route('attrs.search') }}" role="search">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <strong>Шукати</strong>
                        <div class="form-group">
                            <input type="text" class="form-control d-inline w-75" placeholder="Назва атрибута" name="q"
                                   value="{{ old("q") }}">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
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
        <div class="col-12 mt-lg-3 mt-1 alert-warning d-none edit-attrs pb-2">
            <strong id="edit-attrs">Редагувати</strong>
            <form method="post" action="{{route('attr.update')}}" class="form-inline">
                {{csrf_field()}}
                <input type="hidden" name="id" id="id-edited">
                <div class="input-group col-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="ru-edit">ru</span>
                    </div>
                    <input type="text" class="form-control  d-inline" id="ru-attr-name-ed"
                           placeholder="Атрибут" name="ru_name" required>
                </div>
                <div class="input-group col-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="uk-addon">uk</span>
                    </div>
                    <input type="text" class="form-control  d-inline" id="uk-attr-name-ed"
                           placeholder="Атрибут" name="uk_name" required>
                </div>
                <button type="submit" class="btn btn-warning"><i class="far fa-save"></i> Зберегти</button>
            </form>
        </div>
        <div class="col-12 mt-lg-2">
            <table class="table table-striped">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th scope="col" rowspan="2" class="align-middle">ID</th>
                    <th scope="col" colspan="2">Атрибут (параметр)</th>
                    <th scope="col" rowspan="2" class="align-middle">Операції</th>
                </tr>
                <tr>
                    <th class="text-center">ru</th>
                    <th class="text-center">uk</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($attrs as $attr)
                    <tr>
                        <td class="align-middle">{{ $attr->id }}</td>
                        <td class="align-middle">{{ $attr->ru_name }} </td>
                        <td class="align-middle">{{$attr->uk_name}}</td>
                        <td class="text-right">
                            <a href="{{ route('attr.delete',$attr->id) }}" class="btn btn-secondary"
                               onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="#edit-attrs" class="btn btn-warning change-attr-name"
                               id={{ $attr->id }} data-lang-ru="{{ $attr->ru_name }}" data-lang-uk="{{$attr->uk_name}}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">Всього: {{ $attrs->total() }} на сторінці: {{ $attrs->count() }}
                    </td>
                    <td>{{ $attrs->appends(['sort'=>$sort])->render() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
