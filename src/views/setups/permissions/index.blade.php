
@extends('sky-permission::layouts.master')


@section('title', 'Permission')


@section('css')

@stop


@section('content')

    <div class="widget-box">
        <div class="widget-header">
            <h4 class="widget-title">
                <i class="fa fa-info-circle"></i> Permission
            </h4>

            <span class="widget-toolbar">
                <a href="{{ route('permissions.create') }}" class="">
                    <i class="fa fa-plus"></i> Add New
                </a>
            </span>
        </div>



        <div class="widget-body">
            <div class="widget-main">




                @include('sky-permission::partials._alert_message')

                <div class="row">

                    <div class="col-md-12" style="margin-left:auto !important; margin-right:auto !important">
                        <div class="table-responsive" style="border: 1px #cdd9e8 solid;">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Module </th>
                                        <th width="15%">Submodule</th>
                                        <th>Permission Group</th>
                                        <th>Permission Name</th>
                                        <th>Slug</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($permissions as $permission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional(optional(optional($permission->permission_group)->submodule)->module)->name }}</td>
                                            <td>{{ optional(optional($permission->permission_group)->submodule)->name }}</td>
                                            <td>{{ optional($permission->permission_group)->name }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td class="text-center">
                                                <div class="btn-group btn-corner">
                                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-xs btn-xs btn-success" title="Edit">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                    <button type="button" onclick="delete_item(`{{ route('permissions.destroy', $permission->id) }}`)" class="btn btn-xs btn-sm btn-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="7" class="text-center">
                                                <strong class="text-danger" style="font-size: 18px">No records found!</strong>
                                            </th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>



    <script type="text/javascript">
        jQuery(function ($) {
            $('#dynamic-table').DataTable({
                "ordering": true,
                "bPaginate": true,
                "lengthChange": true,
                "info": true
            });
        })
    </script>
@stop
