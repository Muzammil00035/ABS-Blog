@extends('layouts.innerFront')
@section('title', $user_detail->name)
@section('content')
    <section class="s-content" style="background-color: #eee;">
        <div class="container-fluid py-5">

            <div class="row" style="max-width:2000px">
                <div class="col-lg-4">
                    <div class="card mb-4" style="border-radius:20px;">
                        <div class="card-body text-center">
                            @if (empty($user_detail->user_image))
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            @else
                                <img src="{{ asset('/images/' . $user_detail->user_image) }}" alt="avatar"
                                    class="rounded-circle img-fluid"
                                    style="width: 150px;height: 150px;
                                    object-fit: cover;">
                            @endif
                            <h5 class="my-3">{{ $user_detail->name }}</h5>
                            <p class="text-muted mb-1">{{ $user_detail->user_intro }}</p>
                            {{-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> --}}
                            {{-- <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary">Follow</button>
                                <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://mdbootstrap.com</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-8">
                    <div class="d-flex align-items-start">
                        <h3 class="mt-0 mb-5">Published Articles</h3>
                    </div>
                    @if (count($posts) > 0)
                        <div class="row">

                            @for ($i = 0; $i < count($posts); $i++)
                                @php
                                    $date = new \DateTime($posts[$i]->created_at);
                                @endphp
                                <div class="col-md-4 mb-4">
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
                                                <a href="{{route('posts-slug.view' ,$posts[$i]->slug  )}}">
                                                    <h5 class="card-title mt-0 textTruncateOne" data-toggle="tooltip" title="{{$posts[$i]->title}}">{{ $posts[$i]->title }}</h5>
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
