<x-front breadcrumb="Freelanser">
    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
       <div class="container">
           <div class="row">
               <div class="col-lg-8 col-md-12 col-12">
                   <div class="single-inner">
                       <div class="post-details">


                           <div class="post-comments">
                               <h3 class="comment-title"><span>Freelansers</span></h3>
                               <ul class="comments-list">

                                   @foreach ($freelansers as $freelanser)
                                   <li>
                                       <div class="comment-img">
                                           <img src="{{$freelanser->profile->image_url}}" alt="img">
                                       </div>
                                       <div class="comment-desc">
                                           <div class="desc-top">
                                               <h6><a href="{{route("showFreelanserProfile",$freelanser->id)}}">{{$freelanser->name}}</a></h6>
                                               <span class="date"><i class="lni lni-tag"></i>{{$freelanser->profile->job_name}}</span>

                                           </div>
                                           <p>
                                               {{$freelanser->profile->description}}
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
                           <h5 class="widget-title">Search Freelancer name</h5>
                           <form action="{{route('allFreelansers')}}" method="get" class="d-flex justify-content-between mb-4">
                            <input name="name" value="{{request('name')}}" placeholder="{{__("Enter freelansers name ")}}" class="form-control  mx-2">
                               <button type="submit"><i class="lni lni-search-alt"></i></button>
                           </form>
                       </div>

                       <!-- Start Single Widget -->

                       <!-- End Single Widget -->
                       <!-- Start Single Widget -->
                      <x-tag />
                    <!-- End Single Widget -->
                   </div>
               </aside>
           </div>
       </div>
   </section>
   <!-- End Blog Singel Area -->
</x-front>
