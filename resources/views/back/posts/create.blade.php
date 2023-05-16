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
                            @if (auth()->user()->role != 'user')
                                <div class="form-check">
                                    <input type="checkbox" name="featured" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" name="featured" for="exampleCheck1">Featured
                                        Post</label>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="title">Post Title </label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            {{-- Slug Field --}}
                            <div class="form-group">
                                <label for="slug">Slug </label>
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>
                            {{-- End --}}

                            {{-- Meta title and Meta Description Fields --}}
                            <div class="form-group">
                                <label for="meta-title">Meta Title </label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="meta-description">Meta Description </label>
                                <input type="text" name="meta_description" id="meta_description" class="form-control"
                                    required>
                            </div>
                            {{-- End --}}
                            <div class="form-group">
                                <label for="excerpt">Post Excerpt</label>
                                <textarea id="excerpt" name="excerpt" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Post Description</label>
                                <textarea id="description_body" name="body" class=" form-control" rows="4" required></textarea>
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
                                <input type="file" name="interlink_image" class="form-control-file"
                                    id="interlink_image">
                            </div>
                            <div class="form-group">
                                <label for="category">Time in seconds</label>
                                <input type="number" name="seconds" id="seconds" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="btn_text">Button Text</label>
                                <input type="text" name="btn_text" id="btn_text" class="form-control">
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
                                {{-- <div id="datadev_0" class="element border p-3 mb-3">
                                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Heading</label>
                                                <input type="text" name="data_head[0][heading]" id="data_head_heading"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Description </label>
                                                <input type="text" name="data_head[0][description]"
                                                    id="data_head_description" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Image</label>
                                                <input type="file" name="data_head[0][image]" id="data_head_image"
                                                    class="form-control-file">
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
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
    {{-- <script src="https://cdn.tiny.cloud/1/q3mul8cwqgdcv0ucctmtrqboclpn360rji5w9mlabrda3mpt/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script> --}}


    <script type="text/javascript">
        $(document).ready(function() {

            // tinymce.init({
            //     selector: 'textarea#myeditorinstance',
            //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            //     tinycomments_mode: 'embedded',
            //     tinycomments_author: 'Author name',
            //     mergetags_list: [{
            //             value: 'First.Name',
            //             title: 'First Name'
            //         },
            //         {
            //             value: 'Email',
            //             title: 'Email'
            //         },
            //     ]
            // });

            // CKEDITOR.editorConfig = function(config) {
            //     config.language = 'en';
            //     config.toolbar = [{
            //         name: 'clipboard',
            //         items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            //     }, ];
            //     config.disableNativeSpellChecker = false;
            // }
            // $(document).ready(function() {
            // console.log(CKEDITOR.editorConfig);

            // $('.ckeditor').ckeditor();
            CKEDITOR.replace('description_body', {
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
        

        // CKEDITOR.replace('body');

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



        // var max = 5;
        // // Check total number elements
        // if (total_element < max) {
        //     // Adding new div container after last occurance of element class
        //     $(".element:last").after("<div class='element' id='div_" + nextindex + "'></div>");

        //     // Adding element to <div>
        //     $("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_" + nextindex +
        //         "'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");

        // }


        $('.data_container').on('click', '.customRemove', function() {
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // // Remove <div> with id
        $("#datadev_" + deleteindex).remove();

        });
        });
    </script>
@endsection
