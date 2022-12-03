
@extends('backend.layout.master')
@section('title','Order')
@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">

                        <div class="table-responsive">
                            <h2 class="text-center">Products list</h2>
                            <hr>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img style="height: 60px;"
                                                                 data-toggle="tooltip" title="Image"
                                                                 data-placement="bottom"
                                                                 src="{{URL::to('public/fontend/img/products/' . $orderDetail->product->productImages[0]->path )}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $orderDetail->product->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->qty }}
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->size }}
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->color }}
                                        </td>
                                        <td class="text-center">${{ $orderDetail->amount }}</td>
                                        <td class="text-center">
                                            ${{ $orderDetail->total }}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>





                            <h2 class="text-center mt-5">Order info</h2>
                            <hr>
                            <div class="position-relative row form-group">
                                <label for="name" class="col-md-3 text-md-right col-form-label">
                                    Full Name
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->first_name . ' ' . $order->last_name }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->email }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->phone }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="company_name" class="col-md-3 text-md-right col-form-label">
                                    Company Name
                                </label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->company_name }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                    Street Address</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->street_address }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="town_city" class="col-md-3 text-md-right col-form-label">
                                    Town City</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->town_city }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="country"
                                       class="col-md-3 text-md-right col-form-label">Country</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->country }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
                                    Postcode Zip</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->postcode_zip }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="payment_type" class="col-md-3 text-md-right col-form-label">Payment Type</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->payment_type }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="status" class="col-md-3 text-md-right col-form-label">Status</label>
                                <div class="col-md-9 col-xl-8">
                                    <div class="badge badge-dark mt-2">
                                        {{ \App\Utilities\Constant::$order_status[$order->status] }}
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="description"
                                       class="col-md-3 text-md-right col-form-label">Description</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $order->description }}</p>
                                </div>
                            </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2 row">
                                    @if(\App\Utilities\Constant::$order_status[$order->status] == 'Confirmed')
                                        <form action="{{ route('order.update',$order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"  value="cancel">
                                            <button type="submit" class="border-0 btn btn-outline-danger mr-1" >
                                                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                                                    <i class="fa fa-times fa-w-20"></i>
                                                                </span>
                                                <span>Cancel</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('order.update',$order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"  value="processing">
                                            <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary" >
                                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                                    <i class="fa fa-download fa-w-20"></i>
                                                                </span>
                                                <span>Processing</span>
                                            </button>
                                        </form>
                                    @endif
                                    @if(\App\Utilities\Constant::$order_status[$order->status] == 'Receive Orders')
                                        <form action="{{ route('order.update',$order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"  value="unconfirmed">
                                            <button type="submit" class="border-0 btn btn-outline-danger mr-1" >
                                                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                                                    <i class="fa fa-times fa-w-20"></i>
                                                                </span>
                                                <span>Cancel</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('order.update',$order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"  value="confirm">
                                            <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary" >
                                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                                    <i class="fa fa-download fa-w-20"></i>
                                                                </span>
                                                <span>Confirm</span>
                                            </button>
                                        </form>
                                    @endif
                                        @if(\App\Utilities\Constant::$order_status[$order->status] == 'Cancel')

                                        @endif
                                        @if(\App\Utilities\Constant::$order_status[$order->status] == 'Processing')
                                            <form action="{{ route('order.update',$order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"  value="unconfirmed">
                                                <button type="submit" class="border-0 btn btn-outline-danger mr-1" >
                                                                <span class="btn-icon-wrapper pr-1 opacity-8">
                                                                    <i class="fa fa-times fa-w-20"></i>
                                                                </span>
                                                    <span>Cancel</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('order.update',$order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"  value="shipping">
                                                <button type="submit"
                                                        class="btn-shadow btn-hover-shine btn btn-primary" >
                                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                                    <i class="fa fa-download fa-w-20"></i>
                                                                </span>
                                                    <span>Shipping</span>
                                                </button>
                                            </form>
                                        @endif
                                        @if(\App\Utilities\Constant::$order_status[$order->status] == 'Shipping' ||
                                            \App\Utilities\Constant::$order_status[$order->status] == 'Paid')

                                            <form action="{{ route('order.update',$order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"  value="finish">
                                                <button type="submit"
                                                        class="btn-shadow btn-hover-shine btn btn-primary" >
                                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                                    <i class="fa fa-download fa-w-20"></i>
                                                                </span>
                                                    <span>Finish</span>
                                                </button>
                                            </form>
                                        @endif
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
