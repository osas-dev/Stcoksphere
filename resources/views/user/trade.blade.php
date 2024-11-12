<x-app-layout>
    <x-slot name="header">
        {{ __('New Trade') }}
    </x-slot>


    <div class="">
        <form method="POST" action="{{ route('user.tradeStock') }}"
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @csrf
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Stock
                </span>
                <select name="stock"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="{{ $stock->name }}">{{ $stock->name }}, ${{ $stock->price }}/{{ $stock->unit }}</option>

                    @foreach ($allStocks as $stocks)
                        <option value="{{ $stocks->name }}">{{ $stocks->name }}, ${{ $stocks->price }}/{{ $stocks->unit }}</option>
                    @endforeach
                </select>
                @error('stock')
                <span class="text-xs dark:text-gray-400" style="color: red">
                    {{$message}}
                </span>
                @enderror
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Trade Type
                </span>
                <select name="tradeType"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="buy">Buy</option>
                    <option value="sell">Sell</option>
                </select>
                
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Amount
                </span>
                <div class="relative text-gray-500 focus-within:text-purple-600">
                    <input name="amount"
                        class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                        placeholder="500" />
                    <span
                        class="absolute flex items-center inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        USD
                    </span>
                </div>
                <span class="text-xs text-purple-600 dark:text-purple-400">
                    Your balance is {{number_format(Auth::user()->main_balance)}} USD.
                </span>
                @error('amount')
                <span class="text-xs text-red-500 dark:text-gray-400" style="color: red">
                    {{$message}}
                </span>
                @enderror
            </label>

            <button
                class="mt-4 flex uppercase items-center justify-between px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Trade</span>
            </button>
        </form>
    </div>


</x-app-layout>
