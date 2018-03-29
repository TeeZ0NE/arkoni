@extends('admin.admin')
@section('title','Тегі')
@section('description','myDescription to tags warning')
@section('keywords','myKeyWords to tags warning')
@section('admin_main_content')

    <p class="h4 text-center mt-lg-1">Тегі (параметри)
        <small>в базі: {{ $count }}</small>
    </p>
    <div class="row">
        <div class="col-12 col-lg-2">
            <strong>Додати</strong>
            <br>
            <a href="{{ route('tags.create') }}" class="btn btn-warning" role="button"><i
                        class="fas fa-plus"></i></a>
        </div>
        <div class="col col-lg-10">
            <form method="get" action="{{ route('tags.search') }}" role="search">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <strong>Шукати</strong>
                        <div class="form-group">
                            <input type="text" class="form-control d-inline w-75" placeholder="Назва тега" name="q"
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
        <div class="col-12 mt-lg-2">
            <table class="table table-striped">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th scope="col" rowspan="2" class="align-middle">ID</th>
                    <th scope="col" colspan="2">Тег</th>
                    <th scope="col" rowspan="2" class="align-middle">Операції</th>
                </tr>
                <tr>
                    <th class="text-center">ru</th>
                    <th class="text-center">uk</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td class="align-middle">{{ $tag->id }}</td>
                        <td class="align-middle">{{ $tag->ru_name }} </td>
                        <td class="align-middle">{{$tag->uk_name}}</td>
                        <td class="text-right">
                            <form method="post" action="{{ route('tags.destroy',$tag->id) }}"
                                  class="form-inline justify-content-end">
                                {{ csrf_field() }}
                                <a href="{{route('tags.edit',$tag->id)}}"
                                   class="btn btn-warning change-category">
                                    <i class="fas fa-pencil-alt"></i></a>
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-secondary ml-1" type="submit" onclick="return confirm('Ви впевнені?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">Всього: {{ $tags->total() }} на сторінці: {{ $tags->count() }}
                    </td>
                    <td>{{ $tags->appends(['sort'=>$sort])->render() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
