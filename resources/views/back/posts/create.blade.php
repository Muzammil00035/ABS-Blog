@extends('layouts.back')
@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Post Add</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            @if(auth()->user()->role != "user")
                            <div class="form-check">
                                <input type="checkbox" name="featured" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" name="featured" for="exampleCheck1">Featured Post</label>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="title">Post Title </label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Post Excerpt</label>
                                <textarea id="excerpt" name="excerpt" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Post Description</label>
                                <textarea id="ckeditor" name="body" class="ckeditor form-control" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Post Image</label>
                                <input type="file" name="image" class="form-control-file" id="image" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Extra</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    {{-- Modal Show for interlinking --}}

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Interlink</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input type="checkbox" name="interlink" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label" name="interlink" for="exampleCheck2">InterLink</label>
                            </div>
                            <div class="form-group">
                                <label for="category">URL</label>
                                <input type="url" name="post_url" id="post_url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="interlink_image" class="form-control-file" id="interlink_image">
                            </div>
                            <div class="form-group">
                                <label for="category">Time in seconds</label>
                                <input type="number" name="seconds" id="seconds" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- /.interlinking -->

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
    {{-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

    <script type="text/javascript">
        // CKEDITOR.editorConfig = function(config) {
        //     config.language = 'en';
        //     config.toolbar = "mini";
        //     config.removePlugins = 'contextmenu,liststyle,tabletools,tableselection';
        //     config.disableNativeSpellChecker = false;
        // }
        // $(document).ready(function() {
        // console.log(CKEDITOR.editorConfig);

        // $('.ckeditor').ckeditor();
        CKEDITOR.replace('body', {
            toolbar: [
                // ['Bold', 'Italic',  'Link', 'Unlink']
                ['Link', 'Unlink']

            ]
        });
        // });
    </script>
@endsection
