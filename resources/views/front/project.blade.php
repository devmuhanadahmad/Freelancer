<x-front breadcrumb="Projects">



    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Project Title</h3>
                            <form action="{{route('front.project.index')}}" method="get" class="d-flex justify-content-between mb-4">
                                <input name="name" value="{{request('name')}}" placeholder="{{__("Enter name")}}" class="form-control  mx-2">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>

                        </div>

                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                              @foreach ($parentCategories as $parent)
                              <li>
                                <a href="product-grids.html">{{$parent->id}} </a><span>(0)</span>
                              </li>
                              @endforeach

                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget range">
                            <h3>Price Range</h3>
                            <input type="range" class="form-range" name="range" step="1" min="100" max="10000"
                                value="10" onchange="rangePrimary.value=value">
                            <div class="range-inner">
                                <label>$</label>
                                <input type="text" id="rangePrimary" placeholder="100" />
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>Filter by Price</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                <label class="form-check-label" for="flexCheckDefault1">
                                    $50 - $100L (208)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    $100L - $500 (311)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    $500 - $1,000 (485)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                <label class="form-check-label" for="flexCheckDefault4">
                                    $1,000 - $5,000 (213)
                                </label>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget condition">
                            <h3>Filter by Categories</h3>
                            @foreach ($childCategories as $parent)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11">
                                <label class="form-check-label" for="flexCheckDefault11">
                                    {{$parent->name}}  (0)
                                </label>
                            </div>
                            @endforeach

                        </div>
                        <!-- End Single Widget -->
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
                                                    <img width="200px" height="300px" src="{{  $project->image_url }}" alt="{{$project->slug}}">
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
                                                        <span>
                                                            <a href="javascript:void(0)"> <i class="lni lni-user"></i> {{$project->user->name}}</a>
                                                        </span>
                                                        <span>
                                                            <a href="javascript:void(0)"><i class="lni lni-calendar"></i> {{$project->created_at->diffForHumans()}}  </a>
                                                        </span>

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
