<x-front breadcrumb="Add Project">
    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
       <div class="container">
           <div class="row">
               <div class="col-lg-8 col-md-12 col-12">
                   <div class="single-inner">
                       <div class="post-details">
                        <x-flash-message />
                           <!-- Add Project -->
                           <div class="comment-form">
                               <h3 class="comment-reply-title">Add Project now</h3>
                               <form action="{{route('front.project.store',$project->id)}}" method="POST">
                                   @csrf


                                   <div class="row">

                                       <div class=" col-12">
                                           <div class="form-box form-group">
                                               <x-form.input type="text" name="name" :value="$project->name" class="form-control form-control-custom"
                                                   placeholder="Project Title"  required/>
                                           </div>
                                       </div>

                                       <div class="col-12 mb-4">
                                        <x-form.textarea placeholder="Description" name="notes"/>
                                    </div>

                                       <div class="col-lg-6 col-12">
                                           <div class="form-box form-group">
                                               <x-form.input type="number" name="budget" :value="$project->budget" class="form-control form-control-custom"
                                                   placeholder="Budget"  required/>
                                           </div>
                                       </div>
                                       <div class="col-lg-6 col-12">
                                           <div class="form-box form-group">
                                               <x-form.status  name="type" :option="['hourly'=>'hourly','fixed'=>'fixed']" class="form-control form-control-custom"
                                                   placeholder="Type"  required/>
                                           </div>
                                       </div>

                                       <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <x-form.input  name="days_number" type="number" :value="$project->days_number" class="form-control form-control-custom"
                                                placeholder="Days Number"  required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <x-form.status  name="status" :option="['open'=>'Open','in-progress'=>'In Progress','closed'=>'Closed']" class="form-control form-control-custom"
                                                placeholder="Status"  required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-box form-group">
                                            <select name="category_id" @class([
                                                'form-control ','form-control-custom','SlectBox','is-invalid'=>$errors->has('category_id')
                                             ])
                                              onclick="console.log($(this).val())"
                                                 onchange="console.log('change is firing')">
                                                 <!--placeholder-->
                                                 <option value="" selected disabled>Primary Category</option>
                                                 @foreach ($categories as $parent)
                                                     <option value="{{ $parent->id }}" @selected(old('category_id',$project->category_id) == $parent->id)>
                                                         {{ $parent->name }}</option>
                                                 @endforeach
                                                 @error('category_id')
                                                 <small class="text-danger">{{ $message }}</small>
                                                 @enderror
                                             </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-box form-group">
                                            <x-form.input name="skills" type="text" lable="Skills" :value="implode(',',$skills)" class="form-control form-control-custom"
                                                placeholder="Skills"  required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-box form-group">
                                            <x-form.input name="tags" type="text" lable="Tags" :value="implode(',',$tags)" class="form-control form-control-custom"
                                                placeholder="Skills"  required/>
                                        </div>
                                    </div>

                                       <div class="col-lg-12 col-12 mt-4">
                                        <div class="form-box form-group">
                                            <x-form.input  type="file" name="image" class="dropify"
                                            accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" class="form-control form-control-custom"
                                                placeholder="File"  />
                                        </div>
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



                       </div>
                   </div>
               </div>
               <aside class="col-lg-4 col-md-12 col-12">
                   <div class="sidebar blog-grid-page">
                       <!-- Start Single Widget -->
                       <div class="widget search-widget">
                           <h5 class="widget-title">Ads section</h5>

                       </div>
                       <!-- End Single Widget -->
                       <!-- Start Single Widget -->
                       <x-last-project-show />
                       <!-- End Single Widget -->
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
   @push('css')
   <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
   @endpush
   @push('js')
   <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
   <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
   <script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify(inputElm);

    var inputElm = document.querySelector('[name=skills]'),
    tagify = new Tagify(inputElm);

   </script>
   @endpush
</x-front>



