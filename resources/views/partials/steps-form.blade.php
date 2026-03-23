<div class="progress-top">
    @php
        if (request()->routeIs('buy.step6')) {
            $backRoute = route('buy.step5');
        } elseif (request()->routeIs('buy.step5')) {
            $backRoute = route('buy.step4');
        } elseif (request()->routeIs('buy.step4')) {
            $backRoute = route('buy.step3');
        } elseif (request()->routeIs('buy.step3')) {
            $backRoute = route('buy.step2');
        } elseif (request()->routeIs('buy.step2')) {
            $backRoute = route('buy.step1');
        } else {
            $backRoute = route('home'); // default
        }
    @endphp

    <a href="{{ $backRoute }}" class="back">
        <img src="/assets/images/Vector (14).png" class="back-arrow">
        Back
    </a>

    <div class="steps">

        <!-- Step 1 -->
        <a href="{{ route('buy.step1') }}"
            class="step 
            {{ request()->routeIs('buy.step1') ? 'active' : '' }} 
            {{ request()->routeIs('buy.step2', 'buy.step3', 'buy.step4', 'buy.step5', 'buy.step6') ? 'completed' : '' }}">
            @if(request()->routeIs('buy.step2', 'buy.step3', 'buy.step4', 'buy.step5', 'buy.step6'))
                ✓
            @else
                1
            @endif
        </a>

        <div class="line"></div>

        <!-- Step 2 -->
        <a href="{{ route('buy.step2') }}" class="step 
            {{ request()->routeIs('buy.step2') ? 'active' : '' }} 
            {{ request()->routeIs('buy.step3', 'buy.step4', 'buy.step5', 'buy.step6') ? 'completed' : '' }}">
            @if(request()->routeIs('buy.step3', 'buy.step4', 'buy.step5', 'buy.step6'))
                ✓
            @else
                2
            @endif
        </a>

        <div class="line"></div>

        <!-- Step 3 -->
        <a href="{{ route('buy.step3') }}" class="step 
            {{ request()->routeIs('buy.step3') ? 'active' : '' }} 
            {{ request()->routeIs('buy.step4', 'buy.step5', 'buy.step6') ? 'completed' : '' }}">
            @if(request()->routeIs('buy.step4', 'buy.step5', 'buy.step6'))
                ✓
            @else
                3
            @endif
        </a>

        <div class="line"></div>

        <!-- Step 4 -->
        <a href="{{ route('buy.step4') }}" class="step 
            {{ request()->routeIs('buy.step4') ? 'active' : '' }} 
            {{ request()->routeIs('buy.step5', 'buy.step6') ? 'completed' : '' }}">
            @if(request()->routeIs('buy.step5', 'buy.step6'))
                ✓
            @else
                4
            @endif
        </a>
        {{--
        <div class="line"></div>

        <!-- Step 5 -->
        <a href="{{ route('buy.step5') }}" class="step 
            {{ request()->routeIs('buy.step5') ? 'active' : '' }} 
            {{ request()->routeIs('buy.step6') ? 'completed' : '' }}">
            @if(request()->routeIs('buy.step6'))
            ✓
            @else
            5
            @endif
        </a>

        <div class="line"></div>

        <!-- Step 6 -->
        <a href="{{ route('buy.step6') }}" class="step 
            {{ request()->routeIs('buy.step6') ? 'active' : '' }}">
            6
        </a> --}}

    </div>

</div>