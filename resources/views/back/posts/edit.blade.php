@extends('layouts.back')
@if (session()->has('updatePostSuccess'))
    @section('alerts')
        <div class="alert alert-success alert-dismissible fade show light-green" role="alert">
            {!! session('updatePostSuccess') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endsection
@endif
@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Posts Edit</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role != 'user')
                                <div class="form-check">
                                    <input type="checkbox" name="featured" class="form-check-input" id="exampleCheck1"  {{$post->featured == 1 ? 'checked' :''}}>
                                    <label class="form-check-label" name="featured" for="exampleCheck1">Featured
                                        Post</label>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $post->title }}">
                            </div>

                            {{-- Slug Field --}}
                            <div class="form-group">
                                <label for="slug">Slug </label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="{{ str_replace('-', ' ', $post->slug) }}" required>
                            </div>
                            {{-- End --}}

                            {{-- Meta title and Meta Description Fields --}}
                            <div class="form-group">
                                <label for="meta-title">Meta Title </label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control"
                                    value="{{ $post->meta_title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="meta-description">Meta Description </label>
                                <input type="text" name="meta_description" id="meta_description" class="form-control"
                                    value="{{ $post->meta_description }}" required>
                            </div>
                            {{-- End --}}

                            <div class="form-group">
                                <label for="resume">Post Excerpt</label>
                                <textarea id="resume" name="excerpt" class="form-control" rows="3">{{ $post->excerpt }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="body">Post Description</label>
                                <textarea id="description_body" name="body" class="form-control" rows="5">{{ $post->body }}</textarea>
                            </div>
                            <div class="image-preview">
                                <img src="{{ asset('images/' . $post->image) }}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="image">New Image</label>
                                <input type="file" name="image" class="form-control-file" id="image">
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
                                    <option disabled>Select one</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $post->categories->first()->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" id="tags" name="tags" class="form-control"
                                    placeholder="tag 1, tag 2 ...">
                            </div> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    {{-- Modal Show for interlinking --}}

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Interlink</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input type="checkbox" name="interlink" class="form-check-input" id="exampleCheck2"
                                    {{ $post->interlink == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" name="interlink" for="exampleCheck2">InterLink</label>
                            </div>
                            <div class="form-group">
                                <label for="category">URL</label>
                                <input type="url" name="post_url" id="post_url" class="form-control"
                                    value="{{ $post->url }}">
                            </div>

                            <div class="image-preview">
                                @if ($post->interlink_image)
                                    <img src="{{ asset('images/' . $post->interlink_image) }}" alt="">
                                @else
                                    <p>No Image</p>
                                @endif
                            </div>


                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="interlink_image" class="form-control-file"
                                    id="interlink_image">
                            </div>
                            <div class="form-group">
                                <label for="category">Time in seconds</label>
                                <input type="number" name="seconds" id="seconds" class="form-control"
                                    value="{{ $post->time_in_second }}">
                            </div>
                            <div class="form-group">
                                <label for="btn_text">Button Text</label>
                                <input type="text" name="btn_text" id="btn_text" class="form-control" value="{{ $post->btn_text }}">
                            </div>
                        </div>
                    </div>

                    <!-- /.interlinking -->
                </div>
            </div>

            {{-- Multiple Data part --}}

            <div class="row">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Additional Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-2">
                                <span class="customAddition px-2">+</span>
                            </div>
                            <div class="data_container">
                                @for ($i = 0; $i < count($post->headers); $i++)
                                    <div id="datadev_{{ $i }}" class="element border p-3 mb-3">
                                        <div class="d-flex justify-content-end">
                                            <span class="customRemove px-2" id='remove_{{ $i }}'>-</span>
                                        </div>
                                        <div class="row">
                                            <input type="hidden" name="data_head[{{ $i }}][id]"
                                                id="data_head_id" class="form-control"
                                                value="{{ $post->headers[$i]->id }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Heading</label>
                                                    <input type="text" name="data_head[{{ $i }}][heading]"
                                                        id="data_head_heading" class="form-control"
                                                        value="{{ $post->headers[$i]->heading }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Description </label>
                                                    <input type="text"
                                                        name="data_head[{{ $i }}][description]"
                                                        id="data_head_description" class="form-control"
                                                        value="{{ $post->headers[$i]->description }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="image-preview">
                                                    <img src="{{ asset('images/' . $post->headers[$i]->image) }}"
                                                        alt="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Image</label>
                                                    <input type="file"
                                                        name="data_head[{{ $i }}][head_image]"
                                                        id="data_head_image" class="form-control-file">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endfor
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            {{-- End --}}



            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
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
        $(document).ready(function() {
            // CKEDITOR.replace('body');

            CKEDITOR.replace('description_body', {
                toolbar: [
                    ['Bold', 'Italic', 'Link', 'Unlink', 'Image', 'Flash', 'Table', 'Undo', 'Redo',
                        'Cut', 'Copy', 'Paste', 'NumberedList', 'BulletedList',
                    ]
                    // ['Link', 'Unlink']
                    // { name: 'links', items : [ 'Link','Unlink' ] }
                ]
            });

            $(".customAddition").click(() => {
                var total_element = $(".element").length;
                if (total_element > 0) {
                    var lastid = $(".element:last").attr("id");
                    var split_id = lastid.split("_");
                    var nextindex = Number(split_id[1]) + 1;
                    var max = 5;
                    // Check total number elements
                    if (total_element < max) {
                        // Adding new div container after last occurance of element class
                        $(".element:last").after(
                            `<div id="datadev_${nextindex}" class="element border p-3 mb-3"></div>`);

                        // Adding element to <div>
                        $("#datadev_" + nextindex).append(`
                                    <div class="d-flex justify-content-end">
                                        <span class="customRemove px-2" id='remove_${nextindex}'>-</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data_head_heading">Heading  </label>
                                                <input type="text" name="data_head[${nextindex}][heading]" id="data_head_heading" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data_head_description">Description </label>
                                                <input type="text" name="data_head[${nextindex}][description]" id="data_head_description" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="data_head_image">Image</label>
                                                <input type="file" name="data_head[${nextindex}][head_image]" id="data_head_image"
                                                    class="form-control-file" required>
                                            </div>
                                        </div>

                                    </div>
                        `);

                        // last <div> with element class id

                    }
                } else {
                    // Adding element to <div>
                    $(".data_container").append(`
                                <div id="datadev_0" class="element border p-3 mb-3">
                                    <div class="d-flex justify-content-end">
                                        <span class="customRemove px-2" id='remove_0'>-</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data_head_heading">Heading  </label>
                                                <input type="text" name="data_head[0][heading]" id="data_head_heading" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="data_head_description">Description </label>
                                                <input type="text" name="data_head[0][description]" id="data_head_description" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="data_head_image">Image</label>
                                                <input type="file" name="data_head[0][head_image]" id="data_head_image"
                                                    class="form-control-file" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        `);
                }
            });

            $('.data_container').on('click', '.customRemove', function() {
                var id = this.id;
                var split_id = id.split("_");
                var deleteindex = split_id[1];

                console.log({
                    deleteindex
                });

                // // Remove <div> with id
                $("#datadev_" + deleteindex).remove();

            });
        });
    </script>
@endsection
