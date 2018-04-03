{{--TODO: delete me. I'm a garbage--}}
<center>Sub category data</center>
id -  {{$scat->id}}<br>
name - {{$scat->$scat_method['name']}}<br>
title: {{$scat->$scat_method['title']}}<br>
desc: {{$scat->$scat_method['description']}}<br>
h1: {{$scat->$scat_method['h1']}}<br>
h2: {{$scat->$scat_method['h2']}}<br>
seo_text: {{$scat->$scat_method['seo_text']}} <br>
seo_text_2: {{$scat->$scat_method['seo_text_2']}} <br>
<img src="{{asset('storage/img').'/'.$scat->sub_cat_photo}}" alt="item photo"
     class="img-fluid w-25">
<hr>

<form method="get" action="{{ route('sub-category',substr($segment,2)) }}" role="search">
    <div class="form-group">
        <select class="custom-select  mr-sm-1 w-50" name="sort">
            <option value="asc_name" @if ($sort=='asc_name') selected @endif>А-Я Назва
                товара
            </option>
            <option value="desc_name" @if ($sort=='desc_name') selected @endif>Я-А Назва
                товара
            </option>

            <option value="asc_price" @if ($sort=='asc_price') selected @endif>А-Я Ціна
            </option>
            <option value="desc_price" @if ($sort=='desc_price') selected @endif>Я-А Ціна
            </option>
        </select>
        <button type="submit" class="btn btn-warning"><i class="fas fa-sort"></i></button>
    </div>
    <center>Brands</center>
    @foreach($brands as $brand)
        <input type="checkbox" name="bs[]" value="{{$brand->id}}"
               @isset($bs) @if(in_array($brand->id,$bs)) checked @endif @endisset>
        {{$brand->name}}<br>
    @endforeach
    <hr>
</form>

@foreach($items as $item)
    id - {{$item->id}}<br>
    name -  {{$item->$i_method['name']}}<br>
    desc - {{$item->$i_method['description']}}<br>
    price - {{$item->price}}<br>
    old pr - {{$item->old_price}}<br>
    brand - {{$item->brand['name']}}<br>
    item url - {{$item->item_url_slug}}<br>
    item shortcuts - @foreach($item->getItemShortcut as $shc){{$shc->name}}&nbsp;@endforeach <br>
    <img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo"
         class="img-fluid w-25"><br>
    <hr>
@endforeach
{{$items->appends(['sort'=>$sort, 'bs'=>$bs])->links()}}&nbsp;total:{{$items->total()}}