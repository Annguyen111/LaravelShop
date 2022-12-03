@extends('fontend.layout.master')
@section('title','Result')
@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('checkout.show') }}">Check Out</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!--  Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="col-lg-12">
                <h4>
                    {{ $notification }}
                </h4>
                <a href="{{ route('home.index') }}" class="primary-btn mt-5">Continue Shopping</a>
            </div>
        </div>
    </section>
    <!--  Section End -->

@endsection
