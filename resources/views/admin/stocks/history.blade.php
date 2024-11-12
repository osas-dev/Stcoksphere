@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Trade History</h1>

        <div class="w-full mt-10">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Transaction ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                daily change
                            </th>
                            <th scope="col" class="px-6 py-3">
                                weekly change
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Trade Type
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($transactions->isEmpty())

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td colspan="8" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No stocks trades yet..
                                </td>
                            </tr>
                        @else
                            @foreach ($transactions as $transaction)
                            @endforeach
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->txid }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->stock->name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaction->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    
                                    @if ($transaction->tradeType === 'buy')
                                        <p
                                            class="px-2 py-1 font-semibold leading-tight text-green-700">
                                            {{ number_format($transaction->amount) }} </p>
                                    @else
                                        <p
                                            class="px-2 py-1 font-semibold leading-tight text-red-700">
                                            {{ number_format($transaction->amount) }} </p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->stock->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->stock->daily_change }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->stock->weekly_change }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->tradeType === 'buy')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                            {{ $transaction->tradeType }} </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                            {{ $transaction->tradeType }} </span>
                                    @endif
                                </td>
                            </tr>
                        @endif

                    </tbody>


                </table>
            </div>

        </div>

        {{-- Pagination --}}
        <div
            class="grid px-4 pt-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of
                {{ $transactions->total() }}
            </span>
            <span class="col-span-2"></span>

            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <!-- Previous Page Link -->
                        @if ($transactions->onFirstPage())
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
                                <a href="{{ $transactions->previousPageUrl() }}"
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
                        @for ($page = 1; $page <= $transactions->lastPage(); $page++)
                            <li>
                                <a href="{{ $transactions->url($page) }}"
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $transactions->currentPage() ? 'text-white bg-purple-600' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor

                        <!-- Next Page Link -->
                        @if ($transactions->hasMorePages())
                            <li>
                                <a href="{{ $transactions->nextPageUrl() }}"
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
    </main>

@stop
