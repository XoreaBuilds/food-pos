@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-medium text-[#8a927f]">{{ now()->format('l, F j, Y') }}</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#294d38]">Good day, {{ auth()->user()->name }}.</h1>
                <p class="mt-2 text-sm text-[#737d70]">Here’s what’s happening at your restaurant today.</p>
            </div>
            <span
                class="inline-flex w-fit items-center gap-2 rounded-full border border-[#dce7d8] bg-[#eef5ec] px-3 py-1.5 text-xs font-semibold text-[#47734e]">
                <span class="h-2 w-2 rounded-full bg-[#6b9b69]"></span>
                Service is open
            </span>
        </div>

        <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Today's summary">
            @foreach ([['label' => 'Sales today', 'value' => '₱0.00', 'hint' => 'Today'], ['label' => 'Orders', 'value' => '0', 'hint' => 'Today'], ['label' => 'Average order', 'value' => '₱0.00', 'hint' => 'Today'], ['label' => 'Open orders', 'value' => '0', 'hint' => 'In progress']] as $stat)
                <article class="rounded-2xl border border-[#e9e4d7] bg-[#fffdf8] p-5 shadow-sm">
                    <p class="text-sm font-medium text-[#7a8375]">{{ $stat['label'] }}</p>
                    <p class="mt-4 text-3xl font-bold tracking-tight text-[#294d38]">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-xs text-[#9a9e91]">{{ $stat['hint'] }}</p>
                </article>
            @endforeach
        </section>

        <div class="mt-7 grid gap-6 lg:grid-cols-[minmax(0,1.6fr)_minmax(260px,0.8fr)]">
            <section class="overflow-hidden rounded-2xl border border-[#e9e4d7] bg-[#fffdf8] shadow-sm">
                <div class="flex items-center justify-between border-b border-[#eee9df] px-5 py-4 sm:px-6">
                    <div>
                        <h2 class="font-semibold text-[#294d38]">Recent orders</h2>
                        <p class="mt-1 text-xs text-[#8a927f]">Your latest restaurant activity</p>
                    </div>
                    <span class="rounded-full bg-[#f4f1e8] px-2.5 py-1 text-xs font-medium text-[#7a8375]">Today</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[540px] text-left text-sm">
                        <thead class="bg-[#faf8f2] text-xs uppercase tracking-wide text-[#929789]">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Order</th>
                                <th class="px-6 py-3 font-semibold">Time</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 text-right font-semibold">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center">
                                    <span
                                        class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-[#f4f1e8] text-[#71806e]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.7" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12l1 13H5L6 7Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 9V6a3 3 0 0 1 6 0v3" />
                                        </svg>
                                    </span>
                                    <p class="mt-3 text-sm font-medium text-[#536354]">No orders yet today</p>
                                    <p class="mt-1 text-xs text-[#969b8f]">Orders will show here as they come in.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <aside class="rounded-2xl border border-[#e9e4d7] bg-[#fffdf8] p-5 shadow-sm sm:p-6">
                <h2 class="font-semibold text-[#294d38]">Quick overview</h2>
                <p class="mt-1 text-xs text-[#8a927f]">A few things to get started</p>
                <div class="mt-5 space-y-3">
                    <a href="{{ route('profile') }}" wire:navigate
                        class="group flex items-center gap-3 rounded-xl border border-[#eee9df] p-3 transition hover:border-[#cddbc8] hover:bg-[#f8faf5]">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#eef5ec] text-[#47734e]">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                aria-hidden="true">
                                <circle cx="12" cy="8" r="4" />
                                <path stroke-linecap="round" d="M5 21a7 7 0 0 1 14 0" />
                            </svg>
                        </span>
                        <span class="min-w-0 flex-1"><span class="block text-sm font-medium text-[#455347]">Your
                                account</span><span
                                class="mt-0.5 block truncate text-xs text-[#929789]">{{ auth()->user()->email }}</span></span>
                        <span class="text-[#a4aa9c] transition group-hover:translate-x-0.5">→</span>
                    </a>
                    <div class="rounded-xl bg-[#f8f5ec] p-4">
                        <p class="text-sm font-medium text-[#536354]">Ready for service</p>
                        <p class="mt-1 text-xs leading-relaxed text-[#858d7f]">Your dashboard will fill up with sales and
                            order activity throughout the day.</p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection