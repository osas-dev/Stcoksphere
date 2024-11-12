<x-app-layout>
    <x-slot name="header">{{ __('New Withdrawal') }}</x-slot>

    <form method="POST" action="{{ route('user.transactions.withdrawals.methods.show') }}"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <!-- Method Selection -->
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Withrawal Method</span>
            <select name="method"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="">Select a Withdrawal Method</option>
                <option value="bank">Bank Transfer</option>
                <option value="crypto">Crypto</option>
            </select>
            @error('method')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>

        <!-- Amount Input -->
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Amount</span>
            <input name="amount" type="number" min="1" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="500" />
            @error('amount')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>

        <button
            class="mt-4 px-6 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>
    </form>
</x-app-layout>
