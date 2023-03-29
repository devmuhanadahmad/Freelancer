<div class="widget popular-feeds">
    <h5 class="widget-title">Featured Posts</h5>
    <div class="popular-feed-loop">
        @foreach ($projects as $project)
        <div class="single-popular-feed">
            <div class="feed-desc">
                <a class="feed-img" href="{{route('proposal.create',$project->id)}}">
                    <img src="{{$project->image_url}}" width="200px" height="200px" alt="{{$project->slug}}">
                </a>
                <h6 class="post-title"><a href="{{route('proposal.create',$project->id)}}">{{$project->name}}</a></h6>
                <span class="time"><i class="lni lni-calendar"></i> {{$project->created_at->diffForHumans()}}</span>
            </div>
        </div>
        @endforeach

    </div>
</div>
