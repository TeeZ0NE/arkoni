@extends('admin.admin')
@section('title','Tags')
@section('description','myDescription to tags info')
@section('keywords','myKeyWords to tags info')
@section('admin_main_content')

<p class="h4 text-center mt-lg-1">Теги <small>в базі: {{-- $count --}}</small></p>

<div class="row">
  <div class="col-12 col-lg-4">
   <strong>Додати</strong>
   <form method="post" action="{{ route('tag.store') }}" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group">
      {{-- <label for="brand_name">Виготовник (бренд)</label> --}}
      <input type="text" class="form-control  d-inline w-75 mr-sm-1" id="brand_name" placeholder="Назва виготовника" name="name" required value="{{ old('name') }}">
      <button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i></button>
    </div>
  </form>
</div>
<div class="col col-lg-8">
  <form method="get" action="{{ route('brands.search') }}" role="search">
    <div class="row">
      <div class="col-12 col-lg-6">
        <strong>Шукати</strong>
        <div class="form-group">
          <input type="text" class="form-control d-inline w-75" placeholder="Назва виробника" name="q" value="{{ old("q") }}">
          <button type="submit" class="btn btn-warning"><i class="fas fa-search"></i></button>
        </div>
        {{-- {{ csrf_field() }} --}}
      </div>
      <div class="col-12 col-lg-6">
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
      <div class="col-12 mt-lg-3 mt-1 alert-warning  edit-brand pb-2 d-none">
            <strong id="edit-brand">Редагувати</strong>
            <form method="post" action="{{route('brand.update')}}" class="form-inline">
                {{csrf_field()}}
                <input type="hidden" name="brand_id" id="id-edited">
                <div class="input-group w-50">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="ru-edit">Назва виробника</span>
                    </div>
                    <input type="text" class="form-control  d-inline" id="brand-name-ed"
                           placeholder="Виробник" name="name" required>
                </div>
                <button type="submit" class="btn btn-warning ml-2"><i class="far fa-save"></i> Зберегти</button>
            </form>
        </div>
<div class="col-12 mt-lg-2">
  <table class="table table-striped">
    <thead class="sticky-top alert-light">
      <tr class="text-center">
        <th scope="col">ID</th>
        <th scope="col">Виробник (бренд)</th>
        <th scope="col">Операції</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($brands as $brand)
      <tr>
        <td class="align-middle">{{ $brand->id }}</td>
        <td class="align-middle">{{ $brand->name }}</td>
        <td class="text-right">
          <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-secondary" onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i></a>
          <a href="#edit-brand" class="btn btn-warning change-brand-name" id={{ $brand->id }} data-name="{{ $brand->name }}"><i class="fas fa-pencil-alt"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">Всього: {{ $brands->total() }} на сторінці: {{ $brands->count() }}
        </td>
        <td>{{ $brands->appends(['sort'=>$sort])->render() }}</td>
      </tr>
    </tfoot>
  </table>
</div>
</div>
@endsection
