    @extends('layouts.front')
    @section('title' , 'Calvin')

    @section('content')
        <section id="hero" class="s-hero">

            <div class="s-hero__slider">
                @if (count($featured) > 0)
                    @foreach ($featured as $post)
                        <div class="s-hero__slide">

                            <div class="s-hero__slide-bg" style="background-image: url('images/{{ $post->image }}');"></div>

                            <div class="row s-hero__slide-content animate-this">
                                <div class="column">
                                    <div class="s-hero__slide-meta">
                                        <span class="cat-links">
                                            <a href="#0">{{ $post->categories->first()->title }}</a>
                                        </span>
                                        <span class="byline">
                                            Posted by
                                            <span class="author">
                                                <a href="#0">{{ $post->user->name }}</a>
                                            </span>
                                        </span>
                                    </div>
                                    <h1 class="s-hero__slide-text">
                                        <a href="{{ route('posts.view', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h1>
                                </div>
                            </div>

                        </div> <!-- end s-hero__slide -->
                    @endforeach
                @else
                    <div class="s-hero__slide">

                        <div class="s-hero__slide-bg" style="background-image: url('images/home-imag1.jpg');"></div>

                        <div class="row s-hero__slide-content animate-this">
                            <div class="column">
                                <div class="s-hero__slide-meta">
                                    <span class="cat-links">
                                        <a href="#0"></a>
                                    </span>
                                    <span class="byline">
                                        Posted by
                                        <span class="author">
                                            <a href="#0"></a>
                                        </span>
                                    </span>
                                </div>
                                <h1 class="s-hero__slide-text">
                                    <a href="#0">

                                    </a>
                                </h1>
                            </div>
                        </div>

                    </div> <!-- end s-hero__slide -->
                @endif



                {{-- <div class="nav-arrows s-hero__nav-arrows">
                    <button class="s-hero__arrow-prev">
                        <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                            <path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path>
                        </svg>
                    </button>
                    <button class="s-hero__arrow-next">
                        <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                            <path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path>
                        </svg>
                    </button>
                </div> <!-- end s-hero__arrows --> --}}

        </section> <!-- end s-hero -->

        <section class="s-content s-content--no-top-padding">

            <div class="s-bricks">

                <div class="masonry">
                    <div class="bricks-wrapper h-group">

                        <div class="grid-sizer"></div>

                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        @foreach ($posts as $post)
                            <article class="brick entry" data-aos="fade-up">

                                <div class="entry__thumb">
                                    <a href="{{ route('posts.view', $post->id) }}" class="thumb-link">
                                        <img src="{{ asset('images/' . $post->image) }}" alt="">
                                    </a>
                                </div> <!-- end entry__thumb -->

                                <div class="entry__text">
                                    <div class="entry__header">
                                        <h1 class="entry__title"><a
                                                href="{{ route('posts.view', $post->id) }}">{{ $post->title }}</a></h1>

                                        <div class="entry__meta">
                                            <span class="byline">By:
                                                <span class='author'>
                                                    <a href="#">{{ $post->user->name }}</a>
                                                </span>
                                            </span>
                                            <span class="cat-links">
                                                <a href="#">{{ $post->categories->first()->title }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="entry__excerpt">
                                        <p>
                                            {{ $post->excerpt }}
                                        </p>
                                    </div>
                                    <a class="entry__more-link" href="{{ route('posts.view', $post->id) }}">Learn
                                        More</a>
                                </div> <!-- end entry__text -->

                            </article> <!-- end article -->
                        @endforeach

                    </div> <!-- end brick-wrapper -->

                </div> <!-- end masonry -->

            </div> <!-- end s-bricks -->

        </section> <!-- end s-content -->
        

        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                    <div class="modal-body p-0 row">
                        <div class="col-12 col-lg-5 ad p-0"> <img src="{{asset('images/home-imag1.jpg')}}" width="100%" height="100%"/> </div>
                        <div class="details col-12 col-lg-7">
                            <h2>STAY TUNED</h2>
                            <p><small class="para">Subscribe to our newsletter and never miss our<br> designs ,latest news.etc.</small></p>
                            <p><small class="para">Our newsletter is sent once a week, every<br>Monday</small></p>
                            <div class="form-group mt-3 pt-3 mb-5"><input type="email" class="form-control" placeholder="email@example.com">
                            </div>
                            <small class="text-muted"><a href="#">Personal Data Charter</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- Modal Show For News Letter --}}

        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered modal-newsletter">
                <div class="modal-content">
                    <form action="/" method="post">
                        <div class="modal-header justify-content-center">
                            <div class="icon-box">
                                <i class="material-icons">&#xE151;</i>
                            </div>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true"><span>&times;</span></button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Subscribe</h4>
                            <p>Subscriber our newsletter to receive the latest updates and promostions.</p>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email" required>
                                <input type="submit" class="btn btn-primary" value="Subscribe">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(() => {
                    $("#myModal").modal('show');
                }, 5000);
                
            });
        </script>
    @endsection
