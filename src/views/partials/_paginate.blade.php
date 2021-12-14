{{--@if ($data->appends(request()->query())->count() > 0)--}}
    <span class="pull-right">
        <ul class="pagination">
        <li class=" @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
            <a class="" href="{{ $data->appends(request()->query())->url(1) }}">← First</a>
        </li>

            <li class=" @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
            <a class="" href="{{ $data->appends(request()->query())->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a>
        </li>
            @foreach(range(1, $data->appends(request()->query())->lastPage()) as $i)
                @if($i >= $data->appends(request()->query())->currentPage() - 4 && $i <= $data->appends(request()->query())->currentPage() + 4)
                    @if ($i == $data->appends(request()->query())->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $data->appends(request()->query())->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach

            <li class=" @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
            <a class="" href="{{ $data->appends(request()->query())->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a>
        </li>
          <li class=" @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
                <a class="" href="{{ $data->appends(request()->query())->url($data->lastPage()) }}">Last →</a>
            </li>
    </ul>

    </span>
{{--@endif--}}



