@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Dashboard</h1>

        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <a href="{{ route('admin.users') }}">
                <div class="flex justify-between items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="flex items-center">
                        <div
                            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Total Users
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ $total_users }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card -->
            <a href="{{ route('admin.plans.active') }}">
                <div class="flex justify-between items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="flex items-center">
                        <div
                            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Total Investments
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                $ {{ number_format($total_investments) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-self-end">
                    </div>
                </div>
            </a>

            <!-- Card -->
            <a href="{{ route('admin.deposits') }}">
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Deposits
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            $ {{ number_format($total_deposits) }}
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card -->
            <a href="{{ route('admin.withdrawals') }}">
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Withdrawals
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            $ {{ number_format($total_withdrawals) }}
                        </p>
                    </div>
                </div>
            </a>
        </div>


        <div class="w-full mt-10">
            <p class="text-xl pb-3 flex items-center">
                <i class="fas fa-list mr-3"></i> Users
            </p>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Main Balance
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Invest Balance
                            </th>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Joined at
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isEmpty())
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    colspan="8">
                                    No stocks yet..
                                </td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="ps-3">
                                            <div class="font-normal text-gray-500">{{ $user->name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->main_balance }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->invest_balance }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="text-blue-600 dark:text-blue-500 hover:underline mt-4">
                                            <i class="fa-solid fa-pen w-5 h-5"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.user.delete', $user->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600 dark:text-red-500 hover:underline ms-3 mt-4">
                                                <i class="fa-solid fa-trash-can w-5 h-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                    </tbody>
                </table>
            </div>

        </div>
    </main>

@stop
