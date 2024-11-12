<x-app-layout>
    <x-slot name="header">
        {{ __('Stocks and Commodities') }}
    </x-slot>


    <div class="">
        <div class="flex flex-wrap justify-center">
            @if ($stocks->isEmpty())
                <h2 class="text-red-700">There is currently no stock available for you to buy</h2>
            @else
                @foreach ($stocks as $stock)
                    <div class="p-4">
                        <div class="flex flex-col justify-center p-4 max-w-md bg-white rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"
                            style="width: 300px; border: 2px solid rgb(203, 68, 236);">
                            <div class="relative mb-4 md:block mx-auto">
                                <img style="width: 80px; height: 80px; border-radius: 50%;" src="{{ asset($stock->img) }}"
                                    alt="" />
                            </div>
                            <div class="flow-root">
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                    Stock
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $stock->name }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                    Market Capital
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $stock->market_capital }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                    Price per unit
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $stock->price }}/{{ $stock->unit }}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                    Daily change
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $stock->daily_change }}%
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                    Weekly change
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                                {{ $stock->weekly_change }}%
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="mx-auto">
                                <a href="{{ route('user.trade', $stock->id) }}"
                                    class="flex uppercase items-center justify-between px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    <svg class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 512 512" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        fill="#ffffff" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>barchart</title>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <g id="add" fill="#ffffff"
                                                    transform="translate(42.666667, 85.333333)">
                                                    <path
                                                        d="M21.3333333,1.42108547e-14 L85.3333333,1.42108547e-14 L85.3333333,277.333333 L21.3333333,277.333333 L21.3333333,1.42108547e-14 Z M128,128 L192,128 L192,277.333333 L128,277.333333 L128,128 Z M341.333333,85.3333333 L405.333333,85.3333333 L405.333333,277.333333 L341.333333,277.333333 L341.333333,85.3333333 Z M234.666667,42.6666667 L298.666667,42.6666667 L298.666667,277.333333 L234.666667,277.333333 L234.666667,42.6666667 Z M3.55271368e-14,298.666667 L426.666667,298.666667 L426.666667,341.333333 L3.55271368e-14,341.333333 L3.55271368e-14,298.666667 Z"
                                                        id="Combined-Shape"> </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span>Trade</span>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>


</x-app-layout>
