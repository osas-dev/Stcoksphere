<x-app-layout>
    <x-slot name="header">
        {{ __('Investment Plans') }}
    </x-slot>


    <div class="">
        <div class="flex flex-wrap justify-center">
            @foreach ($plans as $plan)
                <div class="p-4">
                    <div class="flex flex-col justify-center p-4 max-w-md bg-white rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700"
                        style="width: 300px; border: 2px solid rgb(203, 68, 236);">
                        <div class="flow-root">
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                Plan
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                            {{ $plan->name }}
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                Minimum Amount
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                            ${{ number_format($plan->min_value) }}
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                Maximum Value
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                            ${{ number_format($plan->max_value) }}
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                Plan Duration
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                            {{ $plan->duration }}
                                            @if ($plan->frequency === 'hourly')
                                                Hours
                                            @elseif($plan->frequency === 'daily')
                                                Days
                                            @elseif($plan->frequency === 'weekly')
                                                Weeks
                                            @elseif($plan->frequency === 'monthly')
                                                Months
                                            @else
                                                {{ $plan->frequency }}
                                            @endif

                                        </div>
                                    </div>
                                </li>
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                                                Profit Rate
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-sm font-normal text-gray-900 dark:text-white">
                                            {{ $plan->rate }}% {{ $plan->frequency }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mx-auto">
                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                class="flex uppercase items-center justify-between px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <svg class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 512 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    fill="#ffffff" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
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
                                <span>Invest</span>
                            </button>

                            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Amount to Invest
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5" method="POST" action="{{route('user.invest')}}">
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="amount"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                    <input type="number" name="amount" id="amount"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Amount" required="">
                                                </div>
                                                <input type="hidden" name="plan_id" value='{{$plan->id}}' />
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>


</x-app-layout>
