@extends('layouts.master')
@section('title', 'roleuser - Freelanser')
@section('breadcrumb', 'roleuser')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">


                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                     <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{ route('roleuser.create') }}">{{__("Add roleuser")}}</a>
                </div>

                <div class="card-body">
                    <h3 class="card-title">{{__("List roleusers")}}</h3>
                    <br>


                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>{{__("ID")}}</th>
                                    <th>{{__("Name User")}}</th>
                                    <th>{{__('role Name')}}</th>
                                    <th>{{__("Opreation")}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($roleuser as $roleuser)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1}}</th>
                                        <td>{{ $roleuser->user_id }}</td>
                                        <td>{{ $roleuser->role_id }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">


                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">{{__("No Data .")}}</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>

                        {{-- $user->links() --}}{{-- $user->links('pagintor.custom') --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
