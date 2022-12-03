<!DOCTYPE html>
<html lang="zxx">

<head>
    {{-- <base href="{{ asset('/') }}"> --}}
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>


    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">


    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/fontend/css/style.css') }}" type="text/css">
</head>
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        display: none;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }

    body::-webkit-scrollbar{
        width: 10px;
    }

    body::-webkit-scrollbar-thumb{
        background-color: #e7ab3c;
        border-radius: 100rem;
    }
    body::-webkit-scrollbar-track{
        background-color: #cccccc;
        border-radius: 100rem;
    }
</style>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">


                </div>
                <div class="ht-right">

                    @if (Auth::check())
                        <a href="{{ route('logout') }}" class="login-panel">
                            <i class="fa fa-user"></i>
                            {{ Auth::user()->name }} - Logout
                        </a>


                    @else
                        <a href="{{ route('login.show') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    @endif
                        <a class="login-panel mr-3" href="{{ route('myOrderIndex') }}">My Order</a>


                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{ route('home.index') }}">
                                <img src="{{ asset('public/fontend/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <form action="{{ URL::to('shop') }}" >
                            <div class="advanced-search">
                                <button type="button" class="category-btn">All Categories</button>
                                <div class="input-group">
                                    <input name="search" type="text" value="{{ request('search') }}" placeholder="What do you need?">
                                    <button type="submit"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="{{ route('like.index') }}">
                                    <i class="icon_heart_alt"></i>
                                    @if(isset($productlikes))
                                        <span>{{ count($productlikes) }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="{{ route('cart.show') }}">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{ Cart::count() }}</span>
                                </a>
                                <div class="cart-hover">
                                    @if (count(Cart::content()) > 0)
                                    <div class="select-items">
                                            <table>
                                                <tbody>
                                                    @foreach (Cart::content() as $cart)
                                                        <tr>
                                                            <td class="si-pic"><img style="height: 70px" src="{{asset('public/fontend/img/products/' . $cart->options->images[0]->path )}}" alt=""></td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>${{ number_format($cart->price, 2)  }} x {{ $cart->qty }}</p>
                                                                    <h6>{{ $cart->name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="si-close">
                                                                <i onclick="window.location='{{ route('cart.delete',$cart->rowId)}}'" class="ti-close"></i>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>

                                    </div>
                                    @else
                                        <p class="text-center">Cart is emptying</p>

                                    @endif
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>${{ Cart::total() }}</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="{{ route('cart.show') }}" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="{{ route('checkout.show') }}" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">${{ Cart::total() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">

                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{ (request()->segment(1) == '') ? 'active' : '' }}"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="{{ (request()->segment(1) == 'shop') ? 'active' : '' }}"><a href="{{ route('shop.show') }}">Shop</a></li>

                        <li><a href="{{URL::to('/blog')}}">Blog</a></li>
                        <li><a href="{{ route('contact.index') }}">Contact</a></li>

                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    {{-- Body here --}}

    @yield('body')
    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{ asset('public/fontend/img/logo-carousel/logo-1.png') }}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{ asset('public/fontend/img/logo-carousel/logo-2.png') }}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{ asset('public/fontend/img/logo-carousel/logo-3.png') }}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{ asset('public/fontend/img/logo-carousel/logo-4.png') }}" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="{{ asset('public/fontend/img/logo-carousel/logo-5.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="{{ route('home.index') }}"><img src="{{asset('public/fontend/img/footer-logo.png')}}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +35 65 93 936</li>
                            <li>Email: anvy1791@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="{{ route('checkout.show') }}">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact</a></li>
                            <li><a href="{{ route('cart.show') }}">Shopping Cart</a></li>
                            <li><a href="{{ route('shop.show') }}">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="{{ asset('public/fontend/img/payment-method.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="{{ asset('public/fontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('public/fontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/owlcarousel2-filter.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/main.js') }}"></script>

    <script>

        /*-------------------
   Range Slider
   --------------------- */
        var rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max');

        minValue = rangeSlider.data('min-value') !== '' ? rangeSlider.data('min-value') : minPrice;
        maxValue = rangeSlider.data('max-value') !== '' ? rangeSlider.data('max-value') : maxPrice;
        rangeSlider.slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                minamount.val('$' + ui.values[0]);
                maxamount.val('$' + ui.values[1]);
            }
        });
        minamount.val('$' + rangeSlider.slider("values", 0));
        maxamount.val('$' + rangeSlider.slider("values", 1));

        /*-------------------
            Quantity change
        --------------------- */
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);

            //Update cart
            const rowId = $button.parent().find('input').data('rowid');
            updateCart(rowId,newVal);
        });

        function updateCart(rowId,qty){
            $.ajax({
                type:"GET",
                url:"cart/update",
                data:{rowId: rowId,qty: qty},
                success:function (response){
                    // alert('Update successful!')
                    console.log(response);
                    location.reload();
                },
                error: function (error){
                    // alert('Update failed!')
                    console.log(error);
                }
            });
        }


    </script>
</body>

</html>
