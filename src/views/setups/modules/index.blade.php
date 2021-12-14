@extends('sky-permission::layouts.master')


@section('title',' Manage Module')



@section('content')


    @include('sky-permission::setups.modules.create')





    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

            <div style="border: 1px #cdd9e8 solid;">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Module Name</th>
                            <th class="text-center">Rank</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Migration Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                         @foreach ($modules as $key => $module)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $module->name }}</td>
                                <td class="text-center">{{ $module->rank }}</td>
                                <td class="text-center">
                                    <a href="{{ route('active.deactive.module', $module->id) }}" class="badge badge-{{ $module->status == 1 ? 'success' : 'danger' }}">
                                        {{ $module->status == 1 ? 'Active' : 'De-Active' }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="label label-{{ $module->is_migrate ? 'primary' : 'warning' }} arrowed-in arrowed-in-right">{{ $module->is_migrate ? 'Migrated' : 'Pending' }}</span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group btn-corner">
                                        <a href="{{ route('modules.edit',$module->id) }}" class="btn btn-sm btn-success" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button type="button" onclick="delete_item(`{{ route('modules.destroy', $module->id) }}`)" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
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



    <script type="text/javascript">
        jQuery(function ($) {
            $('#dynamic-table').DataTable({
                "ordering": false,
                "bPaginate": false,
                "lengthChange": false,
                "info": false
            });
        })
    </script>
@stop
