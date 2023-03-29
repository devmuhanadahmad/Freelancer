@extends('layouts.master')
@section('title', 'Project - Freelanser')
@section('breadcrumb', 'Project')

@section('content')
    <!-- row opened -->
    <div class="row row-sm">


        <!--div-->
        <div class="col-xl-12">
            <x-flash-message />

            <div class="card">



                <div class="card-body">
                    <h3 class="card-title">{{ __('List Projects') }}</h3>
                    <br>


                    <form action="{{ route('project.index') }}" method="get" class="d-flex justify-content-between mb-4">
                        <input name="name" value="{{ request('name') }}" placeholder="{{ __('Enter name') }}"
                            class="form-control  mx-2">
                        <select name="status" class="form-control  mx-2">
                            <option value="">{{ __('All') }}</option>
                            <option value="open" @selected(request('status' == 'open'))>{{ __('Open') }} </option>
                            <option value="in-progress" @selected(request('status' == 'in-progress'))>{{ __('In progress') }}</option>
                            <option value="closed" @selected(request('status' == 'closed'))>{{ __('Closed') }}</option>

                        </select>

                        </select>

                        <button type="submit" class="btn bt-sm btn-primary">{{ __('Filter') }}</button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Title Project') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Users') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Tags') }}</th>
                                    <th>{{ __('Skills') }}</th>
                                    <th>{{ __('Creaed At') }} </th>
                                    <th>{{ __('Opreation') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($projects as $project)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td><img src="{{  $project->image_url }}" width="50"
                                            height="50" alt="{{ $project->name }}"></td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->category->name }}</td>
                                        <td>{{ $project->user->name }}</td>
                                        <td>
                                            @if ($project->status == 'open')
                                                <span class="text-success">Open</span>
                                            @elseif ($project->status == 'in-progress')
                                                <span class="text-warning">In progress</span>
                                            @else
                                                <span class="text-danger">Closed</span>
                                            @endif

                                        </td>
                                        <td class="">
                                            @foreach ($project->tag as $tag)
                                                <span class="bg-success .text-white


                                                mx-1">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="">
                                            @foreach ($project->skill as $skill)
                                                <span class="bg-success .text-white


                                                mx-1">{{ $tag->skill }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $project->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Opreation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('project.update')

                                                    <a class="dropdown-item"
                                                        href=" {{ route('project.edit', $project->id) }}">{{ __('Update') }}
                                                    </a>
                                                    @endcan
                                                    <form action="{{ route('project.destroy', $project->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        @can('project.delete')

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
                        {{ $projects->withQueryString()->links() }}
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
