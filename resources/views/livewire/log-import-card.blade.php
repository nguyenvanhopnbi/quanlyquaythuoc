<div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link"
                @if((int)$page <= 1)
                disabled="disabled"
                @endif href="/shopcard-card-auto-import-logs-card?page={{$page - 1}}{{$link}}">Previous</a>
                </li>
                @for($i = $startPage; $i <= $endPage; $i++)
                <li @if($page == $i) class="page-item active" @else class="page-item" @endif><a class="page-link" href="/shopcard-card-auto-import-logs-card?page={{$i}}{{$link}}">{{$i}}</a></li>
                @endfor
                <li class="page-item"><a class="page-link" href="/shopcard-card-auto-import-logs-card?page={{$page + 1}}{{$link}}"
                @if($pageMax == $page)
                disabled="disabled"
                @endif>Next</a>
                </li>
                <li class="page-item">

                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownPagination" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$pageSize}}
                  </button><span> Showing 1 - {{$pageSize}} of {{$total}} </span>
                  <div class="dropdown-menu" aria-labelledby="dropdownPagination">
                    <a class="dropdown-item" href="/shopcard-card-auto-import-logs-card?page={{$page}}&limit=10">10</a>
                    <a class="dropdown-item" href="/shopcard-card-auto-import-logs-card?page={{$page}}&limit=20">20</a>
                    <a class="dropdown-item" href="/shopcard-card-auto-import-logs-card?page={{$page}}&limit=30">30</a>
                    <a class="dropdown-item" href="/shopcard-card-auto-import-logs-card?page={{$page}}&limit=50">50</a>
                    <a class="dropdown-item" href="/shopcard-card-auto-import-logs-card?page={{$page}}&limit=100">100</a>
                  </div>
                </div>

                </li>
            </ul>
        </nav>

</div>
