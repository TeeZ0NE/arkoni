<ul class="nav col main-menu">
    <li class="nav-item"><a href="{{route('brands')}}" class="nav-link">Виробники (бренди)</a></li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
           aria-expanded="false">Категорії</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('cats.index')}}">Категорії</a>
            <a class="dropdown-item" href="{{route('subcategory.index')}}">Підкатегорії</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('subcategory.create')}}">Додати підкатегорію</a>
        </div>
    </li>
    <li class="nav-item"><a href="{{route('attrs')}}" class="nav-link">Атрибути</a></li>
    <li class="nav-item"><a href="{{route('tags.index')}}" class="nav-link">Теги</a></li>
    <li class="nav-item"><a href="{{route('items.index')}}" class="nav-link">Товари</a></li>
    {{--<li class="nav-item"><a href="{{route('images')}}" class="nav-link">Зображення</a></li>--}}
    {{--<li class="nav-item"><a href="#" class="nav-link disabled">Користувачі</a></li>--}}
    {{--<li class="nav-item"><a href="#" class="nav-link disabled">Адміністратори</a></li>--}}
    @auth
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
               aria-haspopup="true">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
                    Вийти
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @endauth
</ul>


    {{--<a class="nav-link" href="{{ route('brands') }}">Виробники</a>--}}
    {{--<a class="nav-link" href="{{ route('cats') }}">Категорії</a>--}}
    {{--<a class="nav-link" href="{{ route('attrs') }}">Аттрибути</a>--}}
    {{--<a class="nav-link" href="{{ route('items.index') }}">Товари</a>--}}


