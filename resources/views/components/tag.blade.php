  <!-- Start Single Widget -->

  <div class="widget popular-tag-widget">
    <h5 class="widget-title">Popular Tags</h5>
    <div class="tags">
    @foreach ($tags as $tag)
        <a href="javascript:void(0)">#{{$tag->name}}</a>
        @endforeach
    </div>
</div>
<!-- End Single Widget -->

