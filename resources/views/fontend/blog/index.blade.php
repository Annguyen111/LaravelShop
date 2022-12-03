
@extends('fontend.layout.master')
@section('title','Blog')
@section('body')
    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="blog-sidebar">
                        <div class="search-form">
                            <h4>Search</h4>
                            <form>
                                <input type="text" name="search" placeholder="Search field . . .  " value="{{ request('search') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>



                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        @foreach($blogs as $blog)
                            <div class="col-lg-6 col-sm-6">
                            <div class="blog-item">
                                <div class="bi-pic">
                                    <img src="{{URL::to('public/fontend/img/blog/' . $blog->image )}}" alt="">
                                </div>
                                <div class="bi-text">
                                    <a href="{{ route('blog.item',$blog->id) }}">
                                        <h4>{{ $blog->title }}</h4>
                                    </a>
                                    <p>{{ $blog->category }} <span>{{ date('M d, Y',strtotime($blog->created_at)) }}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12">
                            <div >
                                {{ $blogs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
