@extends('admin.admin')
@section('title','Attributes')
@section('description','myDescription to attributes info')
@section('keywords','myKeyWords to attributes info')
@section('admin_main_content')

<p class="h4 text-center mt-lg-1">Атрибути (параметри) <small>в базі: {{ $count }}</small></p>

<div class="row">
  <div class="col-12 col-lg-4">
   <strong>Додати</strong>
   <form method="post" action="{{ route('attr.store') }}" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control  d-inline w-75 mr-sm-1" id="attr_name" placeholder="Атрибут" name="name" required  value="{{ old('name') }}">
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
    </div>
  </form>
</div>
<div class="col col-lg-8">
  <form method="get" action="{{ route('attrs.search') }}" role="search">
    <div class="row">
      <div class="col-12 col-lg-6">
        <strong>Шукати</strong>
        <div class="form-group">
          <input type="text" class="form-control d-inline w-75" placeholder="Назва атрибута" name="q" value="{{ old("q") }}">
          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
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
        <th scope="col">Атрибут (параметр)</th>
        <th scope="col">Операції</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($attrs as $attr)
      <tr>
        <td class="align-middle">{{ $attr->id }}</td>
        <td class="align-middle">{{ $attr->name }}</td>
        <td class="text-right">
          <a href="{{ route('attr.delete',$attr->id) }}" class="btn btn-danger" onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i></a>
          <a href="{{ route('attr.update') }}" class="btn btn-info change_name" id={{ $attr->id }} data-name="{{ $attr->name }}"><i class="fas fa-pencil-alt"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">Всього: {{ $attrs->total() }} на сторінці: {{ $attrs->count() }}
        </td>
        <td>{{ $attrs->appends(['sort'=>$sort])->render() }}</td>
      </tr>
    </tfoot>
  </table>
</div>
</div>
@endsection