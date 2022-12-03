@extends('backend.layout.master')
@section('title','Contact')
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
                        Contacts
                        <div class="page-title-subheading">
                            View, delete and manage.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">
                        @if(session('notification'))
                            <div class="alert alert-success" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('admin.postMessage',$contact->id) }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="brand_id"
                                       class="col-md-3 text-md-right col-form-label">Name</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $contact->name }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="brand_id"
                                       class="col-md-3 text-md-right col-form-label">Email</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ $contact->email }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="brand_id"
                                       class="col-md-3 text-md-right col-form-label">Date</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{{ date('M d, Y',strtotime($contact->created_at)) }}</p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="description"
                                       class="col-md-3 text-md-right col-form-label">Message</label>
                                <div class="col-md-9 col-xl-8">
                                    <p>{!! $contact->message !!} </p>
                                </div>
                            </div>

                            <div class="position-relative row form-group">
                                <label for="description"
                                       class="col-md-3 text-md-right col-form-label">Reply</label>
                                <div class="col-md-9 col-xl-8">
                                    <textarea class="form-control" name="reply" id="reply" placeholder="Message"></textarea>
                                </div>
                            </div>

                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-2">
                                    <a href="{{ URL::to('admin/contact') }}" class="border-0 btn btn-outline-danger mr-1">
                                                            <span class="btn-icon-wrapper pr-1 opacity-8">
                                                                <i class="fa fa-times fa-w-20"></i>
                                                            </span>
                                        <span>Cancel</span>
                                    </a>

                                    <button type="submit"
                                            class="btn-shadow btn-hover-shine btn btn-primary">
                                                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                                                <i class="fa fa-download fa-w-20"></i>
                                                            </span>
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>






                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.20.0/ckeditor.js" integrity="sha512-BcYkQlDTKkWL0Unn6RhsIyd2TMm3CcaPf0Aw1vsV28Dj4tpodobCPiriytfnnndBmiqnbpi2EelwYHHATr04Kg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        CKEDITOR.replace('reply');
    </script>
@endsection

