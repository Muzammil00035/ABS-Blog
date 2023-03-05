@extends('layouts.innerFront')
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


                        </div> <!-- end s-entry__entry-content -->

                        <div class="s-content__entry-meta">

                            <div class="entry-author meta-blk">
                                <div class="byline">
                                    <span class="bytext">Published By</span>
                                    <a href="#0">{{ $post->user->name }}</a>
                                </div>
                            </div>
                            <div class="meta-bottom">
                                <div class="entry-tags meta-blk">
                                    <span class="tagtext">Category</span>
                                    <a
                                        href="{{ route('categories.view', $post->categories->first()->id) }}">{{ $post->categories->first()->title }}</a>
                                </div>

                            </div>

                        </div> <!-- s-content__entry-meta -->

                        <div class="s-content__pagenav">
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
                        <img src="{{ asset('/images/' . $post->interlink_image) }}" alt="" srcset="">
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Visit This URL</button>
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
