<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{asset('assets/styles/style.css')}}" rel="stylesheet">
  <style>
    :root {
      /* Light theme */
      --admin-bg: #f5f7fb;
      --admin-surface: #ffffff;
      --admin-muted: #495057;
      --admin-hover: rgba(13,110,253,0.08);
      --admin-active: #0d6efd;
      --admin-accent: #0d6efd;
      --admin-text: #1f2937;
    }

    body { background-color: var(--admin-bg); color: var(--admin-text); }

    /* Make top bar light even though markup uses navbar-dark/bg-dark */
    .navbar.header-top { box-shadow: 0 4px 12px rgba(0,0,0,0.08); background-color: #ffffff !important; }
    .navbar-dark .navbar-brand, .navbar-dark .nav-link { color: var(--admin-text) !important; }
    .navbar-brand { font-weight: 700; letter-spacing: .5px; }

    .side-nav { padding-left: 0; }
    .side-nav .nav-link {
      color: var(--admin-text);
      border-radius: 8px;
      margin: 6px 0;
      padding: 10px 14px;
      transition: background-color .15s ease, color .15s ease;
    }
    .side-nav .nav-link i { color: var(--admin-accent); margin-right: .5rem; }
    .side-nav .nav-link:hover { background: var(--admin-hover); color: var(--admin-text); }
    .side-nav .nav-link.active { background: var(--admin-active); color: #ffffff; box-shadow: 0 6px 14px rgba(13,110,253,.18); }
    .side-nav .nav-link.active i { color: #ffffff; }

    .card { border: 0; box-shadow: 0 8px 28px rgba(0,0,0,0.08); background-color: var(--admin-surface); color: var(--admin-text); }
    .card .card-title { color: var(--admin-text); }
    .dropdown-menu { box-shadow: 0 10px 25px rgba(0,0,0,0.12); border: 0; }
  </style>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>

<body>
  <div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">Restoran</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">

          @auth('admin')
          <ul class="navbar-nav side-nav">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.dashboard') ? 'active' : '' }}" style="margin-left: 20px;" href="{{route('admins.dashboard')}}"><i class="fa-solid fa-gauge-high mr-2"></i> Home
                <span class="sr-only">(current)</span>
              </a>
              </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.users.*') ? 'active' : '' }}" href="{{route('admins.users.list')}}" style="margin-left: 20px;"><i class="fa-solid fa-users mr-2"></i> Users</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.list') ? 'active' : '' }}" href="{{route('admins.list')}}" style="margin-left: 20px;"><i class="fa-solid fa-user-shield mr-2"></i> Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.order') ? 'active' : '' }}" href="{{ route('admins.order')}}" style="margin-left: 20px;"><i class="fa-solid fa-bag-shopping mr-2"></i> Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.foods') ? 'active' : '' }}" href="{{route('admins.foods')}}" style="margin-left: 20px;"><i class="fa-solid fa-burger mr-2"></i> Foods</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admins.bookings') ? 'active' : '' }}" href="{{route('admins.bookings')}}" style="margin-left: 20px;"><i class="fa-solid fa-calendar-check mr-2"></i> Bookings</a>
            </li>
          </ul>
          @endauth

          <ul class="navbar-nav ml-md-auto d-md-flex">
            @auth('admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admins.dashboard') }}">Dashboard
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::guard('admin')->user()->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admins.logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('admin-logout-form').submit();">
                  Logout
                </a>

                <form id="admin-logout-form" action="{{ route('admins.logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admins.login') }}">login
              </a>
            </li>
            @endauth

          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <main class="py-4"> @yield('content') </main>
    </div>
  </div>
  </div>
  <script type="text/javascript">

  </script>
</body>

</html>