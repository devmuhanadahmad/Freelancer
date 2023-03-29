@extends('layouts.master')
@section('title', 'Role - Freelanser')
@section('breadcrumb', 'Role')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">

                @can('role.create')
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
                        <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"
                            href="{{ route('role.create') }}">{{ __('Add Role') }}</a>
                    </div>
                @endcan

                <div class="card-body">
                    <h3 class="card-title">{{ __('List Roles') }}</h3>
                    <br>


                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Opreation') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->user_count }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('role.update')
                                                        <a class="dropdown-item"
                                                            href=" {{ route('role.edit', $role->id) }}">{{ __('Update') }}
                                                        </a>
                                                    @endcan

                                                    <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        @can('role.delete')
                                                            <button class="dropdown-item" href="#"
                                                                data-target="#delete_invoice"><i
                                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{ __('Delete') }}
                                                            </button>
                                                        @endcan

                                                    </form>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">{{ __('No Data .') }}</td>
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
