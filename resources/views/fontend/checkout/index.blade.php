@extends('fontend.layout.master')
@section('title','Check Out')
@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('shop.show') }}">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="{{ route('checkout.add') }}" method="post"  class="checkout-form">
                @csrf
                <div class="row">
                    @if (Cart::count() > 0)
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="#" class="content-btn">Click Here To Login</a>
                            </div>
                            <h4>Biiling Details</h4>

                            <div class="row">

                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                                <div class="col-lg-6">
                                    <label for="fir">First Name<span>*</span></label>
                                    <input type="text" name="first_name" id="fir" value="{{ Auth::user()->name ?? '' }}">
                                    @if($errors->has('first_name'))
                                       <p class="text-danger"> {{ $errors->first('first_name') }}</p>
                                    @endif
                                </div>

                                <div class="col-lg-6">
                                    <label for="last">Last Name<span>*</span></label>
                                    <input type="text" name="last_name" id="last">
                                    @if($errors->has('last_name'))
                                        <p class="text-danger"> {{ $errors->first('last_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun-name">Company Name</label>
                                    <input type="text" name="company_name" id="cun-name" value="{{ Auth::user()->company_name ?? '' }}">
                                    @if($errors->has('company_name'))
                                        <p class="text-danger"> {{ $errors->first('company_name') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Country<span>*</span></label>
                                    <input type="text" name="country" id="cun" value="{{ Auth::user()->country ?? '' }}">
                                    @if($errors->has('country'))
                                        <p class="text-danger"> {{ $errors->first('country') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Street Address<span>*</span></label>
                                    <input type="text" id="street" name="street_address" class="street-first" value="{{ Auth::user()->street_address ?? '' }}">
                                    @if($errors->has('street_address'))
                                        <p class="text-danger"> {{ $errors->first('street_address') }}</p>
                                    @endif

                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">Postcode / ZIP (optional)</label>
                                    <input type="text" id="zip" name="postcode_zip" value="{{ Auth::user()->postcode_zip ?? '' }}">
                                    @if($errors->has('postcode_zip'))
                                        <p class="text-danger"> {{ $errors->first('postcode_zip') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Town / City<span>*</span></label>
                                    <input type="text" id="town" name="town_city" value="{{ Auth::user()->town_city ?? '' }}">
                                    @if($errors->has('town_city'))
                                        <p class="text-danger"> {{ $errors->first('town_city') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email Address<span>*</span></label>
                                    <input type="text" id="email" name="email" value="{{ Auth::user()->email ?? '' }}">
                                    @if($errors->has('email'))
                                        <p class="text-danger"> {{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Phone<span>*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}">
                                    @if($errors->has('phone'))
                                        <p class="text-danger"> {{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="create-item">
                                        <label for="acc-create">
                                            Create an account?
                                            <input type="checkbox" id="acc-create">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <input type="text" placeholder="Enter Your Coupon Code">
                            </div>
                            <div class="place-order">
                                <h4>Your Order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @foreach($carts as $cart)
                                            <li class="fw-normal">{{ $cart->name }} x {{ $cart->qty }}
                                                <span>${{ $cart->price * $cart->qty }}</span>
                                            </li>
                                        @if($cart->options->size != NULL && $cart->options->color != NULL)
                                            <li class="fw-normal">Size <span>{{ $cart->options->size }}</span></li>
                                            <li class="fw-normal">Color <span>{{ $cart->options->color }}</span></li>

                                            @endif
                                        @endforeach

                                        <li class="fw-normal">Subtotal <span>${{ $subtotal }}</span></li>

                                        <li class="total-price">Total <span>${{ $total }}</span></li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Pay later
                                                <input type="radio" id="pc-check" name="payment_type" value="pay_later" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Online payment
                                                <input type="radio" id="pc-paypal" name="payment_type" value="online_payment">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <h4>Your cart is empty</h4>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
