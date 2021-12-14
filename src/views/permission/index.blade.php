@extends('layouts.master')
@section('title','User Permission')
@section('page-header')
    <i class="fa fa-list"></i> User Permissions
@stop
@section('css')

@stop


@section('content')

    <div class="page-header">

        <a class="btn btn-xs btn-info" href="{{ route('permissions.create') }}" style="float: right; margin: 0 2px;"> <i class="fa fa-plus"></i> Create Permission </a>

        <h1>
            @yield('page-header')
        </h1>
    </div>

    @include('partials._alert_message')

    <div class="row">
        @include('partials._paginate', ['data' => $permissions])
        <div class="col-md-12" style="margin-left:auto !important; margin-right:auto !important">
            <div class="table-responsive" style="border: 1px #cdd9e8 solid;">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Module </th>
                            <th width="15%">Submodule</th>
                            <th>Parent Permission</th>
                            <th>Permission Name</th>
                            <th>Slug</th>
                            <th width="8%"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($permissions as $key => $permission)
                            <tr>
                                <td>{{ $key+$permissions->firstItem() }}</td>
                                <td>{{ $permission->parent_permission->submodule->module->name }}</td>
                                <td>{{ $permission->parent_permission->submodule->name }}</td>
                                <td>{{ $permission->parent_permission->name }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->slug }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-corner">
                                        <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-xs btn-sm btn-success" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button type="button" onclick="delete_check({{ $permission->id }})" class="btn btn-xs btn-sm btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>

                                    <form action="{{ route('permissions.destroy',$permission->id)}}" id="deleteCheck_{{ $permission->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>


@endsection

@section('js')

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>

    

    <!-- inline scripts related to this page -->
    <script type="text/javascript">

        function delete_check(id)
        {
            Swal.fire({
                title: 'Are you sure ?',
                html: "<b>You want to delete permanently !</b>",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                width:400,
            }).then((result) =>{
                if(result.value){
                    $('#deleteCheck_'+id).submit();
                }
            })

        }

    </script>


    <script type="text/javascript">
        jQuery(function($) {
            $('#dynamic-table').DataTable({
                "ordering": false,
                "bPaginate": true,
                "lengthChange": false,
                "info": false,
                "pageLength": 25
            });
        })
    </script>
@stop
