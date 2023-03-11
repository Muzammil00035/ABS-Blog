@extends('layouts.back')
@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="POST" action="/admin/profile/update/{{auth()->user()->id}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" name="name" id="name" class="form-control" value="{{auth()->user()->name}}" required>
                            </div>
                            {{-- Email Field --}}
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}" disabled required>
                            </div>
                            {{-- End --}}

                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" id="role" name="role" class="form-control" rows="4" value="{{auth()->user()->role}}" disabled  required />
                            </div>
                            <div class="form-group">
                                <label for="user_type">Type</label>
                                <select id="user_type" name="user_type" class="form-control custom-select">
                                    <option disabled>Select one</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type }}"
                                            {{ $type->type == auth()->user()->user_type ? 'selected' : '' }}>
                                            {{ $type->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="intro">Intro</label>
                                <textarea id="user_intro" name="user_intro" class="form-control" rows="4" required>{{auth()->user()->user_intro}}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
