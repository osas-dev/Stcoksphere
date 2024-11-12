@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6 flex items-center flex-col">
        <p class="text-xl pb-6 flex items-center">
            Edit stock
        </p>

        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2 flex flex-col">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" enctype="multipart/form-data" method="POST" action="{{route('admin.stocks.update', $stock->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                            type="text" required="" placeholder="Stock Name: Tesla, Gold" value="{{$stock->name}}" aria-label="Name">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="unit">Unit</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="unit" name="unit"
                            type="text" required="" placeholder="Unit: kg, ton, shares" value="{{$stock->unit}}" aria-label="unit">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="price">Price</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="price" name="price"
                            type="text" required="" placeholder="Price per Unit" value="{{$stock->price}}" aria-label="price">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="market-capital">Market Capital</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="market_capital"
                            name="market_capital" type="text" required="" placeholder="200,000,000"  value="{{$stock->market_capital}}"
                            aria-label="market_capital">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="daily_change">{{ __('Daily Change (%).') }}</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="daily_change" name="daily_change"
                            type="text" required="" placeholder="2" aria-label="daily_change"  value="{{$stock->daily_change}}">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="weekly_change">{{ __('Weekly Change (%).') }}</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="weekly_change" name="weekly_change"
                            type="text" required="" placeholder="5" aria-label="weekly_change"  value="{{$stock->weekly_change}}">
                    </div>
                    <div class="mt-2 ">
                        <label class="block text-sm text-gray-600" for="7d_change">Status</label>
                        <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="status" name="status"
                            type="text" required=""  aria-label="status" value="{{$stock->status}}">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                            file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file" name="img">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                            {{ __('SVG, PNG, JPG (MAX. 800x400px).') }}</p>

                    </div>

                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                            type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@stop
