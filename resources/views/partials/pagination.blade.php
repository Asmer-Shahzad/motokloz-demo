@if(isset($last_page) && $last_page > 1)
    @php
        $queryParams = request()->except('page');
        // Ensure GPS coords are preserved in pagination links
        if (empty($queryParams['user_lat']) && isset($user_lat) && $user_lat) {
            $queryParams['user_lat'] = $user_lat;
        }
        if (empty($queryParams['user_lng']) && isset($user_lng) && $user_lng) {
            $queryParams['user_lng'] = $user_lng;
        }
        $half = 1; // show one page on each side of current
        $start = max(1, $current_page - $half);
        $end = min($last_page, $current_page + $half);
        // Adjust to always show up to 3 pages
        if ($end - $start + 1 < 5) {
            if ($start == 1) {
                $end = min($last_page, $start + 5);
            } elseif ($end == $last_page) {
                $start = max(1, $end - 5);
            }
        }
    @endphp
    <ul class="pagination justify-content-start align-items-center gap-2">
        <!-- Prev -->
        <li class="page-item {{ $current_page == 1 ? 'disabled' : '' }}">
            <a class="page-link page-square" href="{{ url()->current() }}?{{ http_build_query(array_merge($queryParams, ['page' => $current_page - 1])) }}">
                <img src="/assets/images/Vector (5).png" alt="Prev" style="width:20px; height:20px; object-fit: scale-down;">
            </a>
        </li>

        <!-- First page if not in range -->
        @if($start > 1)
            <li class="page-item">
                <a class="page-link page-square" href="{{ url()->current() }}?{{ http_build_query(array_merge($queryParams, ['page' => 1])) }}">1</a>
            </li>
            @if($start > 2)
                <li class="page-item disabled"><span class="page-link page-square">...</span></li>
            @endif
        @endif

        <!-- Pages in range -->
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ $current_page == $i ? 'active' : '' }}">
                <a class="page-link page-square" href="{{ url()->current() }}?{{ http_build_query(array_merge($queryParams, ['page' => $i])) }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

        <!-- Last page if not in range -->
        @if($end < $last_page)
            @if($end < $last_page - 1)
                <li class="page-item disabled"><span class="page-link page-square">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link page-square" href="{{ url()->current() }}?{{ http_build_query(array_merge($queryParams, ['page' => $last_page])) }}">{{ $last_page }}</a>
            </li>
        @endif

        <!-- Next -->
        <li class="page-item {{ $current_page == $last_page ? 'disabled' : '' }}">
            <a class="page-link page-square" href="{{ url()->current() }}?{{ http_build_query(array_merge($queryParams, ['page' => $current_page + 1])) }}">
                <img src="/assets/images/Vector (6).png" alt="Next" style="width:20px; height:20px; object-fit: scale-down;">
            </a>
        </li>
    </ul>
@endif