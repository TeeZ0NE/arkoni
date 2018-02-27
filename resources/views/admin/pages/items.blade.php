@extends('admin.admin') @section('title','Items') @section('description','myDescription to items info') @section('keywords','myKeyWords to items info') @section('admin_main_content')
<p class="h4 text-center mt-lg-1">Продуктів <small>в базі: {{ $count }} </small></p>
<div class="row">
	<div class="col-2 align-self-center">
		<strong>Створити</strong>
		<a href="{{ route('items.create') }}" class="btn btn-primary" role="button"><i class="fas fa-plus"></i></a>
	</div>
	<div class="col-10">
		<form method="get" action="{{ route('items.search') }}" role="search">
			<div class="row">
				<div class="col-12 col-lg-6">
					<strong>Шукати</strong>
					<div class="form-group">
						<input type="text" class="form-control d-inline w-75" placeholder="Шукати" name="q" value="{{ old("q") }}">
						<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<strong>Сортувати</strong>
					<div class="form-group">
						<select class="selectpicker mr-sm-1" name="sort">
                            <option value="asc_iname" @if (old('sort')=='asc_iname') selected @endif>А-Я Назва товара</option>
                            <option value="desc_iname" @if (old('sort')=='desc_iname') selected @endif>Я-А Назва товара</option>
                            <option value="asc_brand" @if (old('sort')=='asc_brand') selected @endif>А-Я Виробник</option>
                            <option value="desc_brand" @if (old('sort')=='desc_brand') selected @endif>Я-А Виробник</option>
                            <option value="asc_price" @if (old('sort')=='asc_price') selected @endif>А-Я Ціна</option>
                            <option value="desc_price" @if (old('sort')=='desc_price') selected @endif>Я-А Ціна</option>
                            <option value="asc_enabled" @if (old('sort')=='asc_enabled') selected @endif>А-Я Виводиться</option>
                            <option value="desc_enabled" @if (old('sort')=='desc_enabled') selected @endif>Я-А Виводиться</option>
                        </select>
                        <button type="submit" class="btn btn-info"><i class="fas fa-sort"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
	<div class="col-12">
		@isset($items)
        @component('admin.parts.components.items',["items"=>$items,"sort"=>$sort])
        @endcomponent
        @endisset

        @isset ($brands)
            @component('admin.parts.components.brands',["brands"=>$brands,"sort"=>$sort])@endcomponent
        @endisset
    </div>
</div>
@endsection
