@extends('frontend.master')
@section('status', 'active')
@section('title', 'show-post')
@section('content')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($post->images as $postImage)
                                <div class="carousel-item {{ $loop->index == 0 ? 'active' : ' ' }}">
                                    <img src="{{ $postImage->image }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $post->title }}</h5>
                                        <p>
                                            {{ substr($post->description, 0, 100) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        Breaking News: Major Advances in Renewable Energy Mark a New Era in Global Sustainability

                        Date: September 15, 2024

                        Location: Global

                        In a groundbreaking development that could reshape the future of energy consumption worldwide, a
                        coalition of leading environmental organizations, governments, and technology companies have
                        unveiled a series of significant advancements in renewable energy technology. This collaborative
                        effort promises to accelerate the transition away from fossil fuels and position the world towards a
                        more sustainable and environmentally friendly future.

                        Unveiling the New Technologies

                        At a press conference held earlier today, the coalition introduced three key innovations:

                        Next-Generation Solar Panels: Developed by SolarTech Innovations, these new solar panels feature a
                        revolutionary material that increases efficiency by 40% compared to traditional panels. This
                        breakthrough technology harnesses sunlight more effectively, even in low-light conditions, and is
                        expected to dramatically reduce the cost of solar energy for consumers.

                        Advanced Wind Turbines: WindPower Solutions has unveiled its latest model of wind turbines, which
                        are designed to be 50% more efficient than previous versions. The new turbines incorporate advanced
                        aerodynamics and lightweight materials, allowing them to generate more power even at lower wind
                        speeds. The company has also announced a plan to deploy these turbines in offshore wind farms,
                        potentially increasing global wind energy capacity by 25% within the next decade.

                        Next-Generation Battery Storage Systems: The Energy Storage Initiative has introduced a new type of
                        battery that significantly improves energy storage capacity and charging speed. These batteries are
                        designed to store energy from renewable sources more efficiently and provide a reliable backup
                        during periods of low energy generation. The innovation is expected to address one of the major
                        challenges in renewable energy: ensuring a stable and consistent energy supply.

                        Global Impact and Future Projections

                        According to a report released by the coalition, these advancements have the potential to reduce
                        global carbon emissions by up to 30% over the next 15 years. The report highlights that if adopted
                        on a large scale, these technologies could significantly decrease reliance on fossil fuels and
                        mitigate the effects of climate change.

                        Dr. Emily Carter, a leading climate scientist and advisor to the coalition, emphasized the
                        importance of this development. “The introduction of these technologies marks a pivotal moment in
                        our fight against climate change. By making renewable energy more efficient and accessible, we are
                        taking a significant step towards achieving our global sustainability goals.”

                        Policy Changes and Economic Implications

                        In response to the new technologies, several governments have announced plans to revise their energy
                        policies. The European Union has committed to increasing its investment in renewable energy
                        infrastructure, while the United States has proposed new incentives for companies and individuals to
                        adopt green technologies.

                        Economists predict that the shift towards renewable energy will also have substantial economic
                        benefits. The transition is expected to create thousands of new jobs in the renewable energy sector
                        and reduce long-term energy costs for consumers. Moreover, the decrease in fossil fuel dependency
                        will likely reduce geopolitical tensions related to energy resources.

                        Public and Industry Reactions

                        The announcement has been met with widespread acclaim from environmental groups, industry leaders,
                        and the general public. Greenpeace praised the innovations as a “game-changer” for the renewable
                        energy sector, while Tesla’s CEO, Elon Musk, hailed the new battery storage systems as a “major leap
                        forward” for energy sustainability.

                        However, some critics have raised concerns about the initial costs of implementing these new
                        technologies and the potential environmental impact of manufacturing the new materials. In response,
                        the coalition has assured that rigorous environmental assessments have been conducted and that
                        efforts are being made to minimize any potential negative effects.
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <div class="comment-input">
                            <input type="text" placeholder="Add a comment..." id="commentBox" />
                            <button id="addCommentBtn">Post</button>
                        </div>

                        <!-- Display Comments -->
                        <div class="comments">
                            <div class="comment">
                                <img src="{{ asset('assets-front') }}/img/news-450x350-2.jpg" alt="User Image"
                                    class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">User1</span>
                                    <p class="comment-text">This is an example comment.</p>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="{{ asset('assets-front') }}/img/news-450x350-2.jpg" alt="User Image"
                                    class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">User2</span>
                                    <p class="comment-text">This is an example comment.</p>
                                </div>
                            </div>
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-1.jpg" class="img-fluid"
                                        alt="Related News 1" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-2.jpg" class="img-fluid"
                                        alt="Related News 2" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-3.jpg" class="img-fluid"
                                        alt="Related News 3" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" class="img-fluid"
                                        alt="Related News 4" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">Related Posts</h2>
                            @foreach ($relatedPosts as $relatedPost)
                                <div class="news-list">
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ $relatedPost->images->first()->image }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#featured">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        @foreach ($latestCachedPosts as $latestCachedPost)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $latestCachedPost->images->first()->image }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $latestCachedPost->slug) }}">{{ $latestCachedPost->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach($cachedPopularPosts as $cachedPopularPost)
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ $cachedPopularPost->images->first()->image }}" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="{{ route('frontend.post.show' , $cachedPopularPost->slug)}}">{{ $cachedPopularPost->title }}</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="latest" class="container tab-pane fade">
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-5.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($newCatgories as $category)
                                        <li><a href="{{ route('frontend.category-posts' , $category->slug)}}">{{ $category->name }}</a><span>({{ $category->posts_count }})</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection
