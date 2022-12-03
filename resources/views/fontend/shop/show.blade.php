@extends('fontend.layout.master')
@section('title','Product')
@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('shop.show') }}">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('fontend.shop.components.products-sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{URL::to('public/fontend/img/products/'. $product->productImages[0]->path)}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach ($product->productImages as $productImage)
                                        <div class="pt active" data-imgbigurl="{{URL::to('public/fontend/img/products/' . $productImage->path )}}">
                                            <img src="{{URL::to('public/fontend/img/products/' . $productImage->path )}}" alt="">
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->tag }}</span>
                                    <h3>{{ $product->name }}</h3>

                                    @if ($product->productLikes != NULL)

                                        <a href="{{ route('like',$product->id) }}" class="heart-icon"><i  class="icon_heart"></i></a>
                                    @else
                                        <a href="{{ route('like',$product->id) }}" class="heart-icon"><i  class="icon_heart_alt"></i></a>
                                    @endif

{{--                                    <a  href="{{ route('like',$product->id) }}" class="heart-icon"><i  class="icon_heart_alt"></i></a>--}}
                                </div>
                                <div class="pd-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->avgRating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                    <span>({{ count($product->productComments) }})</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{ $product->content }}</p>
                                    @if ($product->discount != NULL)
                                        <h4>${{ $product->discount }} <span>{{ $product->price }}</span></h4>
                                    @else
                                        <h4>${{ $product->discount }}</h4>
                                    @endif
                                </div>
                                <form method="post" action="{{ route('cart.add',$product->id) }}">
                                    @csrf

                                    <div class="pd-color">
                                        <h6>Color</h6>
                                        <div class="pd-color-choose">
                                            @foreach (array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor)
                                                <div class="cc-item">
                                                    <input type="radio" name="color" id="cc-{{ $productColor }}" value="{{ $productColor }}" required
                                                        {{ request('color') == $productColor ? 'checked' : '' }}>
                                                    <label for="cc-{{ $productColor }}" class="cc-{{ $productColor }}"></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="pd-size-choose">
                                        @foreach (array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize)

                                            <div class="sc-item">
                                                <input type="radio" name="size" id="sm-{{ $productSize }}" value="{{ $productSize }}" required
                                                    {{ request('size') == $productSize ? 'checked' : '' }}>
                                                <label for="sm-{{ $productSize }}">{{ $productSize }}</label>
                                            </div>

                                        @endforeach
                                    </div>
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="qty" id="qty" >
                                        </div>
                                        <input type="submit" value="Add To Cart" href="" class="primary-btn pd-cart"></input>
                                    </div>
                                </form>
                                <ul class="pd-tags">
                                    <li><span>CATEGORIES</span>: {{ $product->productCategory->name }}</li>
                                    <li><span>TAGS</span>: {{ $product->tag }}</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Sku : {{ $product->sku }}</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews ({{ count($product->productComments) }})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $product->avgRating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{ count($product->productComments) }})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">${{ $product->price}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">{{ $product->qty }} in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">{{ $product->weight }}kg</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-size">
                                                        @foreach (array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize)
                                                            {{ $productSize }}
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Color</td>
                                                <td>
                                                    @foreach (array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor)
                                                        <label class="cc-{{ $productColor }}"></label>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">{{ $product->sku }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{ count($product->productComments) }} Comments</h4>
                                        <div class="comment-option">
                                           @foreach ($product->productComments as $productComment)
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="{{URL::to('public/fontend/img/user/' . $productComment->user->avatar ?? 'default-avatar.png')}}" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $productComment->rating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <h5>{{ $productComment->name }}<span>{{ date('M d, y',strtotime($productComment->created_at)) }}</span></h5>
                                                    <div class="at-reply">{{ $productComment->messages }}</div>
                                                </div>
                                            </div>
                                           @endforeach

                                        </div>

                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                            <form action="" method="post" class="comment-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                                <div class="row">
                                                    @if (\Illuminate\Support\Facades\Auth::check())
                                                        <div class="col-lg-6">
                                                            <input type="text" name="Name" placeholder="Name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="email" placeholder="Email" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                                                        </div>
                                                    @else
                                                        <div class="col-lg-6">
                                                            <input type="text" name="Name" placeholder="Name">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="email" placeholder="Email">
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Messages" name="messages" required></textarea>
                                                        <div class="personal-rating">
                                                            <h6>Your Rating</h6>
                                                            <div class="rate">
                                                                <input type="radio" id="star5" name="rating" value="5" required />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" name="rating" value="4" required/>
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" name="rating" value="3" required/>
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" name="rating" value="2" required/>
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" name="rating" value="1" required/>
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="site-btn">Send message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($relatedProducts as $product)
                    <div class="col-lg-3 col-sm-6">
                       @include('fontend.components.product-item',['product' => $product])
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
   <style>
       .product-details .pd-color .pd-color-choose .cc-item label.cc-yellow {
           background: #EEEE21;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-violet {
           background: #8230E3;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-blue {
           background: blue;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-black {
           background: black;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-red {
           background: red;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-grey {
           background: grey;
       }

       .product-details .pd-color .pd-color-choose .cc-item label.cc-green {
           background: green;
       }

       table tbody tr td label.cc-yellow{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: #EEEE21;
           margin-bottom: 0;
       }
       table tbody tr td label.cc-green{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: green;
           margin-bottom: 0;
       }
       table tbody tr td label.cc-blue{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: blue;
           margin-bottom: 0;
       }
       table tbody tr td label.cc-red{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: red ;
           margin-bottom: 0;
       }
       table tbody tr td label.cc-black{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: black;
           margin-bottom: 0;
       }

       table tbody tr td label.cc-violet{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background:  #8230E3;
           margin-bottom: 0;
       }
       table tbody tr td label.cc-grey{
           height: 20px;
           width: 20px;
           border-radius: 50%;
           background: grey;
           margin-bottom: 0;
       }

   </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
