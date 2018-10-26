<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/styles/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/styles/admin.css') }}" rel="stylesheet">
	</head>
	<body class="h-100">
    <div id="app">
	    <div class="container-fluid">
	    	<div class="row">
	    		<!-- Main Sidebar -->
		      <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  					<div class="main-navbar">
  					<nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
  					<a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
  					<div class="d-table m-auto">
  					<img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="images/shards-dashboards-logo.svg" alt="{{ config('app.name', 'Laravel') }}">
  					<span class="d-none d-md-inline ml-1">{{ config('app.name', 'Laravel') }}</span>
  					</div>
  					</a>
  					<a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
  					<i class="material-icons">&#xE5C4;</i>
  					</a>
  					</nav>
  					</div>
  					<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
  						<div class="input-group input-group-seamless ml-3">
  							<div class="input-group-prepend">
  								<div class="input-group-text">
  									<i class="fas fa-search"></i>
  								</div>
  							</div>
  							<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> 
  						</div>
  					</form>
  					<div class="nav-wrapper">
  						<h6 class="main-sidebar__nav-title">Dashboard</h6>
  						<ul class="nav nav--no-borders flex-column">
  							<li class="nav-item dropdown">
  								<a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
  									<i class="material-icons">group</i>
  									<span>Users</span>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small">
  									<a class="dropdown-item" href="{{ route('admin.users.index') }}">All Users</a>
  									<a class="dropdown-item" href="{{ route('admin.users.create') }}">New User</a>
                    <a class="dropdown-item" href="{{ route('admin.roles.index') }}">Roles</a>
  								</div>
  							</li>
  							<li class="nav-item dropdown">
  								<a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
  									<i class="material-icons">folder</i>
  									<span>Media</span>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small">
  									<a class="dropdown-item " href="#">All Media</a>
  									<a class="dropdown-item " href="#">Upload Media</a>
  								</div>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
  									<i class="material-icons">loyalty</i>
  									<span>Orders</span>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small">
  									<a class="dropdown-item " href="{{ route('admin.orders.index') }}">All Orders</a>
  									<a class="dropdown-item " href="{{ route('admin.orders.create') }}">New Order</a>
  								</div>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
  									<i class="material-icons">shopping_cart</i>
  									<span>Products</span>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small">
  									<a class="dropdown-item " href="{{ route('admin.products.index') }}">All Products</a>
  									<a class="dropdown-item " href="{{ route('admin.products.create') }}">New Product</a>
  									<a class="dropdown-item " href="{{ route('admin.products.categories.index') }}">Product Categories</a>
  								</div>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link " href="#">
  									<i class="material-icons">settings</i>
  									<span>Settings</span>
  								</a>
  							</li>
  						</ul>
  					</div>
		      </aside>
		      <!--./ Main Sidebar -->

		      <!-- Main Content -->
		      <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
		        <!-- Main Navbar -->
		        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
  						<form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
  							<div class="input-group input-group-seamless ml-3">
  								<div class="input-group-prepend">
  									<div class="input-group-text">
  										<i class="fas fa-search"></i>
  									</div>
  								</div>
  								<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> 
  							</div>
  						</form>
  						<ul class="navbar-nav border-left flex-row ">
  							<li class="nav-item border-right dropdown notifications">
  								<a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  									<div class="nav-link-icon__wrapper">
  										<i class="material-icons">&#xE7F4;</i>
  										<span class="badge badge-pill badge-danger">2</span>
  									</div>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
  									<a class="dropdown-item" href="#">
  										<div class="notification__icon-wrapper">
  											<div class="notification__icon">
  												<i class="material-icons">&#xE6E1;</i>
  											</div>
  										</div>
  										<div class="notification__content">
  											<span class="notification__category">Analytics</span>
  											<p>Your website’s active users count increased by
  											<span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
  										</div>
  									</a>
  									<a class="dropdown-item" href="#">
  										<div class="notification__icon-wrapper">
  											<div class="notification__icon">
  												<i class="material-icons">&#xE8D1;</i>
  											</div>
  										</div>
  										<div class="notification__content">
  											<span class="notification__category">Sales</span>
  											<p>Last week your store’s sales count decreased by
  											<span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
  										</div>
  									</a>
  									<a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
  								</div>
  							</li>
  							<li class="nav-item dropdown">
  								<a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
  									<img class="user-avatar rounded-circle mr-2" src="images/avatars/0.jpg" alt="User Avatar">
  									<span class="d-none d-md-inline-block">Sierra Brooks</span>
  								</a>
  								<div class="dropdown-menu dropdown-menu-small">
  									<a class="dropdown-item" href="user-profile.html">
  										<i class="material-icons">&#xE7FD;</i> Profile</a>
  									<a class="dropdown-item" href="edit-user-profile.html">
  										<i class="material-icons">&#xE8B8;</i> Edit Profile</a>
  									<a class="dropdown-item" href="file-manager-cards.html">
  										<i class="material-icons">&#xE2C7;</i> Files</a>
  									<a class="dropdown-item" href="transaction-history.html">
  										<i class="material-icons">&#xE896;</i> Transactions</a>
  									<div class="dropdown-divider"></div>
  									<a class="dropdown-item text-danger" href="#">
  										<i class="material-icons text-danger">&#xE879;</i> Logout </a>
  								</div>
  							</li>
  						</ul>
  						<nav class="nav">
  							<a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
  								<i class="material-icons">&#xE5D2;</i>
  							</a>
  						</nav>
  					</nav>
  					<!--./ Main Navbar -->

            @includeWhen(session()->has('success'), 'components.alerts.success')
            @includeWhen(session()->has('deleted'), 'components.alerts.deleted')

  					<!-- Main Content -->
  					<div class="main-content-container container-fluid px-4">
  						@yield('content')
  					</div>
  					<!--./ Main Content -->

  					<!-- Main Footer -->
  					<footer class="main-footer d-flex p-2 px-3 bg-white border-top">
  						<ul class="nav">
  							<li class="nav-item">
  								<a class="nav-link" href="#">Home</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" href="#">Services</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" href="#">About</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" href="#">Products</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" href="#">Blog</a>
  							</li>
  						</ul>
  						<span class="copyright ml-auto my-auto mr-2">Copyright © 2018 {{ config('app.name', 'Laravel') }}</span>
  					</footer>
					 <!--./ Main Footer -->
	        </main>
	        <!--./ Main Content -->
	    	</div>
	    </div>
    </div>

    <!-- Scripts -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
    <script src="{{ asset('assets/scripts/app.js') }}" defer></script>
    <script src="{{ asset('assets/scripts/admin.js') }}" defer></script>
    @yield('scripts')
	</body>
</html>
