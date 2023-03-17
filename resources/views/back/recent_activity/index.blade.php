@extends('layouts.back')

@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Recent Activity</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 15%">
                                User
                            </th>
                            <th style="width: 15%">
                                User Email
                            </th>
                            <th style="width: 15%">
                                Login Ip
                            </th>
                            <th style="width: 15%">
                                Country
                            </th>
                            <th style="width: 15%">
                                Login Time
                            </th>
                            <th style="width: 15%">
                                Logout Time
                            </th>
                            {{-- <th style="width: 39%">
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $list)
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        {{ $list->name }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $list->email }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $list->ip }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $list->country }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ Date($list->last_login) }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $list->last_logout }}
                                    </a>
                                </td>
                                {{-- <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form class="deletion-form" action="{{ route('categories.destroy', $category->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show-alert">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
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
        $('.show-alert').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.deletion-form').submit();
                }
            })
        })
    </script>
@endsection
