@extends('layouts.back')

@section('breadcrumb')
    <div class="col-sm-6">
        {{-- <h1 class="m-0">Dashboard</h1> --}}
        <a class="btn btn-success" href="{{ route('web-socials.create') }}">
            Create Web Socials
        </a>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Web Socials</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Web Socials</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 10%">
                                #
                            </th>
                            <th style="width: 20%">
                                Social Name
                            </th>
                            <th style="width: 20%">
                                Social Link
                            </th>
                            <th style="width: 20%">
                                Social Image
                            </th>
                            <th style="width: 30%">

                            </th>


                            {{-- <th style="width: 39%">
                            </th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($list) > 0)
                            @foreach ($list as $list)
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <a>
                                            {{ $list->social_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $list->social_link }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            <img src="{{ asset('images/' . $list->social_icon) }}" alt=""
                                                width="50" height="50" srcset="">
                                        </a>
                                    </td>
                                    <td class="project-actions text-right">

                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('web-socials.updatepageShow', $list->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <form id="delete-post{{ $list->id }}" class="deletion-form"
                                            action="{{ route('web-socials.delete') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $list->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm show-alert"
                                                data-id="{{ $list->id }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No List Found</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
@section('javascript')
    <script>
        // show alert before deleting post
    </script>
@endsection
