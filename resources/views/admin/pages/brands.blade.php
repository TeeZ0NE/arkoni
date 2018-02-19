@extends('admin.admin')
@section('title','Brands')
@section('description','myDescription to brands info')
@section('keywords','myKeyWords to brands info')
@section('admin_main_content')

<p class="h4 text-center mt-lg-1">Виробники <small>в базі: {{ $count }}</small></p>

<div class="row">
  <div class="col-12 col-lg-4">
   <strong>Додати</strong>
   <form method="post" action="{{ route('brand.store') }}" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group">
      {{-- <label for="brand_name">Виготовник (бренд)</label> --}}
      <input type="text" class="form-control  d-inline w-75 mr-sm-1" id="brand_name" placeholder="Назва виготовника" name="name" required value="{{ old('name') }}">
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
    </div>
  </form>
</div>
<div class="col col-lg-8">
  <form method="get" action="{{ route('brands.search') }}" role="search">
    <div class="row">
      <div class="col-12 col-lg-6">
        <strong>Шукати</strong>
        <div class="form-group">
          <input type="text" class="form-control d-inline w-75" placeholder="Назва виготовника" name="q" value="{{ old("q") }}">
          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
        {{-- {{ csrf_field() }} --}}
      </div>
      <div class="col-12 col-lg-6">
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
  <table class="table table-striped">
    <thead>
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
          <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-danger" onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i></a>
          <a href="{{ route('brand.update') }}" class="btn btn-info change_name" id={{ $brand->id }} data-name="{{ $brand->name }}"><i class="fas fa-pencil-alt"></i></a>
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