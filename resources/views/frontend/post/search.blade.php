<div id="search_result_front">
<div class="main-news">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
         @foreach($posts as $post)
            <div class="col-md-4">
                <div class="mn-img">
                <img src="{{ $post->images->first()->image}}" />
                <div class="mn-title">
                    <a href="{{ route('frontend.post.show' , $post->slug) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                </div>
                </div>
            </div>
         @endforeach
          </div>
    
        </div>
      </div>
    </div>
  </div>
</div>
</div