@extends('layouts.innerFront')
@section('title', $post->title)
@section('content')
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry format-standard">

                    <div class="s-content__media">
                        <div class="s-content__post-thumb text-center">
                            <img src="{{ asset('images/' . $post->image) }}" alt="">
                        </div>
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title s-content__title--post">{{ $post->title }}</h1>

                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__entry-content">

                            <p class="lead">
                                {{-- {{ $post->body }} --}}
                                {!! $post->body !!}
                            </p>

                            @if (count($post->headers) > 0)
                                <div class="">
                                    <div class="card border-0">
                                        @for ($i = 0; $i < count($post->headers); $i++)
                                            @if ($i % 2 == 0)
                                                <div class="row no-gutters mx-0">
                                                    <div class="col-sm-5">
                                                        <img class="card-img"
                                                            src={{ asset('images/' . $post->headers[$i]->image) }}
                                                            alt="Suresh Dasari Card">
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $post->headers[$i]->heading }}</h5>
                                                            <p class="card-text">{{ $post->headers[$i]->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row no-gutters mx-0">

                                                    <div class="col-sm-7">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $post->headers[$i]->heading }}</h5>
                                                            <p class="card-text">{{ $post->headers[$i]->description }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <img class="card-img" src="https://picsum.photos/400/200"
                                                            alt="Suresh Dasari Card">
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endif
                        </div> <!-- end s-entry__entry-content -->

                        <div class="s-content__entry-meta">

                            <div class="entry-author meta-blk">

                                <div class="byline">
                                    <span class="bytext">Published By</span>
                                    <a href="/profile/{{ $post->user_id }}">{{ $post->user->name }}</a>
                                </div>
                            </div>
                            <div class="meta-bottom">
                                <div class="entry-tags meta-blk">
                                    <span class="tagtext">Category</span>
                                    <a
                                        href="{{ route('categories.view', $post->categories->first()->id) }}">{{ $post->categories->first()->title }}</a>
                                </div>

                            </div>

                            {{-- <div class="meta-bottom mt-5">
                                <div class="entry-tags meta-blk">
                                    <span class="tagtext">Recent Articles</span>

                                </div>

                                @if (count($post->recentPost()) > 0)
                                    @php
                                        $recentPost = $post->recentPost();
                                    @endphp
                                    @for ($i = 0; $i < count($post->recentPost()); $i++)
                                        <a href="{{ route('posts.view', $recentPost[$i]->id) }}" class="thumb-link ">
                                            <div class="entry__thumb position-relative">

                                                <img src="{{ asset('images/' . $recentPost[$i]->image) }}" alt="">
                                                <div class="position-absolute articleText">
                                                    {{ $recentPost[$i]->title }}
                                                </div>
                                            </div>
                                        </a>
                                    @endfor
                                @endif

                            </div> --}}

                        </div> <!-- s-content__entry-meta -->

                        <div class="s-content__pagenav">
                            <div class="d-flex">
                                {!! $shareComponent !!}
                            </div>
                            @if ($post->previousPost())
                                <div class="prev-nav">
                                    <a href="{{ route('posts.view', $post->previousPost()->id) }}" rel="prev">
                                        <span>Previous</span>
                                        {{ $post->previousPost()->title }}
                                    </a>
                                </div>
                            @endif
                            @if ($post->nextPost())
                                <div class="next-nav">
                                    <a href="{{ route('posts.view', $post->nextPost()->id) }}" rel="next">
                                        <span>Next</span>
                                        {{ $post->nextPost()->title }}
                                    </a>
                                </div>
                            @endif

                            <div>
                                <span>Recent Post</span>
                            </div>
                            @if (count($post->recentPost()) > 0)
                                @php
                                    $recentPost = $post->recentPost();
                                @endphp
                                @for ($i = 0; $i < count($post->recentPost()); $i++)
                                    @php
                                        $date = new \DateTime($recentPost[$i]->created_at);
                                    @endphp
                                    <a href="{{ route('posts.view', $recentPost[$i]->id) }}" class="thumb-link ">
                                        <div class="d-flex align-items-start" style="gap:15px;">
                                            <div style="flex: 2">
                                                <img src="{{ asset('images/' . $recentPost[$i]->image) }}"
                                                    class="img-fluid img-thumbnail mt-0" alt="">

                                            </div>
                                            {{-- <div class="position-absolute bottom-3">How muchh bottom left </div> --}}
                                            <div style="flex: 2">
                                                <div>
                                                    <span class="textTruncateTwo">{{ $recentPost[$i]->title }}</span>
                                                </div>
                                                <div>
                                                    <span class="updateDate" style="font-size: 9px; font-weight:100;">Updated at {{ $date->format('d-m-Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                            @endif

                        </div> <!-- end s-content__pagenav -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->
    </section> <!-- end s-content -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($post->interlink_image)
                    <div class="modal-body">
                        @if ($post->url)
                            <a href="{{ $post->url }}">
                                <img src="{{ asset('/images/' . $post->interlink_image) }}" alt="" srcset="">
                            </a>
                        @else
                        @endif
                    </div>
                @endif
                <div class="modal-footer">
                    @if ($post->url)
                        <a href="{{ $post->url }}">
                            <button type="button" class="btn btn-primary">Visit This URL</button>
                        </a>
                    @else
                        <button type="button" class="btn btn-primary">Visit This URL</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            let interlink = {!! $post->interlink !!}
            let timer = {!! $post->time_in_second ? $post->time_in_second : 0 !!};
            if (interlink == 1) {

                setTimeout(() => {
                    $('#exampleModalCenter').modal('toggle');

                }, timer * 1000);

            }

        });
    </script>
@endsection
