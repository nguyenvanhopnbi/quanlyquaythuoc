<div class="pagination-apay-partner">
@if ($pagination['pages'] > 1)
    @if ($pagination['page'] > 1 && $pagination['pages'] > 1)
        <a class="btn-step-page" href="{{$currentUrl}}?page={{$pagination['page'] - 1}}&{{http_build_query($params['query'])}}" >
            <span class="icon-arrow"><img src="css/icon/prev-page.svg" alt=""></span> <span class="text">
                Previous
            </span>
        </a>
    @endif
    @if(($pagination['page'] - 1) > 1)
        <a href="{{$currentUrl}}?page=1&{{http_build_query($params['query'])}}" class='page-a-link'>1</a>
        <span class='page-before-after'>...</span>
    @endif
    @for ($i = ($pagination['page'] - 1); $i <= ($pagination['page'] + 5); $i ++)
        @if($i < 1)
            @continue
        @endif
        @if ($i > $pagination['pages'])
            @break
        @endif
        @if($i == $pagination['page'])
            @php $class = "page-a-link active"; @endphp
        @else
            @php $class = "page-a-link"; @endphp
        @endif
        <a href="{{$currentUrl}}?page={{$i}}&{{http_build_query($params['query'])}}" class='{{$class}}'>{{$i}}</a>
    @endfor
    @if (($pagination['pages'] - ($pagination['page'] + 1)) > 0 && $pagination['pages'] > 6)
        <span class='page-before-after'>...</span>
    @endif
    @if (($pagination['pages'] - ($pagination['page'] + 1)) > 0 && $pagination['pages'] > 6)
        @if ($pagination['pages'] == $pagination['page'])
            @php $class = "page-a-link active"; @endphp
        @else
            @php $class = "page-a-link"; @endphp
        @endif
        <a href="{{$currentUrl}}?page={{$pagination['pages']}}&{{http_build_query($params['query'])}}" class="{{$class}}">{{$pagination['pages']}}</a>
    @endif
    @if (($pagination['page'] > 1) && ($pagination['page'] < $pagination['pages']))
        <a class="next btn-step-page" id="next-page" href="{{$currentUrl}}?page={{$pagination['page'] + 1}}&{{http_build_query($params['query'])}}">
            <span class="text">Next</span><span
                class="icon-arrow"><img src="css/icon/next-page.svg" alt="">
            </span>
        </a>
    @endif
@endif
</div>
