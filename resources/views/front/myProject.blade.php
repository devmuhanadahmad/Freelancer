<x-front breadcrumb="My Projects">
    @push('css')

    @endpush
        <!-- Start Product Grids -->
        <section class="product-grids section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <!-- Start Product Sidebar -->
                        <div class="product-sidebar">
                            <!-- Start Single Widget -->
                            <div class="single-widget search">
                                <h3>Search Product</h3>
                                <form action="{{route('front.project.show')}}" method="get" class="d-flex justify-content-between mb-4">
                                    <input name="name" value="{{request('name')}}" placeholder="{{__("Enter name")}}" class="form-control  mx-2">
                                    <button type="submit"><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                            <!-- End Single Widget -->
                            <!-- Start Single Widget -->
                            <!-- End Single Widget -->
                            <!-- Start Single Widget -->
                            <div class="single-widget range">
                                <x-tag />

                            </div>
                        </div>
                        <!-- End Product Sidebar -->
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="product-grids-head">
                            <div class="product-grid-topbar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-8 col-12">
                                        <div class="product-sorting">
                                            
                                            <h3 class="total-show-product">Showing: <span>1 - 12 items</span></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-4 col-12">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link " id="nav-grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-grid" type="button" role="tab"
                                                    aria-controls="nav-grid" aria-selected="true"><i
                                                        class="lni lni-grid-alt"></i></button>
                                                <button class="nav-link active" id="nav-list-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-list" type="button" role="tab"
                                                    aria-controls="nav-list" aria-selected="false"><i
                                                        class="lni lni-list"></i></button>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                                    <div class="row">


                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Pagination -->
                                            <div class="pagination left">
                                                <ul class="pagination-list">
                                                    <li><a href="javascript:void(0)">1</a></li>
                                                    <li class="active"><a href="javascript:void(0)">2</a></li>
                                                    <li><a href="javascript:void(0)">3</a></li>
                                                    <li><a href="javascript:void(0)">4</a></li>
                                                    <li><a href="javascript:void(0)"><i
                                                                class="lni lni-chevron-right"></i></a></li>
                                                </ul>
                                            </div>
                                            <!--/ End Pagination -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane show active fade" id="nav-list" role="tabpanel"
                                    aria-labelledby="nav-list-tab">
                                    <div class="row">

                                    @foreach ($projects as $project)
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="product-image"  >
                                                        <img width="200px" height="200px" src="{{  $project->image_url }}" alt="{{$project->slug}}">
                                                        @if ($project->new_project)
                                                        <span class="new-tag">New</span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-12">
                                                    <div class="product-info">
                                                        <h1 class="title">
                                                            <a href="{{route('proposal.create',$project->id)}}">{{$project->name}}</a>
                                                        </h1>
                                                        <ul class="">


                                                            <li>
                                                                <a href="javascript:void(0)"><i class="lni lni-tag"></i> Status : {{$project->status}} </a>
                                                            </li>


                                                        </ul>
                                                        <p class="title">
                                                            {{$project->notes}}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach


                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Pagination -->
                                            <div class="pagination left">
                                                <ul class="pagination-list">
                                                    {{$projects->withQueryString()->links()}}
                                                </ul>
                                            </div>
                                            <!--/ End Pagination -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Grids -->


    @push('js')

    @endpush
    </x-front>
