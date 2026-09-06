@php
	$days = [
		['MON', '1', []],
		['TUE', '2', [['facebook', '9:00 AM', 'Studio shoot BTS']]],
		['WED', '3', []],
		['THU', '4', [['youtube', '11:30 AM', 'Product teaser']]],
		['FRI', '5', [['facebook', '2:00 PM', 'Behind the scenes'], ['tiktok', '6:30 PM', 'New arrivals reel']]],
		['SAT', '6', [['youtube', '10:00 AM', 'Testimonial reel']]],
		['SUN', '7', []],
	];
@endphp
<section class="page-section" id="page-schedule"><div class="section-row"><div><h2>This week</h2><p>September 1 – 7, 2026</p></div><button class="btn"><svg width="14" height="14" aria-hidden="true"><use href="#ico-calendar"/></svg> Jump to today</button></div><div class="week-strip">@foreach ($days as [$name, $number, $events])<div class="day-col {{ $number === '5' ? 'today' : '' }}"><div class="day-head-wrap"><div class="day-head">{{ $name }}</div><div class="day-num">{{ $number }}</div></div>@forelse($events as [$platform, $time, $title])<button class="sched-post sched-{{ $platform }}" data-action="review"><svg width="14" height="14"><use href="#ico-{{ $platform }}"/></svg><span><span class="t">{{ $time }}</span><span class="n">{{ $title }}</span></span></button>@empty<div class="day-empty"><button class="day-add-btn" data-action="upload">＋</button></div>@endforelse</div>@endforeach</div>@include('partials.queue-list', ['limit' => 3])</section>