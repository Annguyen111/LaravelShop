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

                <div class="page-title-actions">
                    <a href="{{ route('slider.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-plus fa-w-20"></i>
                                        </span>
                        Create
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form >

                            <div class="input-group">
                                <input type="search" name="search" id="search"
                                       placeholder="Search everything" class="form-control" value="{{ request('search') }}">
                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-search"></i>&nbsp;
                                                        Search
                                                    </button>
                                                </span>
                            </div>
                        </form>

                        
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                


                                <th class="text-center">Image</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Sale Percent</th>
                                <th class="text-center">Tag</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($sliders as $slider)
                                <tr>
                                    <td class="text-center text-muted">#{{ $slider->id }}</td>
                                    <td class="text-center" style="width: 400px">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;"
                                                             data-toggle="tooltip" title="Image"
                                                             data-placement="bottom"
                                                             src="{{ URL::to('public/fontend/img/slider/' . ($slider->image ?? '')) }}" alt="">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </td>
                                   

                                    <td class="text-center">
                                        {{ $slider->title }}
                                    </td>
                                    <td class="text-center">
                                        {{ $slider->sale }}
                                    </td>
                                    <td class="text-center">
                                        {{ $slider->tag }}
                                    </td>
                                    <td class="text-center">
                                        <a href=" slider/{{ $slider->id }}"
                                           class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                        <a href="{{ route('slider.edit',$slider->id) }}" data-toggle="tooltip" title="Edit"
                                           data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                            <span class="btn-icon-wrapper opacity-8">
                                                                <i class="fa fa-edit fa-w-20"></i>
                                                            </span>
                                        </a>
                                        <form class="d-inline" action="{{ route('slider.destroy',$slider->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                                    type="submit" data-toggle="tooltip" title="Delete"
                                                    data-placement="bottom"
                                                    onclick="return confirm('Do you really want to delete this item?')">
                                                                <span class="btn-icon-wrapper opacity-8">
                                                                    <i class="fa fa-trash fa-w-20"></i>
                                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        {{-- {{ $slider->links() }} --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
