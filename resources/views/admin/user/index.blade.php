@extends('layouts.master')
@section('title', 'Users - Freelanser')
@section('breadcrumb', 'User')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">

@can('user.create')

<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
     <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{ route('users.create') }}">{{__("Add User")}}</a>

</div>
@endcan
                <div class="card-body">
                    <h3 class="card-title">{{__("List Users")}}</h3>
                    <br>
                    <form action="{{route('users.index')}}" method="get" class="d-flex justify-content-between mb-4">
                        <input name="name" value="{{request('name')}}" placeholder="{{__("Enter name")}}" class="form-control  mx-2">
                        <select name="status" class="form-control  mx-2">
                            <option value="" >{{__("All")}}</option>
                        <option value="active" @selected(request('status' == 'active'))>{{__("Active")}} </option>
                        <option value="inactive" @selected(request('status' == 'inactive'))>{{__("Inactive")}}</option>

                    </select>

                    </select>

                            <button type="submit" class="btn bt-sm btn-primary">{{__("Filter")}}</button>
                        </form>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>{{__("ID")}}</th>
                                    <th>{{__("Name")}}</th>
                                    <th>{{__("Email")}}</th>
                                    <th>{{__("status")}}</th>
                                    <th>{{__("Creaed At")}} </th>
                                    <th>{{__("Opreation")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1}}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="text-success">{{ $user->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $user->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{$user->type}}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('user.update')
                                                    <a class="dropdown-item"
                                                        href=" {{ route('users.edit', $user->id) }}">{{__("Update")}}
                                                    </a>
                                                    @endcan
                                                    <form action="{{ route('users.destroy', $user->id) }}"
                                                        method="post">

                                                        @method('delete')
                                                        @csrf
                                                        @can('user.delete')
                                                        <button class="dropdown-item" href="#"
                                                            data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{__("Delete")}}
                                                        </button>
                                                        @endcan
                                                    </form>

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
                        {{$users->withQueryString()->links()}}
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
