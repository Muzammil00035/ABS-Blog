@extends('layouts.front')
@section('title', 'Calvin')

@section('content')
    <section id="hero" class="s-hero">

        <div class="s-hero__slider">

            <div class="s-hero__slide">

                <div class="s-hero__slide-bg" style="background-image: url('images/privacy-policy.jpg');"></div>

                <div class="s-hero__slide-content-custom">
                    <div class="d-flex justify-content-center align-items-center profile-parent">

                        <h1>PRIVACY POLICY</h1>

                    </div>

                </div>


            </div> <!-- end s-hero__slide -->

    </section> <!-- end s-hero -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        @if (!empty($list))
                            <span>{!! $list->meta_value !!}</span>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')

    <script>
        $(document).ready(function() {



        });
    </script>
@endsection
