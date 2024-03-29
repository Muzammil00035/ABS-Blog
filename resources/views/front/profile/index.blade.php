@extends('layouts.innerFront')
@section('title', $user_detail->name)
@section('content')

    <section id="hero" class="s-hero">

        {{-- <div class="s-hero__slider"> --}}
        <div>
            <div class="s-hero__slide">

                <div class="s-hero__slide-bg"
                    style="background-image: url({{ asset('images/user_profile3.jpg') }}); opacity:0.6;"></div>

                <div class="s-hero__slide-content-custom">
                    <div class="d-flex justify-content-center align-items-center profile-parent">
                        <div>
                            @if (!empty($user_detail->user_image))
                                <img class="profileCustomImg" src="{{ asset('images/'.$user_detail->user_image) }}" alt=""
                                    srcset="">
                            @else
                                <img class="profileCustomImg" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt=""
                                    srcset="">
                            @endif
                        </div>
                        <div>
                            <span class="profileUserName">{{ $user_detail->name }}</span>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center align-items-center profile-parent">
                        <div class="profileUserBio">
                            <p style="    font-family: 'proxima-nova', sans-serif;">
                                {{ $user_detail->user_intro ? $user_detail->user_intro : '' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center profile-parent">
                        <div class="profileUserBio">
                            <p>Person : {{ $user_detail->user_type ? $user_detail->user_type : 'Author' }}</p>
                        </div>
                    </div>
                </div>

            </div> <!-- end s-hero__slide -->


    </section> <!-- end s-hero -->
    <section class="s-content" style="background-color: #eee;">
        <div class="container-fluid py-5">

            <div class="row" style="max-width:2000px; ">
                <div class="col-lg-12">
                    {{-- <div class="d-flex align-items-start">
                        <h3 class="mt-0 mb-5">Published Articles</h3>
                    </div> --}}
                    @if (count($posts) > 0)
                        <div class="row mx-auto my-0">

                            @for ($i = 0; $i < count($posts); $i++)
                                @php
                                    $date = new \DateTime($posts[$i]->created_at);
                                @endphp
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card-deck">
                                        <div class="card" style="border-radius: 20px;">
                                            @if ($posts[$i]->image)
                                                <img class="card-img-top card-img-custom"
                                                    style="border-radius: 20px 20px 0px 0px;"
                                                    src="{{ asset('/images/' . $posts[$i]->image) }}" alt="Card image cap">
                                            @else
                                                <img class="card-img-top card-img-custom"
                                                    style="border-radius: 20px 20px 0px 0px;"
                                                    src="https://picsum.photos/400/200" alt="Card image cap">
                                            @endif
                                            <div class="card-body">
                                                <a href="{{ route('posts-slug.view', $posts[$i]->slug) }}">
                                                    <h5 class="card-title mt-0 textTruncateOne" data-toggle="tooltip"
                                                        title="{{ $posts[$i]->title }}">{{ $posts[$i]->title }}</h5>
                                                </a>
                                                <div class="cardTextSize card-text textTruncateTwo mb-4">
                                                    <span class="textTruncateTwo"
                                                        style="font-size: 15px;
                                                font-weight: 100;">{{ $posts[$i]->excerpt }}</span>
                                                </div>
                                                <p class="card-text"><small class="text-muted"
                                                        style="font-size: 12px; font-weight:100;">Last updated
                                                        {{-- @if ($date->format('H') > 1) --}}
                                                        {{ $date->format('D') }}
                                                        {{ $date->format('d-m-Y') }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    @else
                        <div class="d-flex">
                            <span>No Published Blogs</span>
                        </div>
                    @endif'
                </div>

            </div>
        </div>
    </section>
@endsection
