
@if ($errors->any())
    <div class="alert alert-danger error">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (session()->get('message'))
    <div class="alert alert-success success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <strong>
            <i class="ace-icon fa fa-check-circle"></i>
            Success !
        </strong>
        {{ session()->get('message') }}
    </div>
@endif

@if (session()->get('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <strong>
        <i class="ace-icon fa fa-times"></i>
        Error !
    </strong>
    {{ session()->get('error') }}
</div>
@endif

