@extends('frontend.master')
@section('content')





    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Shop Page Start  -->
    <div class="shop-category-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                    <!-- Shop Top Area Start -->
                    <div class="shop-top-bar d-flex">
                        <!-- Left Side start -->
                        <p><span>12</span> Product Found of <span>30</span></p>
                        <!-- Left Side End -->
                        <div class="shop-tab nav">
                            <a class="active" href="#shop-grid" data-bs-toggle="tab">
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                            <a href="#shop-list" data-bs-toggle="tab">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Right Side Start -->
                        <div class="select-shoing-wrap d-flex align-items-center">
                            <div class="shot-product">
                                <p>Sort By:</p>
                            </div>
                            <div class="shop-select">
                                <select class="shop-sort" style="border: none">
                                    <option data-display="Relevance">Relevance</option>
                                    <option value="1"> Name, A to Z</option>
                                    <option value="2"> Name, Z to A</option>
                                    <option value="3"> Price, low to high</option>
                                    <option value="4"> Price, high to low</option>
                                </select>

                            </div>
                        </div>
                        <!-- Right Side End -->
                    </div>
                    <!-- Shop Top Area End -->

                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area">

                        <!-- Tab Content Area Start -->
                        <div class="row">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="shop-grid">
                                        <div class="row mb-n-30px">
                                        @foreach ($all_products as $product)
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                        data-aos-delay="200">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="{{ route('product_details', $product->id) }}" class="image">
                                                    <img src="{{ asset('uploads/products/preview') }}/{{ $product->product_image }}"
                                                        alt="Product" />

                                                </a>
                                                <span class="badges">
                                                    <span class="new">New</span>
                                                @if ($product->discount)
                                                <span class="sale">
                                                    {{ $product->discount }}%
                                                </span>

                                                @endif

                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist"
                                                        title="Wishlist"><i class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview"
                                                        data-link-action="quickview" title="Quick view"
                                                        data-bs-toggle="modal" data-bs-target="#allproduct{{ $product->id }}"><i
                                                            class="pe-7s-search"></i></a>
                                                    <a href="compare.html" class="action compare"
                                                        title="Compare"><i class="pe-7s-refresh-2"></i></a>
                                                </div>
                                                <a href="{{ route('product_details', $product->id) }}" title="Add To Cart" class="add-to-cart">Add
                                                    To Cart</a>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="{{ route('product_details', $product->id) }}">{{ $product->product_name }}
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">${{ $product->discount_price }}</span>
                                                    <span class="old">${{ $product->product_price }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                     {{-- Modal start here --}}
                                        <div class="modal modal-2 fade" id="allproduct{{ $product->id }}" tabindex="-1"
                                            role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div
                                                                class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                                                                <!-- Swiper -->
                                                                <div class="swiper-container zoom-top">
                                                                    <div class="swiper-wrapper">
                                                                        @foreach (App\Models\ProductThumbnails::where('product_id', $product->id)->get() as $product_thumb)
                                                                            <div class="swiper-slide">
                                                                                <img class="img-responsive m-auto"
                                                                                    src="{{ asset('uploads/products/thumbnails') }}/{{ $product_thumb->product_thumbnail_name }}"
                                                                                    alt="">
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                                <div class="swiper-container zoom-thumbs mt-3 mb-3">
                                                                    <div class="swiper-wrapper">
                                                                        @foreach (App\Models\ProductThumbnails::where('product_id', $product->id)->get() as $product_thumb)
                                                                            <div class="swiper-slide">
                                                                                <img class="img-responsive m-auto"
                                                                                    src="{{ asset('uploads/products/thumbnails') }}/{{ $product_thumb->product_thumbnail_name }}"
                                                                                    alt="">
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up"
                                                                data-aos-delay="200">
                                                                <div class="product-details-content quickview-content">
                                                                    <h2>{{ $product->product_name }}</h2>
                                                                    <div class="pricing-meta">
                                                                        <ul>
                                                                            <li class="old-price not-cut">
                                                                                ৳{{ $product->discount_price }}</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="pro-details-rating-wrap">
                                                                        <div class="rating-product">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </div>
                                                                        <span class="read-review"><a class="reviews"
                                                                                href="#">( 5 Customer
                                                                                Review
                                                                                )</a></span>
                                                                    </div>
                                                                    <p class="mt-30px mb-0">{{ $product->description }}
                                                                    </p>
                                                                    <div class="pro-details-quality">
                                                                        <div class="cart-plus-minus">
                                                                            <input class="cart-plus-minus-box" type="text"
                                                                                name="qtybutton" value="1" />
                                                                        </div>
                                                                        <div class="pro-details-cart">
                                                                            <button class="add-cart" href="#"> Add To
                                                                                Cart</button>
                                                                        </div>
                                                                        <div
                                                                            class="pro-details-compare-wishlist pro-details-wishlist ">
                                                                            <a href="wishlist.html"><i
                                                                                    class="pe-7s-like"></i></a>
                                                                        </div>
                                                                        <div
                                                                            class="pro-details-compare-wishlist pro-details-compare">
                                                                            <a href="compare.html"><i
                                                                                    class="pe-7s-refresh-2"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="pro-details-sku-info pro-details-same-style  d-flex">
                                                                        <span>SKU: </span>
                                                                        <ul class="d-flex">
                                                                            <li>
                                                                                <a href="#">Ch-256xl</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div
                                                                        class="pro-details-categories-info pro-details-same-style d-flex">
                                                                        <span>Categories: </span>
                                                                        <ul class="d-flex">
                                                                            <li>
                                                                                <a
                                                                                    href="#">
                                                                                @if (App\Models\Subcategory::find($product->subcategory_id))
                                                                                {{ App\Models\Subcategory::find($product->subcategory_id)->subcategory_name }}
                                                                                @else
                                                                                {{ 'Uncategorized' }}

                                                                                @endif
                                                                                </a>
                                                                            </li>
                                                                            <li>-</li>
                                                                            <li>
                                                                                <a
                                                                                    href="#"> @if (App\Models\Category::find($product->category_id))
                                                                                    {{ App\Models\Category::find($product->category_id)->category_name }}
                                                                                    @else
                                                                                    {{ 'Uncategorized' }}

                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div
                                                                        class="pro-details-social-info pro-details-same-style d-flex">
                                                                        <span>Share: </span>
                                                                        <ul class="d-flex">
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-google"></i></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-youtube"></i></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#"><i class="fa fa-instagram"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- Modal end here --}}

                                        @endforeach


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Tab Content Area End -->

                        <!--  Pagination Area Start -->
                        <div class="load-more-items text-center mb-md-60px mb-lm-60px mt-30px0px" data-aos="fade-up">
                            <a href="#" class="btn btn-lg btn-primary btn-hover-dark m-auto"> Load More <i
                                    class="fa fa-refresh ml-15px" aria-hidden="true"></i></a>
                        </div>
                        <!--  Pagination Area End -->
                    </div>
                    <!-- Shop Bottom Area End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-md-60px mb-lm-60px">
                    <div class="shop-sidebar-wrap">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget-search">
                            <div id="widgets-searchbox" action="#">
                                <input class="input-field" id="product_search" type="text" value="{{ @$_GET['search_value'] }}" placeholder="Search">
                                <button class="widgets-searchbox-btn" id="product_search_btn" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget" style="padding: 0 30px">
                            <a href="{{ route('shop') }}" style="width: 140px; height: 35px; text-align:center; display:inline-block;     line-height: 35px;" class="shop-link btn btn-primary">Reset</a>
                        </div>
                        <div class="sidebar-widget mt-8">
                            <h4 class="sidebar-title">Price Filter</h4>
                            <div class="price-filter">
                                <div class="price-slider-amount">
                                    <input type="text" id="amount" class="p-0 h-auto lh-1" name="price"
                                        placeholder="Add Your Price" />
                                </div>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Category</h4>
                            <div class="sidebar-widget-category">
                                <select class="form-select" id="category_id" multiple aria-label="multiple select example">
                                    @foreach ($all_categories as $category)
                                    <option value="{{ $category->id }}"
                                        @isset($_GET['category_id'])
                                        @if ($category->id == $_GET['category_id'])
                                        selected

                                        @endif
                                        @endisset
                                    >{{ $category->category_name }} </option>

                                    @endforeach

                                  </select>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Color</h4>
                            <div class="sidebar-widget-list color">
                                <select class="form-select" id="color_id" multiple aria-label="multiple select example">
                                    @foreach ($all_colors as $color)

                                    <option value="{{ $color->id }}"   @isset($_GET['color_id'])
                                        @if ($color->id == $_GET['color_id'])
                                        selected

                                        @endif
                                        @endisset
                                        >{{ $color->color_name }}</option>

                                    @endforeach

                                  </select>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Size</h4>
                            <div class="sidebar-widget-list size">
                                <select class="form-select" id="size_id" multiple aria-label="multiple select example">
                                    @foreach ($all_sizes as $size)
                                    <option value="{{ $size->id }}"
                                        @isset($_GET['size_id'])
                                        @if ($size->id == $_GET['size_id'])
                                        selected

                                        @endif
                                        @endisset
                                        >{{ $size->size_name }} </option>

                                    @endforeach

                                  </select>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget tag">
                            <h4 class="sidebar-title">Tags</h4>
                            <div class="sidebar-widget-tag">
                                <ul>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Organic</a></li>
                                    <li><a href="#">Old Fashion</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Dress</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Sidebar single item -->
                        <div class="sidebar-widget-image">
                            <div class="single-banner">
                                <img src="assets/images/banner/2.jpg" alt="">
                                <div class="item-disc">
                                    <h2 class="title">#bestsellers</h2>
                                    <a href="single-product-variable.html" class="shop-link">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End  -->



    <!-- Search Modal Start -->
    <div class="modal popup-search-style" id="searchActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Search Your Product</h2>
                        <form class="navbar-form position-relative" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                            <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <!-- Login Modal Start -->
    <div class="modal popup-login-style" id="loginActive">
        <button type="button" class="close-btn" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <div class="modal-overlay">
            <div class="modal-dialog p-0" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="login-content">
                            <h2>Log in</h2>
                            <h3>Log in your account</h3>
                            <form action="#">
                                <input type="text" placeholder="Username">
                                <input type="password" placeholder="Password">
                                <div class="remember-forget-wrap">
                                    <div class="remember-wrap">
                                        <input type="checkbox">
                                        <p>Remember</p>
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="forget-wrap">
                                        <a href="#">Forgot your password?</a>
                                    </div>
                                </div>
                                <button type="button">Log in</button>
                                <div class="member-register">
                                    <p> Not a member? <a href="login.html"> Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal End -->

     <!-- Modal -->
     <div class="modal modal-2 fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                            <!-- Swiper -->
                            <div class="swiper-container zoom-top">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/1.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/2.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/zoom-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container zoom-thumbs mt-3 mb-3">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/1.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/2.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/3.jpg"
                                            alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-responsive m-auto" src="assets/images/product-image/small-image/4.jpg"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-details-content quickview-content">
                                <h2>Ardene Microfiber Tights</h2>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">$18.90</li>
                                    </ul>
                                </div>
                                <div class="pro-details-rating-wrap">
                                    <div class="rating-product">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                                </div>
                                <p class="mt-30px mb-0">Lorem ipsum dolor sit amet, consect adipisicing elit, sed do eiusmod tempor incidi ut labore
                                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita ullamco laboris nisi
                                    ut aliquip ex ea commodo </p>
                                <div class="pro-details-quality">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    </div>
                                    <div class="pro-details-cart">
                                        <button class="add-cart" href="#"> Add To
                                            Cart</button>
                                    </div>
                                    <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                        <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                                    </div>
                                    <div class="pro-details-compare-wishlist pro-details-compare">
                                        <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                                    </div>
                                </div>
                                <div class="pro-details-sku-info pro-details-same-style  d-flex">
                                    <span>SKU: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#">Ch-256xl</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-details-categories-info pro-details-same-style d-flex">
                                    <span>Categories: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#">Fashion.</a>
                                        </li>
                                        <li>
                                            <a href="#">eCommerce</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pro-details-social-info pro-details-same-style d-flex">
                                    <span>Share: </span>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_script')
<script>
    $('#product_search_btn').click(function(){
        const product_search_info = $('#product_search').val();
        const category_id = $('#category_id').val();
        const color_id = $('#color_id').val();
        const size_id = $('#size_id').val();
        const search_link = "{{ route('shop') }}"+"?search_value="+product_search_info+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
        window.location.href = search_link;

    });
    $('#category_id').change(function(){
        const product_search_info = $('#product_search').val();
        const category_id = $('#category_id :selected').val();

        const color_id = $('#color_id :selected').val();


        const size_id = $('#size_id :selected').val();

        const search_link = "{{ route('shop') }}"+"?search_value="+product_search_info+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
        window.location.href = search_link;

    });
    $('#color_id').change(function(){
        const product_search_info = $('#product_search').val();

        const category_id = $('#category_id :selected').val();

        const color_id = $('#color_id :selected').val();

        const size_id = $('#size_id :selected').val();

        const search_link = "{{ route('shop') }}"+"?search_value="+product_search_info+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
        window.location.href = search_link;

    });
    $('#size_id').change(function(){
        const product_search_info = $('#product_search').val();

        const category_id = $('#category_id :selected').val();

        const color_id = $('#color_id :selected').val();

        const size_id = $('#size_id :selected').val();

        const search_link = "{{ route('shop') }}"+"?search_value="+product_search_info+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
        window.location.href = search_link;

    });
</script>
@endsection
