<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-xl-4 col-sm-12 box-col-3">
                @php($title = '')
                @foreach(request()->segments() as $key => $segment)
                    @php($title .= $segment . (str_replace('_', ' ', $loop->last) ? '' : ' | '))
                @endforeach
                <h3>{{ str_replace('_', ' ', $title) }}</h3>
            </div>

            <div class="col-xl-8 col-sm-12 box-col-9">
                <ol class="breadcrumb">
                    @php($url = '')
                    @foreach(request()->segments() as $key => $segment)
                        @php($url .= '/'.$segment)
                        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                            @if($loop->iteration == 1)
                                <a href="/admin">
                                    <svg class="stroke-icon">
                                        <use href="/assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg>
                                </a>
                            @else
{{--                                @php($segment = str_replace('_', ' ', $segment))--}}
                                {!! $loop->last ? $segment : '<a href="'.$url.'">'.$segment.'</a>'  !!}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
