<!DOCTYPE html>
<html lang="en">

<head>
	<title>BookSaw</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield('meta')
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/icomoon/icomoon.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
	<link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"
/>

@yield('styles')
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap">

		<div class="top-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="social-links">
							<ul>
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div><!--social-links-->
					</div>
					<div class="col-md-6">
						<div class="right-element">
										<i class="icon icon-user me-2"></i>
										@auth
											<div class="dropdown" style="display: inline-block;">
												<a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
													{{ auth()->user()->name }}
												</a>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
													<li><a class="dropdown-item" href="{{ route('orders.list') }}">My orders</a></li>
													<li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
												</ul>
											</div>
										@else
											<a href="{{ route('login') }}">Login</a> |
											<a href="{{ route('register') }}">Sign In</a>
										@endauth
							<a href="{{ route('shopcart.index') }}" class="cart for-buy"><i class="icon icon-clipboard me-2"></i>
							<span>Cart</span>
							</a>
						</div><!--top-right-->
					</div>
				</div>
			</div>
		</div><!--top-content-->

		<header id="header">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list" style="text-align: left;">
									<li class="menu-item has-sub">
										<a href="#pages" class="nav-link">Categories</a>
											<ul>
												@foreach ($categoriesTree as $category)
													@if ($category->parent_id === null)
														<li class="active">
															<a href="{{ route('home.category.products', ['id' => $category->id, 'title' => $category->title]) }}">{{ $category->title }}</a>
															@if(count($category->children) !== 0)
																<ul>
																	@foreach ($category['children'] as $cat)
																		<li>
																			<a href="{{ route('home.category.products', ['id' => $cat->id, 'title' => $cat->title]) }}">{{ $cat->title }}</a>
																			@if (count($cat->children) !== 0)
																				<ul>
																					@foreach ($cat->children as $c)
																						<li>
																							<a href="{{ route('home.category.products', ['id' => $c->id, 'title' => $c->title]) }}">{{ $c->title }}</a>
																						</li>
																					@endforeach
																				</ul>
																			@endif
																		</li>
																	@endforeach
																</ul>
															@endif
														</li>
													@endif
												@endforeach
											
												<!-- <li><a href="styles.html">Styles</a></li>
												<li><a href="blog.html">Blog</a></li>
												<li><a href="single-post.html">Post Single</a></li>
												<li><a href="shop.html">Our Store</a></li> -->
											</ul>
									</li>
								</ul>

								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>

							</div>
						</nav>

					</div>


					<div class="col-md-2">
						<div class="main-logo">
							<a href="{{ route('home') }}"><img src="{{ asset('assets/images/main-logo.png') }}" alt="logo"></a>
						</div>
					</div>

				</div>
			</div>
		</header>

	</div><!--header-wrap-->


  @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

		<div class="alert-fixed"></div>

    @yield('content')

  <footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-md-4">

					<div class="footer-item">
						<div class="company-brand">
							<img src="{{ asset('assets/images/main-logo.png')}}" alt="logo" class="footer-logo" style="margin-top: 10px;">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
						</div>
					</div>

				</div>

				<div class="col-md-4">

					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">vision</a>
							</li>
							<li class="menu-item">
								<a href="#">articles </a>
							</li>
							<li class="menu-item">
								<a href="#">careers</a>
							</li>
							<li class="menu-item">
								<a href="#">service terms</a>
							</li>
							<li class="menu-item">
								<a href="#">donate</a>
							</li>
						</ul>
					</div>

				</div>
				
				<div class="col-md-4">

					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Help center</a>
							</li>
							<li class="menu-item">
								<a href="#">Report a problem</a>
							</li>
							<li class="menu-item">
								<a href="#">Suggesting edits</a>
							</li>
							<li class="menu-item">
								<a href="#">Contact us</a>
							</li>
						</ul>
					</div>

				</div>

			</div>
			<!-- / row -->

		</div>
	</footer>

	<script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="{{ asset('assets/js/plugins.js') }}"></script>
	<script src="{{ asset('assets/js/script.js') }}"></script>
	@yield('scripts')
</body>

</html>