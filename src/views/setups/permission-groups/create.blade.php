<div class="page-header">

    <div class="row">

       <div class="col-sm-10 col-sm-offset-1">
           <div class="widget-box">
               <div class="widget-header">
                   <h5 style="font-weight: 600"><i class="fa fa-gear"></i> Manage Permission Group </h5>
               </div>



               <div class="widget-body">
                   <div class="widget-main">
                       <form class="form-horizontal" action="{{ isset($permissionGroup) ? route('permission-groups.update', $permissionGroup->id) : route('permission-groups.store') }}" method="post">
                        @csrf
                           @if (isset($permissionGroup))
                               @method('PUT')
                           @endif
                           @include('partials._alert_message')



                           <div class="row">

                               <div class="form-group col-sm-12">
                                   <label class="col-sm-3 control-label" for="form-field-1-1"> Submodule </label>
                                   <div class="col-xs-12 col-sm-8 @error('submodule_id') has-error @enderror">
                                       <select name="submodule_id" id="form-field-select-3" data-placeholder="Select" class="form-control chosen-select">
                                           <option value=""> - Select - </option>
                                           @if (isset($permissionGroup))
                                               @foreach($submodules as $id => $submodule)
                                                   <option value="{{ $id }}" {{ $id == $permissionGroup->submodule_id ? 'selected' : '' }}>{{ $submodule }}</option>
                                               @endforeach
                                           @else
                                               @foreach($submodules as $id => $submodule)
                                                   <option value="{{ $id }}" {{ $id == old('submodule_id') ? 'selected' : '' }}>{{ $submodule }}</option>
                                               @endforeach
                                           @endif

                                       </select>

                                       @error('submodule_id')
                                       <span class="text-danger">
                                               {{ $message }}
                                           </span>
                                       @enderror
                                   </div>
                               </div>

                               <div class="form-group">
                                   <label class="col-sm-3 control-label" for="form-field-1-1"> Group Name </label>
                                   <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                       <input type="text" class="form-control" name="name"
                                           value="{{ isset($permissionGroup) ? $permissionGroup->name : old('name')  }}" placeholder="Permission Group Name">

                                       @error('name')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>





                               <div class="form-group">
                                   <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                   <div class="col-xs-12 col-sm-6">
                                       <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> {{ isset($permissionGroup) ? 'Update' : 'Save'}}</button>
                                       <button class="btn btn-gray btn-sm" type="Reset"> <i class="fa fa-refresh"></i> Reset </button>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
        </div>
   </div>
</div>
