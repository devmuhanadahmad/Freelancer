@extends('layouts.master')
@section('title', 'Category - Freelanser')
@section('breadcrumb', 'Category')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">

@can('category.create')

<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-4">
     <a class="modal-effect btn btn-outline-dark " data-effect="effect-super-scaled"  href="{{ route('category.create') }}">{{__("Add Category")}}</a>

</div>
@endcan
                <div class="card-body">
                    <h3 class="card-title">{{__("List Categories")}}</h3>
                    <br>
                    <form action="{{route('category.index')}}" method="get" class="d-flex justify-content-between mb-4">
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
                                    <th>{{__('Parent Category')}}</th>
                                    <th>{{__("status")}}</th>
                                    <th>{{__("Creaed At")}} </th>
                                    <th>{{__("Opreation")}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1}}</th>
                                        <td>{{ $category->name }}</td>
                                        @if ( $category->parent_name )
                                        <td>{{ $category->parent_name}}</td>
                                        @else
                                        <td style="color:rgb(39,166,67)">Primary Category</td>
                                        @endif

                                        <td>
                                            @if ($category->status == 'active')
                                                <span class="text-success">{{ $category->status }}</span>
                                            @else
                                                <span class="text-danger">{{ $category->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('category.create')

                                                    <a class="dropdown-item"
                                                        href=" {{ route('category.edit', $category->id) }}">{{__("Update")}}
                                                    </a>
                                                    @endcan
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        @can('category.delete')

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
                        {{$categories->withQueryString()->links()}}
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
