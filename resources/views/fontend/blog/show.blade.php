
@extends('fontend.layout.master')
@section('title','Blog')
@section('body')
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{ $blog->title }}</h2>
                            <p>{{ $blog->category }} <span>{{ date('M d, Y',strtotime($blog->created_at)) }}</span></p>
                        </div>
                        <div class="blog-large-pic">
                            <img src="{{asset('public/fontend/img/blog/' . $blog->image )}}" alt="">
                        </div>
                        <div class="blog-detail-desc">
                            <p>
                                {{ $blog->content }}
                            </p>
                        </div>
                        <div class="blog-quote">
                            <p>
                                {{ $blog->subtitle }}
                            </p>
                        </div>
                        <div class="blog-more">

                        </div>

                        <div class="tag-share">
                            <div class="details-tag">
                                <ul style="margin-left: 15px">
                                    <li><i class="fa fa-tags"></i></li>
                                    <li>Travel</li>
                                    <li>Beauty</li>
                                    <li>Fashion</li>
                                </ul>
                            </div>
                            <div class="blog-share">
                                <span>Share:</span>
                                <div class="social-links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-post">
                            <div class="row">

                                    <div class="col-lg-5 col-md-6">
                                        @if($blog->id > 1 || $previousBlog != NULL)
                                        <a href="{{ route('blog.item', $previousBlog->id) }}" class="prev-blog">
                                            <div class="pb-pic">
                                                <i class="ti-arrow-left"></i>
                                                <img style="border-radius:50% " src="{{URL::to('public/fontend/img/blog/' . $previousBlog->image)}}" alt="">
                                            </div>
                                            <div class="pb-text">
                                                <span>Previous Post:</span>
                                                <h5>{{ $previousBlog->title }}</h5>
                                            </div>
                                        </a>
                                        @endif
                                    </div>


                                <div class="col-lg-5 offset-lg-2 col-md-6">
                                    @if ($nextBlog != NULL)
                                        <a href="{{ route('blog.item', $nextBlog->id) }}" class="next-blog">
                                            <div class="nb-pic">
                                                <img style="border-radius: 50% " src="{{URL::to('public/fontend/img/blog/' . $nextBlog->image)}}" alt="">
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            <div class="nb-text">
                                                <span>Next Post:</span>
                                                <h5>{{ $nextBlog->title }}</h5>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if( $blogComment != NULL)
                            <div class="posted-by">
                                <div class="pb-pic" >
                                    <img style="width: 100px; height: 100px; border-radius: 50%" src="{{ URL::to('public/fontend/img/user/' . ($blogComment->userComment->avatar ?? 'default-avatar.png')) }}" alt="">
                                </div>
                                <div class="pb-text">
                                    <a href="#">
                                        <h5>{{ $blogComment->name }}</h5>
                                    </a>
                                    <p>
                                        {{ $blogComment->messages }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="leave-comment">
                            <h4>Leave A Comment</h4>
                            <form action="{{ route('blog.postComment',$blog->id) }}" class="comment-form" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                    @if( Auth::check())
                                        <div class="col-lg-6">
                                            <input name="name" type="text" placeholder="Name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="col-lg-6">
                                            <input name="email" type="text" placeholder="Email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="messages" placeholder="Messages" required></textarea>
                                            <button type="submit" class="site-btn">Send message</button>
                                        </div>
                                    @else
                                        <div class="col-lg-6">
                                            <input name="name" type="text" placeholder="Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <input name="email" type="text" placeholder="Email">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="messages"  placeholder="Messages" required></textarea>
                                            <button type="submit" class="site-btn">Send message</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
