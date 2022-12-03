@extends('fontend.layout.master')
@section('title','Product Favourite')
@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <span>My favourite products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <h2 class="text-center mb-5">My Favourite</h2>
            <div class="row">

                <div class="col-lg-9 order-1 order-lg-2">

                    <div class="product-list">
                        <div class="row">
                            @if($productlikes != NULL)
                                @foreach ($productlikes as $product)

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="product-item item {{ $product->products->tag ?? 'Không liên kết được' }}">
                                            <div class="pi-pic">
                                                <img src="{{URL::to('public/fontend/img/products/' . ($product->products->productImages[0]->path ?? 'Không liên kết được'))}}" alt="">
                                                @if ($product->products->discount != NULL)
                                                    <div class="sale">Sale</div>
                                                @endif
                                                <div class="icon">
                                                    @if ($product->products->id == $product->product_id)
                                                        <a href="{{ route('like',$product->products->id) }}" style="text-decoration: none;color: black"><i  class="icon_heart"></i></a>
                                                    @else
                                                        <a href="{{ route('like',$product->products->id) }}" style="text-decoration: none;color: black"><i  class="icon_heart_alt"></i></a>
                                                    @endif
                                                    
                                                </div>
                                                <ul>
    {{--                                                            <li class="w-icon active"><a href="{{ route('cart.add',$product->id) }}"><i class="icon_bag_alt"></i></a></li>--}}
                                                    <li class="quick-view" style=" width: 100%"><a href="{{ route('shop.product',$product->products->id) }}">+ Quick View</a></li>

                                                </ul>
                                            </div>
                                            <div class="pi-text">
                                                <div class="catagory-name">{{ $product->products->tag ?? 'Không liên kết được' }}</div>
                                                <a href="{{ route('shop.product',$product->products->id) }}">
                                                    <h5>{{ $product->products->name }}</h5>
                                                </a>
                                                <div class="product-price">
                                                    @if ($product->products->discount != NULL )
                                                        ${{ $product->products->discount }}
                                                        <span>${{ $product->products->price }}</span>
                                                    @else
                                                        <span>${{ $product->products->price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h4 class="text-center">Nothing!</h4>
                                <a href="{{ route('home.index') }}" class="primary-btn mt-5">Shopping</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

@endsection
