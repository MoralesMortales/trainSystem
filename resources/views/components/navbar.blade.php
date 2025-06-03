<!DOCTYPE html>
<html lang="en">
<head>

  @vite(['resources/css/app.css'])

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>

<div class=""> <!-- Contenedor de aislamiento -->
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid tw:h-20">
<a href="{{ url('/') }}" class="tw:h-full tw:w-max">
    <img class="tw:max-h-full" src="{{ asset('img/momo.png') }}" alt="foyo">
</a>

@auth
quesooooo

@else
    <a href="{{ url('/login') }}">
    <div id="login" class="">
    <h5>Login</h5>
    </div>
    </a>
    <a href="{{ url('/register') }}">
    <div id="register" class="">
    <h5>Register</h5>
    </div>
    </a>

@endauth

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
          <form action="{{ route('logout.submit') }}" method="post">
          @csrf
            <button class="nav-link">Logout</button>
          </form>
          </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
  </div>


</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</html>



