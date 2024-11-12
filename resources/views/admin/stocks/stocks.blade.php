@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Stocks</h1>

        <div class="w-full mt-10">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.stocks.create') }}"
                    class=" bg-white cta-btn font-semibold py-2 px-4 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Add Stock
                </a>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Stock name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Unit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Market Capital
                            </th>
                            <th scope="col" class="px-6 py-3">
                                daily change
                            </th>
                            <th scope="col" class="px-6 py-3">
                                weekly change
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($stocks->isEmpty())
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    colspan="8">
                                    No stocks yet..
                                </td>
                            </tr>
                        @else
                            @foreach ($stocks as $stock)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full" src="{{ asset($stock->img) }}" alt="Jese img">
                                        <div class="ps-3">
                                            <div class="font-normal text-gray-500">{{ $stock->name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $stock->unit }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $stock->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $stock->market_capital }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $stock->daily_change }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $stock->weekly_change }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($stock->status === 'Active')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                                {{ $stock->status }} </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                                {{ $stock->status }} </span>
                                        @endif
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <a href="{{ route('admin.stocks.edit', $stock->id) }}"
                                            class="text-blue-600 dark:text-blue-500 hover:underline mt-4">
                                            <i class="fa-solid fa-pen w-5 h-5"></i>
                                        </a>
                                        <form id="stocks" method="POST" action="{{ route('admin.stocks.destroy', $stock->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="confirmDelete(event, 'stocks')" class="text-red-600 dark:text-red-500 hover:underline ms-3 mt-4">
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
