@props([
    'stats' => [],
])

@if($stats)
    <div class="stats stats-vertical md:stats-horizontal shadow w-full">
        @foreach($stats as $stat)
            <x-stats.item :title="$stat['title'] ?? ''" :value="$stat['value'] ?? ''" :description="$stat['description'] ?? ''"/>
        @endforeach
    </div>
@endif
