<div class="page-header">

    <div class="row">

       <div class="col-sm-10 col-sm-offset-1">
           <div class="widget-box">
               <div class="widget-header">
                   <h5 style="font-weight: 600"><i class="fa fa-gear"></i> Manage Submodule </h5>
               </div>



               <div class="widget-body">
                   <div class="widget-main">
                       <form class="form-horizontal" action="{{ isset($submodule) ? route('submodules.update', $submodule->id) : route('submodules.store') }}" method="post">

                           @csrf

                           @if (isset($submodule))
                               @method('PUT')
                           @endif


                           @include('sky-permission::partials._alert_message')



                           <div class="row">

                               <div class="form-group col-sm-12">
                                   <label class="col-sm-3 control-label" for="form-field-1-1"> Module </label>
                                   <div class="col-xs-12 col-sm-8 @error('module_id') has-error @enderror">
                                       <select name="module_id" data-placeholder="Select" required class="form-control required chosen-select-100-percent">
                                           @if (isset($submodule))
                                               @foreach($modules as $id => $module)
                                                   <option value="{{ $id }}" {{ $id == $submodule->module_id ? 'selected' : '' }}>{{ $module }}</option>
                                               @endforeach
                                           @else
                                               <option value="">Select</option>
                                               @foreach($modules as $id => $module)
                                                   <option value="{{ $id }}" {{ $id == old('module_id') ? 'selected' : '' }}>{{ $module }}</option>
                                               @endforeach
                                           @endif
                                       </select>

                                       @error('module_id')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>

                               <div class="form-group">
                                   <label class="col-sm-3 control-label" for="form-field-1-1"> Sub Module Name </label>
                                   <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                       <input type="text" class="form-control" required name="name"
                                           value="{{ isset($submodule) ? $submodule->name : old('name')  }}" placeholder="Submodule Name">

                                       @error('name')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>





                               <div class="form-group">
                                   <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                   <div class="col-xs-12 col-sm-6">
                                       <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> {{ isset($submodule) ? 'Update' : 'Save'}}</button>
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
