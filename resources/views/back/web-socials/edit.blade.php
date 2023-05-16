@extends('layouts.back')
@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Web Socials Update</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('web-socials.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control"
                                    value="{{ $social->id }}" >
                            <div class="form-group">
                                <label for="title">Social Icon Name </label>
                                <input type="text" name="social_name" class="form-control"
                                    value="{{ $social->social_name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="title">Social Icon Link </label>
                                <input type="text" name="social_link" class="form-control"
                                    value="{{ $social->social_link }}" required>
                            </div>

                            <div class="image-preview">
                                <img src="{{ asset('images/' . $social->social_icon) }}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="title">Social Icon Image </label>
                                <input type="file" name="social_image" class="form-control-file">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <input type="submit" value="Update" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('javascript')
@endsection
