<div class="parent_pagination">
    @if ($lists->hasPages())
        <ul class="pagination">
            @if ($lists->onFirstPage())
                <li class="disabled "><span class="style">«</span></li>
            @else
                <li><a href="{{ $lists->previousPageUrl() }}" rel="prev"  class="style">«</a></li>
            @endif

            @if($lists->currentPage() > 3)
                <li class="hidden-xs"><a href="{{ $lists->url(1) }}"  class="style">1</a></li>
            @endif
            @if($lists->currentPage() > 4)
                <li><span>...</span></li>
            @endif
            @foreach(range(1, $lists->lastPage()) as $i)
                @if($i >= $lists->currentPage() - 2 && $i <= $lists->currentPage() + 2)
                    @if ($i == $lists->currentPage())
                        <li class="active"><span  class="style">{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $lists->url($i) }}"  class="style">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($lists->currentPage() < $lists->lastPage() - 3)
                <li><span>...</span></li>
            @endif
            @if($lists->currentPage() < $lists->lastPage() - 2)
                <li class="hidden-xs"><a href="{{ $lists->url($lists->lastPage()) }}"  class="style">{{ $lists->lastPage() }}</a></li>
            @endif
            @if ($lists->hasMorePages())
                <li><a href="{{ $lists->nextPageUrl() }}" rel="next"  class="style">»</a></li>
            @else
                <li class="disabled"><span  class="style">»</span></li>
            @endif
        </ul>
    @endif
</div>
