@php
    use Illuminate\Support\Facades\Request;
@endphp
<ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="/"><i class="fa fa-home fa-lg"></i></a></li>
    @php
        $link = "";
    @endphp
    @for($i=1;$i<count(Request::segments());$i++)
        @if($i<count(Request::segments()) && $i>0)

            <li class="breadcrumb-item">
                <a href="{{ $link .="/".Request::segment($i) }}">
                    {{ ucwords(Request::segment($i)) }}
                </a>
            </li>
        @else {{ucwords(Request::segment($i))}}
        @endif

    @endfor
</ul>
