<x-app-layout>
    <x-slot name="header">
        {{ __('All Investments') }}
    </x-slot>


    <h2 class="my-6 pt-5 text-lg font-semibold text-gray-700 dark:text-gray-200">Active Investments</h2>
    <div class="w-full mb-10 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Plan Name</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Accumulated Profits</th>
                        <th class="px-4 py-3">Start Time</th>
                        <th class="px-4 py-3">End Time</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @if ($investments->isEmpty())
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm text-center" colspan="5">
                                <p class="font-semibold">You have no active investments...</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($investments as $investment)
                            @php
                                $startTime = Carbon\Carbon::parse($investment->start_time);
                                $endTime = Carbon\Carbon::parse($investment->end_time);

                                $startInHuman = $startTime->diffForHumans();
                                $endInHuman = $endTime->diffForHumans();
                            @endphp
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $investment->investmentPlan->name }}</p>
                                </td>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    ${{ number_format($investment->amount) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    ${{ number_format($investment->accumulated_profit, 2) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $startTime->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $endTime->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($investment->status == 'completed')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            {{ $investment->status }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                            {{ $investment->status }}
                                        </span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $investments->firstItem() }}-{{ $investments->lastItem() }} of
                {{ $investments->total() }}
            </span>
            <span class="col-span-2"></span>

            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <!-- Previous Page Link -->
                        @if ($investments->onFirstPage())
                            <li>
                                <span class="px-3 py-1 rounded-md rounded-l-lg opacity-50 cursor-not-allowed"
                                    aria-disabled="true">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $investments->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Previous">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @endif

                        <!-- Pagination Links -->
                        @for ($page = 1; $page <= $investments->lastPage(); $page++)
                            <li>
                                <a href="{{ $investments->url($page) }}"
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $investments->currentPage() ? 'text-white bg-purple-600' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor

                        <!-- Next Page Link -->
                        @if ($investments->hasMorePages())
                            <li>
                                <a href="{{ $investments->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="px-3 py-1 rounded-md rounded-r-lg opacity-50 cursor-not-allowed"
                                    aria-disabled="true">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a 1 1 0 010 1.414l-4 4a 1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </span>
        </div>

    </div>
    <h2 class="my-6 pt-5 text-lg font-semibold text-gray-700 dark:text-gray-200">Completed Investments</h2>
    <div class="w-full mb-10 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Plan Name</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Accumulated Profits</th>
                        <th class="px-4 py-3">Start Time</th>
                        <th class="px-4 py-3">End Time</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @if ($completed_investments->isEmpty())
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm text-center" colspan="5">
                                <p class="font-semibold">You have no completed investments...</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($completed_investments as $completed_investment)
                            @php
                                $startTime = Carbon\Carbon::parse($completed_investment->start_time);
                                $endTime = Carbon\Carbon::parse($completed_investment->end_time);

                                $startInHuman = $startTime->diffForHumans();
                                $endInHuman = $endTime->diffForHumans();
                            @endphp
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $completed_investment->investmentPlan->name }}</p>
                                </td>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    ${{ number_format($completed_investment->amount) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    ${{ number_format($completed_investment->accumulated_profit, 2) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $startTime->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $endTime->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($completed_investment->status == 'completed')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            {{ $completed_investment->status }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                            {{ $completed_investment->status }}
                                        </span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $completed_investments->firstItem() }}-{{ $completed_investments->lastItem() }} of
                {{ $completed_investments->total() }}
            </span>
            <span class="col-span-2"></span>

            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <!-- Previous Page Link -->
                        @if ($completed_investments->onFirstPage())
                            <li>
                                <span class="px-3 py-1 rounded-md rounded-l-lg opacity-50 cursor-not-allowed"
                                    aria-disabled="true">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $completed_investments->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Previous">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @endif

                        <!-- Pagination Links -->
                        @for ($page = 1; $page <= $completed_investments->lastPage(); $page++)
                            <li>
                                <a href="{{ $completed_investments->url($page) }}"
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $completed_investments->currentPage() ? 'text-white bg-purple-600' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor

                        <!-- Next Page Link -->
                        @if ($completed_investments->hasMorePages())
                            <li>
                                <a href="{{ $completed_investments->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="px-3 py-1 rounded-md rounded-r-lg opacity-50 cursor-not-allowed"
                                    aria-disabled="true">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a 1 1 0 010 1.414l-4 4a 1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </span>
        </div>

    </div>


</x-app-layout>
