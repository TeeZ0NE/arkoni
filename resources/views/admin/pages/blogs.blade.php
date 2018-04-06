@extends('admin.admin')
@section('title','Blog')
@section('description','Blog description')
@section('keywords','blog')
@section('admin_main_content')

    <p class="h4 text-center mt-lg-1">Записи
        <small>в базі: {{-- $count --}}</small>
    </p>

    <div class="row">
        <div class="col-12 col-lg-2">
            <strong>Додати</strong>
            <br>
            <a href="{{ route('blog.create') }}" class="btn btn-warning" role="button"><i
                        class="fas fa-plus"></i></a>
        </div>
        <div class="col col-lg-10">
            <form method="get" action="{{ route('blog.search') }}" role="search">
                <strong>Шукати</strong>
                <div class="form-group">
                    <input type="text" class="form-control d-inline w-75" placeholder="Пошук" name="q"
                           value="@isset($q){{$q}}@endisset">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <thead class="sticky-top alert-light">
                <tr class="text-center">
                    <th scope="col" class="align-middle">ID</th>
                    <th scope="col">Заголовок статті</th>
                    <th scope="col">На сайті</th>
                    <th scope="col">Створено</th>
                    <th scope="col">Змінено</th>
                    <th scope="col">Переглядів</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Операції</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td class="align-middle">{{ $blog->id }}</td>
                        <td>{{$blog->title}}</td>
                        <td>@if($blog->published)Так@elseНі@endif</td>
                        <td>{{$blog->created_at}}</td>
                        <td>{{$blog->updated_at}}</td>
                        <td class="text-right">{{$blog->views}}</td>
                        <td class="align-middle text-center">
                            <img src="{{asset('storage/img').'/'.$blog->photo}}" alt="blog's photo"
                                 class="img-thumbnail w-25">
                        </td>
                        <td class="text-right align-middle">
                            <form method="post" action="{{ route('blog.destroy',$blog->id) }}" class="mt-1 mb-1">
                                {{ csrf_field() }}
                                <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-warning">
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
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">Всього: {{ $blogs->total() }} на сторінці: {{ $blogs->count() }}
                    </td>
                    <td>{{ $blogs->render() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection