@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Users</h1>

        <div class="w-full mt-10">
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
                                        <form id="users" method="POST" action="{{ route('admin.user.delete', $user->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="confirmDelete(event, 'users')" class="text-red-600 dark:text-red-500 hover:underline ms-3 mt-4">
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
