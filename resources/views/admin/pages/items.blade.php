@extends('admin.admin')
@section('title','Items')
@section('description','myDescription to items info')
@section('keywords','myKeyWords to items info')
@section('admin_main_content')
<p class="h4 text-center mt-lg-1">Продуктів <small>в базі: {{ $count }} </small></p>
<div class="row">
    <div class="col-12">
        <a href="{{ route('items.create') }}" class="btn btn-primary" role="button"><i class="fas fa-plus"></i></a>
        Menu
    </div>
</div>
@endsection