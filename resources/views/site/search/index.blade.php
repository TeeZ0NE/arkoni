@extends('site.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10">
                <form method="get" action="{{ route('se.search') }}" role="search">
                    <input type="hidden" value="@isset($q){{$q}}@endisset" name="q">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <strong>Сортувати</strong>
                            <div class="form-group">
                                <select class="custom-select  mr-sm-1 w-50" name="sort">
                                    <option value="asc_iname" @if ($sort=='asc_iname') selected @endif>А-Я Назва
                                        товара
                                    </option>
                                    <option value="desc_iname" @if ($sort=='desc_iname') selected @endif>Я-А Назва
                                        товара
                                    </option>
                                    <option value="asc_brand" @if ($sort=='asc_brand') selected @endif>А-Я Виробник
                                    </option>
                                    <option value="desc_brand" @if ($sort=='desc_brand') selected @endif>Я-А
                                        Виробник
                                    </option>
                                    <option value="asc_price" @if ($sort=='asc_price') selected @endif>А-Я Ціна
                                    </option>
                                    <option value="desc_price" @if ($sort=='desc_price') selected @endif>Я-А Ціна
                                    </option>
                                </select>
                                <button type="submit" class="btn btn-warning"><i class="fas fa-sort"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($items->isEmpty())
                    <p class="h4 info">Nothing found</p>
                @else
                    <p class="h4 info">{{$items->count()}} item(-s) on page. Total: {{$items->total()}}</p>
                    <table class="table table-striped table-bordered">
                        <thead class="sticky-top alert-light">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Назва</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>id</td>
                                <td>{{$item->id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$item->$method['name']}}</td>
                            </tr>
                            <tr>
                                <td>item description</td>
                                <td>{{$item->$method['description']}}</td>
                            </tr>
                            <tr>
                                <td>brand</td>
                                <td>{{$item->brand['name']}}</td>
                            <tr>
                                <td>Price</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            <tr>
                                <td>Old price</td>
                                <td>{{$item->old_price}}</td>
                            </tr>
                            <tr>
                                <td>photo</td>
                                <td><img src="{{asset('storage/img').'/'.$item->item_photo}}" alt="item photo"
                                         class="img-fluid w-25"></td>
                            </tr>
                            <tr>
                                <td>Shortcuts</td>
                                <td>
                                    @foreach($item->getItemShortcut as $shortcut)
                                        <span class="alert-info">{{$shortcut->name}}</span>&nbsp;
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>==</td>
                                <td>==</td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr><td colspan="2">{{$items->appends(['q'=>$q,'sort'=>$sort])->links()}}</td></tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
    {{--TODO: Remove me--}}
    <script>document.addEventListener("DOMContentLoaded", function () {
            $('.main-menu .parent').removeClass('open')
        });</script>
@endsection
