<table class="table table-striped table-bordered">
    <thead class="sticky-top alert-light">
        <tr class="text-center">
            <th>ID</th>
            <th>Назва</th>
            <th>Виробник</th>
            <th>Виводиться</th>
            <th>URL</th>
            <th>Ціна</th>
            <th>Нова ціна</th>
            <th>Створено</th>
            <th>Змінено</th>
            <th>Операції</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->brand['name'] }}</td>
            <td>{{ $item->enabled }}</td>
            <td>{{ $item->url_slug }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->new_price }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
                <a href="{{ route('items.show',$item->id) }}" class="btn btn-info">
                    <i class="fas fa-eye"></i>
                </a>
                <form method="post" action="{{ route('items.destroy',$item->id) }}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Ви впевнені?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                <a href="{{ route('items.edit',$item->id) }}" class="btn btn-info">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div class="border">
                    <p class="text-center border-bottom lead alert-secondary">Опис</p>
                    <p class="p-2">{{$item->description['desc']}}</p>
                </div>
            </td>
            <td colspan="4"><div class="border">
                <p class="text-center border-bottom lead alert-secondary">Тегі</p>
                <p class="p-2">{{$item->tags}}</p>
            </div></td>
            <td colspan="2"><img src="{{asset('storage/img').'/'.$item->photo}}" alt="item photo" class="img-fluid"></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10">Всього: {{ $items->total() }} на сторінці: {{ $items->count() }}
            </td>
            <td>{{ $items->appends(['sort'=>$sort])->render() }}</td>
        </tr>
    </tfoot>
</table>
