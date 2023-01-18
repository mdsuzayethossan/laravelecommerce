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
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

@auth('customerlogin')
<!-- breadcrumb-area end -->
   <!-- checkout area start -->
   <div class="checkout-area pt-100px pb-100px">
    <div class="container">
        <form action="{{ url('/order/insert') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ Auth::guard('customerlogin')->user()->name }}"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Company Name</label>
                                <input type="text" name="company"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="billing-select mb-4">
                                <label>Country</label>
                                <select id="country" name="country">
                                    <option value="">--Select a country--</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>

                                    @endforeach


                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="billing-select mb-4">
                                <label>City</label>
                                <select id="city" name="city">

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-4">
                                <label>Street Address</label>
                                <input class="billing-address" name="address" placeholder="House number and street name"
                                    type="text" />
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Postcode / ZIP</label>
                                <input type="number" name="postcode" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Phone</label>
                                <input type="number" name="phone" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-4">
                                <label>Email Address</label>
                                <input type="email" name="email" value="{{ Auth::guard('customerlogin')->user()->email }}"/>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="checkout-account mb-30px">
                        <input class="checkout-toggle2 w-auto h-auto" type="checkbox" />
                        <label>Create an account?</label>
                    </div>
                    <div class="checkout-account-toggle open-toggle2 mb-30">
                        <form action="{{ url('/customer/register') }}" method="POST">
                            @csrf
                            <input type="text" name="name" placeholder="Name" />
                            <input placeholder="Email address" name="email" type="email" />
                            <input placeholder="Password" name="password" type="password" />
                            <button class="btn-hover checkout-btn" type="submit">register</button>
                        </form>

                    </div> --}}
                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                name="notes"></textarea>
                        </div>
                    </div>
                    {{-- <div class="checkout-account mt-25">
                        <input class="checkout-toggle w-auto h-auto" type="checkbox" />
                        <label>Ship to a different address?</label>
                    </div>
                    <div class="different-address open-toggle mt-30px">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>First Name</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Last Name</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Company Name</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-4">
                                    <label>Country</label>
                                    <select>
                                        <option>Select a country</option>
                                        <option>Azerbaijan</option>
                                        <option>Bahamas</option>
                                        <option>Bahrain</option>
                                        <option>Bangladesh</option>
                                        <option>Barbados</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Street Address</label>
                                    <input class="billing-address" placeholder="House number and street name"
                                        type="text" />
                                    <input placeholder="Apartment, suite, unit etc." type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Town / City</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>State / County</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Phone</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Email Address</label>
                                    <input type="text" />
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ( $carts as $cart)
                                    <li><span class="order-middle-left">{{ $cart->rel_to_product->product_name }} X {{ $cart->quantity }}</span> <span
                                        class="order-price">${{ $cart->rel_to_product->discount_price*$cart->quantity }}</span>
                                    </li>
                                        @php
                                            $total += $cart->rel_to_product->discount_price*$cart->quantity;
                                        @endphp

                                    @endforeach

                                </ul>
                            </div>



                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Shipping Charge</li>
                                    <li class="your-order-shipping" id="charge">$</li>

                                </ul>
                            </div>
                            <div class="form-check shipping_check">
                                <input class="form-check-input charge"  type="radio" name="delivery_charge" id="flexRadioDefault1" value="60">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Inside of Dhaka
                                </label>
                              </div>
                              <div class="form-check shipping_check">
                                <input class="form-check-input charge" type="radio" name="delivery_charge" id="flexRadioDefault2" value="100">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Outside of Dhaka
                                </label>
                              </div>


                            <div class="your-order-total">
                                <ul>
                                    @php
                                        $discount = session('discount');
                                        $after_discount = $total*$discount/100;
                                        $grand_total = $total-$after_discount;
                                    @endphp

                                    <li class="order-total">Total</li>
                                    <li id="grand_total">${{ $total-$after_discount }}</li>

                                </ul>
                            {{-- order table informatin --}}
                            {{-- <input type="hidden" name="user_id" value="{{ Auth::guard('customerlogin')->id() }}"/> --}}
                            <input type="hidden" name="subtotal" id="" value="{{ $total }}">
                            <input type="hidden" name="discount" value="{{  $after_discount }}">
                            </div>
                        </div>
                        <div class="payment-method">
                           <h3>Select payment method</h3>

                            <div class="form-check shipping_check">
                                <input class="form-check-input"  type="radio" name="payment_method" id="flexRadioDefault1" value="1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Cash on delivery
                                </label>
                              </div>
                            <div class="form-check shipping_check">
                                <input class="form-check-input"  type="radio" name="payment_method" id="flexRadioDefault1" value="2">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Pay with sslcommerz
                                </label>
                              </div>
                            <div class="form-check shipping_check">
                                <input class="form-check-input"  type="radio" name="payment_method" id="flexRadioDefault1" value="3">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Pay with stripe
                                </label>
                              </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">
                        <button class="btn-hover" type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<!-- checkout area end -->
@else
<div class="checkout_guest text-center py-5">
    <h3 style="font-weight: 700; ">You need to login to view this page.</h3>
     <a href="{{ route('customer_register') }}" style="width: 135px; height: 33px; text-align:center; display:inline-block;  line-height: 33px;" class="shop-link btn btn-primary">Login Now</a>

</div>


@endauth

@endsection
@auth('customerlogin')

@section('footer_script')
<script>
      @if (session('notavailable_cart'))

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
        title: '{{ session('notavailable_cart') }}'
      })


    @endif
    $(document).ready(function() {
    $('#country').select2();
    $('#city').select2();
});
    $('#country').change(function(){
        var country_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type : 'post',
            url : '/getcity',
            data : {'country_id': country_id},
            success: function(data){
                $('#city').html(data);
            }

        });
    });
</script>
<script>
    $('.charge').click(function() {
        var charge = $(this).val();
        $('#charge').html(charge);

        var total = {{ $grand_total }};
        var grand_total = parseInt(charge)+total;
        $('#grand_total').val(grand_total);

        $('#grand_total').html('$'+grand_total);


    });
</script>

@endsection

@endauth
