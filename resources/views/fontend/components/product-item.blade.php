<div class="product-item item {{ $product->tag }}">
    <div class="pi-pic">
        <img src="{{URL::to('public/fontend/img/products/' . ($product->productImages[0]->path ?? ''))}}" alt="">
        @if ($product->discount != NULL)
            <div class="sale">Sale</div>
        @endif
        <div class="icon">
           @if (isset($product->productLikes->product_id))
               <a href="{{ route('like',$product->id) }}" style="color: black" ><i  class="icon_heart"></i></a>
            @else
                <a href="{{ route('like',$product->id) }}" style="color: black"><i  class="icon_heart_alt"></i></a>
           @endif
        </div>
        <ul>
{{--            <li class="w-icon active"><a href="{{ route('cart.add',$product->id) }}"><i class="icon_bag_alt"></i></a></li>--}}
            <li class="quick-view" style=" width: 100%"><a href="{{ route('shop.product',$product->id) }}">+ Quick View</a></li>

        </ul>
    </div>
    <div class="pi-text">
        <div class="catagory-name">{{ $product->tag }}</div>
        <a href="{{ route('shop.product',$product->id) }}">
            <h5>{{ $product->name }}</h5>
        </a>
        <div class="product-price">
           @if ($product->discount != NULL )
                ${{ $product->discount }}
                <span>${{ $product->price }}</span>
            @else
                <span>${{ $product->price }}</span>
           @endif
        </div>
    </div>
</div>

