@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Deposit Methods</h1>

        <div class="w-full mt-10">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.deposits.method.create') }}"
                    class=" bg-white cta-btn font-semibold py-2 px-4 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center cursor-pointer">
                    <i class="fas fa-plus mr-3"></i> Add
                </a>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
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
                        @if ($methods->isEmpty())
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    colspan="8">
                                    No deposit methods yet..
                                </td>
                            </tr>
                        @else
                            @foreach ($methods as $method)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="ps-3">
                                            <div class="font-normal text-gray-500">{{ $method->name }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        @if ($method->status === 'Active')
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md">
                                                {{ $method->status }} </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md">
                                                {{ $method->status }} </span>
                                        @endif
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <a href="{{ route('admin.deposits.method.edit', $method->id) }}"
                                            class="text-blue-600 dark:text-blue-500 hover:underline mt-4">
                                            <i class="fa-solid fa-pen w-5 h-5"></i>
                                        </a>
                                        <form id="methods" method="POST"
                                            action="{{ route('admin.deposits.method.destroy', $method->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="confirmDelete(event, 'methods')" class="text-red-600 dark:text-red-500 hover:underline ms-3 mt-4">
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
