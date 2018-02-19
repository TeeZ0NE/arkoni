@extends('admin.admin')
@section('title','Categories')
@section('description','myDescription to categories info')
@section('keywords','myKeyWords to Categories info')
@section('admin_main_content')

<p class="h4 text-center mt-lg-1">Категорії <small>в базі: {{ $count }}</small></p>

<div class="row">
  <div class="col-12 col-lg-6">
   <strong>Додати</strong>
   <form method="post" action="{{ route('cat.store') }}" class="form">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control  d-inline mr-sm-1 w-50" id="cat_name" placeholder="Назва категорії" name="name" required value={{ old('name') }}>
      <select class="selectpicker mr-sm-1" name="parent_id" required>
        <option selected value="">Батьківська категорія</option>
        @foreach ($parent_cats as $parent_cat)
        <option value={{ $parent_cat->id }}>{{ $parent_cat->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
    </div>
  </form>
</div>
<div class="col col-lg-6">
  <form method="get" action="{{ route('cats.search') }}" role="search">
    <div class="row">
      <div class="col-12 col-lg-6">
        <strong>Шукати</strong>
        <div class="form-group">
          <input type="text" class="form-control d-inline w-75" placeholder="Назва категорії" name="q" value="{{ old("q") }}">
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
<div class="col-12 d-none" id="edit-form">
  <strong>Змінити параметри категорії</strong>
  <form method="post" action="{{ route('cat.update') }}" class="form">
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id-edited">
    <div class="form-group">
      <input type="text" class="form-control  d-inline mr-sm-1 w-50" id="new-cat-name" placeholder="Назва категорії" name="name" required>
      <select class="selectpicker mr-sm-1" name="parent_id" id="parent-select" required>
        <option selected value="">Батьківська категорія</option>
        @foreach ($parent_cats as $parent_cat)
        <option value={{ $parent_cat->id }}>{{ $parent_cat->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i></button>
    </div>
  </form>
</div>
<div class="col-12">
  <table class="table table-striped">
    <thead>
      <tr class="text-center">
        <th scope="col">ID</th>
        <th scope="col">Категорія</th>
        <th scope="col">Батьківська категорія</th>
        <th scope="col">Операції</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cats as $cat)
      <tr>
        <td class="align-middle">{{ $cat->id }}</td>
        <td class="align-middle">{{ $cat->name }}</td>
        <td class="align-middle">{{ $cat->parent_cat['name'] }}</td>
        <td class="text-right">
          <a href="{{ route('cat.delete',$cat->id) }}" class="btn btn-danger" onclick="return confirm('Ви впевнені?')"><i class="fas fa-trash-alt"></i></a>
          <a href="#edit-form" class="btn btn-info change-category" 
          id={{ $cat->id }}
          data-name="{{ $cat->name }}"
          data-sub-id={{ $cat->parent_id }}>
          <i class="fas fa-pencil-alt"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">Всього: {{ $cats->total() }} на сторінці: {{ $cats->count() }}
        </td>
        <td>{{ $cats->appends(['sort'=>$sort])->render() }}</td>
      </tr>
    </tfoot>
  </table>
</div>
</div>
<script type="text/javascript">
  

</script> 
@endsection