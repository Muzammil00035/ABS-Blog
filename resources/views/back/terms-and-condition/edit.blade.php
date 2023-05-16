@extends('layouts.back')
@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Terms And Condition Add</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('terms-condition.update') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="setting_id" value="{{ $post->id }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Terms And Condition Body </label>
                                <textarea id="policy_body" name="body" class=" form-control" rows="4" required>{{ $post->meta_value }}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('policy_body', {
                // filebrowserBrowseUrl: '/browser/browse.php',
                // filebrowserUploadUrl: '/uploader/upload.php',
                // filebrowserWindowWidth: '640',
                // filebrowserWindowHeight: '480',
                toolbar: [
                    ['Bold', 'Italic', 'Link', 'Unlink', 'Image', 'Flash', 'Table', 'Undo', 'Redo',
                        'Cut', 'Copy', 'Paste', 'NumberedList', 'BulletedList', 'mediaEmbed'
                    ]
                    // ['Link', 'Unlink']
                    // { name: 'links', items : [ 'Link','Unlink' ] }
                ]
            });

        });
    </script>
@endsection
