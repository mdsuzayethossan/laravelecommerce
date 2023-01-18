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
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="{{ url('/cart/update') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Until Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $total_quantity = 0;
                                        
                                    @endphp
                                    @forelse($auth_carts as $auth_cart)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{ route('product_details', $auth_cart->product_id) }}"><img
                                                        class="img-responsive ml-15px"
                                                        src="{{ asset('/uploads/products/preview') }}/{{ $auth_cart->rel_to_product->product_image }}"
                                                        alt="" /></a>
                                            </td>
                                            <td class="product-name"><a
                                                    href="{{ route('product_details', $auth_cart->product_id) }}">{{ $auth_cart->rel_to_product->product_name }}</a>
                                            </td>
                                            <td class="product-price-cart"><span
                                                    class="amount">${{ $auth_cart->rel_to_product->discount_price }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text"
                                                        name="qtybutton[{{ $auth_cart->id }}]"
                                                        value="{{ $auth_cart->quantity }}" />
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                ${{ $auth_cart->rel_to_product->discount_price * $auth_cart->quantity }}
                                            </td>
                                            <td class="product-remove">
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('cart_delete', $auth_cart->id) }}"><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>

                                        @php
                                            $total_quantity += $auth_cart->quantity;
                                            
                                            $total += $auth_cart->rel_to_product->discount_price * $auth_cart->quantity;
                                        @endphp

                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <p class="text-center">Your cart is currently empty.</p>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{ route('index') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <button type="submit">Update Shopping Cart</button>
                                        <a href="{{ route('clear_cart') }}">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="cart-tax">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                                </div>
                                <div class="tax-wrapper">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <div class="tax-select-wrapper">
                                        <div class="tax-select">
                                            <label>
                                                * Country
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select">
                                            <label>
                                                * Region / State
                                            </label>
                                            <select class="email s-email s-wid">
                                                <option>Bangladesh</option>
                                                <option>Albania</option>
                                                <option>Åland Islands</option>
                                                <option>Afghanistan</option>
                                                <option>Belgium</option>
                                            </select>
                                        </div>
                                        <div class="tax-select mb-25px">
                                            <label>
                                                * Zip/Postal Code
                                            </label>
                                            <input type="text" />
                                        </div>
                                        <button class="cart-btn-2" type="submit">Get A Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-lm-30px">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                </div>
                                @if ($coupon_message)
                                    <div class="alert alert-warning">
                                        {{ $coupon_message }}
                                    </div>
                                @endif
                                <div class="discount-code">
                                    <p>Enter your coupon code if you have one.</p>
                                    <form action="{{ route('cart') }}" method="GET">

                                        <input type="text" id="coupon_code" name="coupon_code"
                                            value="{{ @$_GET['coupon_code'] }}" />

                                        <div class="alert alert-success">{{ $discount }}% <span
                                                style="float: right">${{ ($total * $discount) / 100 }}</span></div>
                                        <button class="cart-btn-2" id="couponbtn" type="submit">Apply Coupon</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-md-30px">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                @php
                                    $after_discount = ($total * $discount) / 100;
                                    $grand_total = $total - $after_discount;
                                    session([
                                        'discount' => $discount,
                                    ]);
                                @endphp


                                <h5>Subtotal<span>${{ $total }}</span></h5>
                                <h5>Total Quantity <span>{{ $total_quantity }}</span></h5>
                                <h5>Discount<span>${{ $after_discount }}</span></h5>

                                <div class="total-shipping">
                                    <h5>Total shipping</h5>
                                    <ul>
                                        <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                                        <li><input type="checkbox" /> Express <span>$30.00</span></li>
                                    </ul>
                                </div>

                                <h4 class="grand-totall-title">Grand Total <span>${{ $total - $after_discount }}</span>
                                </h4>
                                <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
@endsection
@section('footer_script')
    @if (session('cart_updated'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('cart_updated') }}'
            })
        </script>
    @endif
    @if (session('clear_cart'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('clear_cart') }}'
            });

            //coupon
        </script>
    @endif
@endsection
