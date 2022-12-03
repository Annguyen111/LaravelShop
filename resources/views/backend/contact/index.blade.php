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

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>



                                <th class="text-center">User Name</th>
                                <th class="text-center">Email</th>


                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="text-center text-muted">#{{ $contact->id }}</td>

                                    <td class="text-center">{{ $contact->name }}</td>
                                    <td class="text-center">{{ $contact->email }}</td>


                                    <td class="text-center">
                                        {{ date('M d, Y',strtotime($contact->created_at)) }}
                                    </td>
                                    <td class="text-center">


                                        <form class="d-inline" action="{{ route('admin.destroyContact',$contact->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.showContact',$contact->id) }}"
                                               class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                Reply
                                            </a>
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
                        {{ $contacts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection
