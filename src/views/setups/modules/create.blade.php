<div class="page-header">

    <div class="row">

       <div class="col-sm-10 col-sm-offset-1">
           <div class="widget-box">
               <div class="widget-header">
                   <h5 style="font-weight: 600"><i class="fa fa-gear"></i> Manage Module </h5>
               </div>



               <div class="widget-body">
                   <div class="widget-main">
                       <form class="form-horizontal" action="{{ isset($module) ? route('modules.update', $module->id) : route('modules.store') }}" method="post">

                           @csrf


                           @if (isset($module))
                               @method('PUT')
                           @endif


                           @include('partials._alert_message')



                           <div class="row">

                               <div class="form-group">
                                   <label class="col-sm-3 control-label" for="form-field-1-1"> Module Name </label>
                                   <div class="col-xs-12 col-sm-8 @error('name') has-error @enderror">
                                       <input type="text" class="form-control" name="name"
                                           value="{{ isset($module) ? $module->name : old('name')  }}" placeholder="Module Name">

                                       @error('name')
                                           <span class="text-danger">{{ $message }}</span>
                                       @enderror
                                   </div>
                               </div>





                               <div class="form-group">
                                   <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label"></label>
                                   <div class="col-xs-12 col-sm-6">
                                       <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> {{ isset($module) ? 'Update' : 'Save'}}</button>
                                       <button class="btn btn-gray" type="Reset"> <i class="fa fa-refresh"></i> Reset </button>
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
