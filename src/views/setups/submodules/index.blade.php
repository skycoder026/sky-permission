@extends('sky-permission::layouts.master')


@section('title',' Manage Submodule')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@stop


@section('content')

    @include('sky-permission::setups.submodules.create')


    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

            <div style="border: 1px #cdd9e8 solid;">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Module</th>
                            <th>Submodule Name</th>
                            <th>Slug</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                         @foreach ($submodules as $key => $submodule)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ optional($submodule->module)->name }}</td>
                                <td>{{ $submodule->name }}</td>
                                <td>{{ $submodule->slug }}</td>

                                <td class="text-center">
                                    <div class="btn-group btn-corner">
                                        <a href="{{ route('submodules.edit', $submodule->id) }}" class="btn btn-xs btn-success" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button type="button" onclick="delete_item(`{{ route('submodules.destroy', $submodule->id) }}`)" class="btn btn-xs btn-danger" title="Delete">
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
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>





    <!--  Select Box Search-->
    <script type="text/javascript">

        jQuery(function ($) {
            $('#dynamic-table').DataTable({
                "ordering": false,
                "bPaginate": false,
                "bPaginate": false,
                "lengthChange": false,
                "info": false
            });
        })
    </script>


@stop
