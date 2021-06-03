<main>
	<!-- *** Top Header Bar Starts *** -->
		<div class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-md-1 col-xs-12 col-sm-1">
						<!-- *** Company Logo *** -->
						<div class="logo text-center">
							<a href="{{ url('/') }}">
								<!-- *** Replace Company Logo Here *** -->
								<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink">
									<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
									font-family="AustinBold, Austin" font-weight="bold">
										<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
											<text id="AVIATO">
												<tspan x="108.94" y="325">LOGO</tspan>
											</text>
										</g>
									</g>
								</svg>
							</a>
						</div>
					</div>


					<div class="col-md-11 col-xs-12 col-sm-11">
						<ul class="top-menu text-right list-inline">
							<!-- *** Cart Start *** -->
							<li class="dropdown cart-nav dropdown-slide">
								<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-android-cart"></i>Cart
									<span>({{Cart::count()}})</span>
								</a>
								<div class="dropdown-menu cart-dropdown">
									<!-- Cart Item -->
									@foreach (Cart::content() as $item)
									<div class="media">
										<a class="pull-left" href="#!">
											<img class="media-object" src="{{ asset('frontend/images/shop/products') }}/{{$item->model->image}}.jpg" alt="{{$item->model->name}}" />
										</a>
										<div class="media-body">
											<h4 class="media-heading"><a href="{{ route('product.details', ['slug' => $item->model->slug])}}">{{$item->model->name}}</a></h4>
											<div class="cart-price">
												<span>{{$item->qty}}x : ₱.{{$item->subtotal}}</span>
											</div>
										</div>
										<div class="remove">
											<a href="#!" wire:click.prevent="destroy('{{$item->rowId }}')"><i class="tf-ion-close"></i></a>
									</div>

									</div><!-- / Cart Item -->
									@endforeach
									<div class="cart-summary">
										<span>Subtotal</span>
										<span class="total-price">{{Cart::subtotal()}}</span>
									</div>
									<ul class="text-center cart-buttons">
										<li><a href="{{ url('cart') }}" class="btn btn-small">View Cart</a></li>
										<li><a href="#" wire:click.prevent="checkout" class="btn btn-small">Checkout</a></li>
									</ul>
								</div>
							<!-- *** Cart Ends *** -->
							</li>

							<!-- *** Login Authentication Starts *** -->
							@if(Route::has('login'))
								@auth
									<!-- *** Admin *** -->
									@if(Auth::user()->utype === 'ADM')
										<li class="dropdown search dropdown-slide text-right list-inline">
											<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
												<i class="tf-ion-android-person"></i> {{Auth::user()->name}}
												<i class="tf-ion-ios-arrow-down"></i></a>
											<ul class="dropdown-menu search-dropdown">
												<li>
													<li class="text-center list-inline"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
												</li>
												<li class="text-center list-inline">
													<a title="Categories" href="{{ route('admin.categories') }}">Categories</a>
												</li>
												<li class="text-center list-inline">
													<a title="Products" href="{{ route('admin.products') }}">Products</a>
												</li>
												<li class="text-center list-inline">
													<a title="All Orders" href="{{ route('admin.orders') }}">All Orders</a>
												</li>
												<li class="text-center list-inline"><a href="{{ route('logout') }}"
													onclick="event.preventDefault(); document.getElementById('logout-form')
													.submit();">Logout</a>
												</li>
												<form id="logout-form" method="post" action="{{ ('logout') }}">
													@csrf
												</form>
											</ul>
										</li>
									<!-- *** Customer *** -->
									@else
									<li class="dropdown search dropdown-slide text-right list-inline">
										<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
											<i class="tf-ion-android-person"></i> {{Auth::user()->name}}
											<i class="tf-ion-ios-arrow-down"></i></a>
										<ul class="dropdown-menu search-dropdown">
											<li class="text-center list-inline">
												<a title="Dashboard" href="{{ route('user.dashboard') }}">Dashboard</a>
											</li>
											<li class="text-center list-inline">
												<a title="My Orders" href="{{ route('user.orders') }}">My Orders</a>
											</li>
											<li class="text-center list-inline"><a href="{{ route('logout') }}"
												onclick="event.preventDefault(); document.getElementById('logout-form')
												.submit();">Logout</a>
											</li>
											<form id="logout-form" method="post" action="{{ ('logout') }}">
												@csrf
											</form>
										</ul>
									</li>
									@endif
								@else
									<li><a href="{{ route('login') }}">Log In</a></li>
									<li><a href="{{ route('register') }}">Sign In</a></li>
								@endif
							@endif
							<!-- *** Login Authentication Ends *** -->

						</ul>
					</div>
					<!-- *** Cart Ends *** -->
				</div>
			</div>
		</div>
	<!-- *** Top Header Bar Ends *** -->

	<!-- *** breadcrumb *** -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="content">
						<h1 class="page-name">Shop</h1>
						<ol class="breadcrumb">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('shop') }}">Shop</a></li>
							<li class="active">Product Category</li>
							<li class="active">{{$category_name}}</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- *** Product Section Start *** -->
	<div class="products section">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="widget">
						<h4 class="widget-title">Sort by</h4>
						<select class="form-control" wire:model="sorting">
							<option value="default" selected="selected">Default Sorting</option>
							<option value="date">Sort by Arrival</option>
							<option value="price">Sort by Price: Low to High</option>
							<option value="price-desc">Sort by Price: High to Low</option>
						</select>
					</div>
					<div class="widget product-category">
						<h4 class="widget-title">Categories</h4>
						<div class="panel-group commonAccordion" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
						  	<div class="panel-heading" role="tab" id="headingOne">
							  	<h4 class="panel-title">
							    	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							        Clothes
							      </a>
							    </h4>
							  </div>
						    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<ul>
										@foreach ($categories as $category)
										<li><a href="{{ route('product.category', ['category_slug' => $category->slug]) }}">{{$category->name}}</a></li>
										@endforeach
									</ul>
								</div>
						    </div>
						  </div>
						</div>
					</div>
				</div>

				<div class="col-md-9">
					<div class="row">
						@foreach ($products as $product)
						<div class="col-md-4">
							<div class="product-item">
								<div class="product-thumb">
									<span class="bage">Sale</span>
									<img class="img-responsive" src="{{ asset('frontend/images/shop/products') }}/{{$product->image}}.jpg" alt="{{$product->name}}" />
									<div class="preview-meta">
										<ul>
											<li>
												<a href="{{ route('product.details', ['slug' => $product->slug]) }}">
													<i class="tf-ion-ios-search-strong"></i>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="tf-ion-ios-heart"></i>
												</a>
											</li>
											<li>
												<a href="#" wire:click.prevent="store({{$product->id}}, '{{$product->name}}', {{$product->regular_price}})">
													<i class="tf-ion-android-cart"></i>
												</a>
											</li>
										</ul>
			            </div>
								</div>
								<div class="product-content">
									<h4><a href="{{ route('product.details', ['slug' => $product->slug]) }}">{{$product->name}}</a></h4>
									<p class="price">{{$product->regular_price}}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="wrap-pagination-info">
						{{$products->links('')}}
						<!-- pagination::bootstrap-4 -->
					</div>
				</div>

			</div>
		</div>
	</div>
</main>
