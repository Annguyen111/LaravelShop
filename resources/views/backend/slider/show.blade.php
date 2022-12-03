@extends('backend.layout.master')
@section('title','Slider')
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
                        Slider
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

                        <div class="position-relative row form-group">
                            <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                            <div class="col-md-9 col-xl-8">
                                <ul class="text-nowrap overflow-auto" id="images">

                                        <li class="d-inline-block mr-1" style="position: relative;">
                                            <img style="height: 150px;" src="{{ URL::to('public/fontend/img/slider/' . $slider->image) }}"
                                                 alt="Image">
                                        </li>

                                </ul>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Title</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $slider->title }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id"
                                   class="col-md-3 text-md-right col-form-label">Tag</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $slider->tag }}</p>
                            </div>
                        </div>



                        <div class="position-relative row form-group">
                            <label for="content"
                                   class="col-md-3 text-md-right col-form-label">Sale percent</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{!! $slider->sale !!} </p>
                            </div>
                        </div>

                        



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection

