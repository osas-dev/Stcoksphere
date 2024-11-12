<x-app-layout>
    <x-slot name="header">{{ __('Crypto') }}</x-slot>

    <form method="POST" action="{{ route('user.transactions.add_withdrawals') }}"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Crypto Address</span>
            <input name="crypto_address" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Crypto Address" />
            @error('crypto_address')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Crypto Network</span>
            <input name="crypto_network" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Crypto Network" />
            @error('crypto_network')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>

        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="method" value="crypto">


        <button
            class="mt-4 px-6 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>
    </form>
</x-app-layout>
