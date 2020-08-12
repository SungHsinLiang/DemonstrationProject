<div class="container">
  <div class="row">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm col-12">
      <div class="container">
        <button class="navbar-toggler m-auto text-center" type="button" data-toggle="collapse"
          data-target="#footerNavbar" aria-controls="footerNavbar" aria-expanded="false"
          aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="footerNavbar">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item">
              <a class="nav-link mr-3" href="{{ route('about_me.index')}}">關於我</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('news.index')}}">{{ __('text.News')}}</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item">
              <a class="nav-link disabled" href="#">CREATED BY SUNG</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>