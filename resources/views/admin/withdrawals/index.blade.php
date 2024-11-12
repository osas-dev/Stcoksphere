@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">All Withdrawals</h1>

        <div class="w-full mt-10">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Transaction ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Method
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reason
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date/Time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($withdrawals->isEmpty())

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    colspan="8">
                                    No withdrawal transactions yet..
                                </td>
                            </tr>
                        @else
                            @foreach ($withdrawals as $withdrawal)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $withdrawal->txid }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $withdrawal->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($withdrawal->status === 'completed')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 rounded-md">
                                                {{ $withdrawal->amount }} </span>
                                        @elseif ($withdrawal->status === 'rejected')
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 rounded-md">
                                                {{ $withdrawal->amount }} </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 rounded-md">
                                                {{ number_format($withdrawal->amount) }} </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $withdrawal->method }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($withdrawal->reason)
                                            @if ($withdrawal->status === 'completed')
                                                <span
                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                                    {{ $withdrawal->reason }} </span>
                                            @elseif ($withdrawal->status === 'rejected')
                                                <span
                                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                                    {{ $withdrawal->reason }} </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-md">
                                                    {{ $withdrawal->reason }} </span>
                                            @endif
                                        @else
                                            {{ $withdrawal->reason }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($withdrawal->status === 'completed')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                                Completed </span>
                                        @elseif ($withdrawal->status === 'rejected')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                                Rejected </span>
                                        @else
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-md">
                                                Pending </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($withdrawal->status === 'completed')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                                Completed </span>
                                        @elseif ($withdrawal->status === 'rejected')
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                                Rejected </span>
                                        @else
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('admin.withdrawals.approve', $withdrawal->id) }}"
                                                    class="text-white shadow-md bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 11.917 9.724 16.5 19 7.5" />
                                                    </svg>

                                                </a>
                                                <button data-modal-target="{{ $withdrawal->txid }}"
                                                    data-modal-toggle="{{ $withdrawal->txid }}"
                                                    class="text-white shadow-md bg-yellow-300 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-300 dark:hover:bg-yellow-300 dark:focus:ring-yellow-800">
                                                    <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-width="2"
                                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                        <path stroke="currentColor" stroke-width="3"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </button>
                                                <a href="{{ route('admin.withdrawals.reject', $withdrawal->id) }}"
                                                    class="text-white shadow-md bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                                    <svg class="w-4 h-4 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="3"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                </a>
                                            </div>
                                            {{-- withdrawal details Modal --}}
                                            <div id="{{ $withdrawal->txid }}" tabindex="-1" aria-hidden="true"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                withdrawal details
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-toggle="{{ $withdrawal->txid }}">
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
                                                        <div class="flex flex-col justify-center p-5">
                                                            @if ($withdrawal->method === 'bank')
                                                                <div>
                                                                    <h3>Bank Transfer Withdrawal Details:</h3>
                                                                    <p><strong>Full Name:</strong>
                                                                        {{ $withdrawal->details['full_name'] ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Bank Name:</strong>
                                                                        {{ $withdrawal->details['bank_name'] ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Account Number:</strong>
                                                                        {{ $withdrawal->details['account_number'] ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Bank Branch:</strong>
                                                                        {{ $withdrawal->details['bank_branch'] ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>Routing Number:</strong>
                                                                        {{ $withdrawal->details['routing_number'] ?? 'N/A' }}
                                                                    </p>
                                                                    <p><strong>SWIFT Code:</strong>
                                                                        {{ $withdrawal->details['swift_code'] ?? 'N/A' }}
                                                                    </p>
                                                                </div>
                                                            @elseif ($withdrawal->method === 'crypto')
                                                            <div>
                                                                <h3>Crypto Withdrawal Details:</h3>
                                                                <p><strong>Crypto Address:</strong> {{ $withdrawal->details['crypto_address'] ?? 'N/A' }}</p>
                                                                <p><strong>Crypto network:</strong> {{ $withdrawal->details['crypto_network'] ?? 'N/A' }}</p>
                                                            </div>
                                                            @else
                                                            <div>
                                                                <h3>Admin</h3>
                                                            </div>

                                                            @endif
                                                            <div class="p-4 md:p-5 text-center">
                                                                <a href="{{ route('admin.withdrawals.approve', $withdrawal->id) }}"
                                                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Approve
                                                                </a>
                                                                <a href="{{ route('admin.withdrawals.reject', $withdrawal->id) }}"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 ms-3 text-center">
                                                                    Reject
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $withdrawal->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>


                </table>
            </div>

        </div>

        {{-- Pagination --}}
        <div
            class="grid px-4 pt-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing {{ $withdrawals->firstItem() }}-{{ $withdrawals->lastItem() }} of
                {{ $withdrawals->total() }}
            </span>
            <span class="col-span-2"></span>

            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <!-- Previous Page Link -->
                        @if ($withdrawals->onFirstPage())
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
                                <a href="{{ $withdrawals->previousPageUrl() }}"
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
                        @for ($page = 1; $page <= $withdrawals->lastPage(); $page++)
                            <li>
                                <a href="{{ $withdrawals->url($page) }}"
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $withdrawals->currentPage() ? 'text-white bg-purple-600' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endfor

                        <!-- Next Page Link -->
                        @if ($withdrawals->hasMorePages())
                            <li>
                                <a href="{{ $withdrawals->nextPageUrl() }}"
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
