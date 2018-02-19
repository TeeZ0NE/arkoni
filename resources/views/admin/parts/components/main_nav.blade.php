		<nav class="col-lg-11 nav">
			<a class="nav-link" href="{{ route('brands') }}">Виробники</a>
			<a class="nav-link" href="{{ route('cats') }}">Категорії</a>
			<a class="nav-link" href="{{ route('attrs') }}">Аттрибути</a>
			<a class="nav-link" href="{{ route('items.index') }}">Товари</a>
			<a class="nav-link disabled" href="#">Відгуки</a>
			<a class="nav-link disabled" href="#">Користувачі</a>
			<a class="nav-link disabled" href="#">Адміністратори</a>
		</nav>
		<div class="col my-auto">
			@auth
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
						{{ Auth::user()->name }} <span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
		</ul>
		@endauth
	</div>
<script type="text/javascript">
	// $('a[href="' + this.location.pathname + '"]').parents('li,ul').addClass('active');
	// console.log($(location.pathname))
</script>


