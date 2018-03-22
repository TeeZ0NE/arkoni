@extends('site.index')

@section('content')

    {!!  Breadcrumbs::render('contacts') !!}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                ЧМП "АРКОНИ"
                Связаться с нами вы всегда можете по телефонам указанным
                +38 (098) 956-39-22
                +38 (0432) 56-20-72
                +38 (0432) 61-16-97
                vi.stol85@gmail.com
                Мы находимся впо адресу:
                пер. Цегельный, 2, г. Винница
            </div>
        </div>
    </div>

    @include('site._google-map')

@endsection