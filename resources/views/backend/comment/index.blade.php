@extends('backend.layout.master')
@section('title','Blog')
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
                        Comment
                        <div class="page-title-subheading">
                            View, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">

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

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Product Name</th>


                                <th class="text-center">User Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Message</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-center text-muted">#{{ $comment->id }}</td>
                                    <td class="text-center">{{ $comment->product->name }}</td>
                                    <td class="text-center">{{ $comment->user->name }}</td>
                                    <td class="text-center">{{ $comment->user->email }}</td>
                                    <td class="text-center">{{ $comment->messages }}</td>
                                    <td class="text-center">{{ $comment->rating }} <i class="rating fa-sharp fa-solid fa-star"></i></td>
                                    <td class="text-center">
                                        {{ date('M d, Y',strtotime($comment->created_at)) }}
                                    </td>
                                    <td class="text-center">


                                        <form class="d-inline" action="{{ route('comment.destroy',$comment->id) }}" method="post">
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
                        {{ $comments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection
