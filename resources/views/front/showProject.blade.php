<x-front breadcrumb="Project">
     <!-- Start Blog Singel Area -->
     <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                            <div class="main-content-head">
                                <div class="post-thumbnils">
                                    <img src="{{$project->image_url}}" alt="{{$project->slug}}">
                                </div>
                                <div class="meta-information">
                                    <h2 class="post-title">
                                        <a href="blog-single.html">{{$project->name}}</a>
                                    </h2>
                                    <!-- End Meta Info -->
                                    <ul class="meta-info">
                                        <li>
                                            <a href="javascript:void(0)"> <i class="lni lni-user"></i> {{$project->user->name}}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-calendar"></i> {{$project->created_at->diffForHumans()}}  </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-tag"></i> {{$project->budget}} - {{$project->type}}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-timer"></i> {{$project->days_number}} Days</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-statu"></i> Status : {{$project->status}} </a>
                                        </li>
                                    </ul>
                                    <!-- End Meta Info -->
                                </div>
                                <div class="detail-inner">
                                    <p>{{$project->name}}.</p>


                                    <p>{{$project->notes}}.</p>
                                    <!-- post quote -->
                                  <div class="post-bottom-area">
                                        <!-- Start Post Tag -->
                                        <div class="post-tag">
                                            <ul>
                                                <li>#{{$project->skills}}</li>
                                            </ul>
                                        </div>
                                        <!-- End Post Tag -->



                                        status
                                    </div>
                                </div>
                            </div>
                            <!-- Comments -->
                            @auth

                            <div class="comment-form">
                                      <x-flash-message />
                                <h3 class="comment-reply-title">Add your offer now</h3>
                                <form action="{{route('proposal.store',$project->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-box form-group">
                                                <x-form.input type="number" name="cost" :value="$project->cost" class="form-control form-control-custom"
                                                    placeholder="Cost"  required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-box form-group">
                                                <x-form.input type="number" name="duration" :value="$project->duration" class="form-control form-control-custom"
                                                    placeholder="Duration"  required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <div class="form-box form-group">
                                                <x-form.status  name="duration_unit" :option="['day'=>'Day','week'=>'Week','month'=>'Month','year'=>'Year']" class="form-control form-control-custom"
                                                    placeholder="duration_unit"  required/>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-12">
                                            <div class="form-box form-group">
                                                <x-form.status  name="status" :option="['accepted'=>'accepted','week'=>'Week','month'=>'Month','year'=>'Year']" class="form-control form-control-custom"
                                                    placeholder="duration_unit"  required/>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <x-form.textarea placeholder="Description" name="description"/>
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <div class="button">
                                                <button type="submit" class="btn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endauth

                            <div class="post-comments">
                                <h3 class="comment-title"><span>Offers submitted</span></h3>
                                <ul class="comments-list">

                                    @foreach ($proposals as $proposal)
                                    <li>
                                        <div class="comment-img">
                                            <img src="{{$proposal->user->profile->image_url}}" alt="img">
                                        </div>
                                        <div class="comment-desc">
                                            <div class="desc-top">
                                                <h6>{{$proposal->user->name}}</h6>
                                                <span class="date">{{$proposal->created_at->diffForHumans()}}</span>

                                            </div>
                                            <p>
                                                {{$proposal->description}}
                                            </p>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title">Search This Site</h5>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title">Featured Posts</h5>
                            <div class="popular-feed-loop">
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">What information is
                                                needed for shipping?</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 05th Nov 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">Interesting fact about
                                                gaming consoles</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 24th March 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="blog-single-sidebar.html">
                                            <img src="https://via.placeholder.com/200x200" alt="#">
                                        </a>
                                        <h6 class="post-title"><a href="blog-single-sidebar.html">Electronics,
                                                instrumentation & control engineering </a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 30th Jan 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget categories-widget">
                            <h5 class="widget-title">Top Categories</h5>
                            <ul class="custom">
                                <li>
                                    <a href="javascript:void(0)">Editor's Choice</a><span>(24)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Electronics</a><span>(12)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Industrial Design</a><span>(5)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Secure Payments Online</a><span>(15)</span>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Online Shopping</a><span>(7)</span>
                                </li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-tag-widget">
                            <h5 class="widget-title">Popular Tags</h5>
                            <div class="tags">
                                <a href="javascript:void(0)">#electronics</a>
                                <a href="javascript:void(0)">#cpu</a>
                                <a href="javascript:void(0)">#gadgets</a>
                                <a href="javascript:void(0)">#wearables</a>
                                <a href="javascript:void(0)">#smartphones</a>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->
</x-front>
