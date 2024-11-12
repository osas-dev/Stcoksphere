<x-app-layout>
    <x-slot name="header">{{ __('Bank Transfer') }}</x-slot>

    <form method="POST" action="{{ route('user.transactions.add_withdrawals') }}"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf

        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Full name</span>
            <input name="full_name" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Jane Doe" />
            @error('full_name')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Bank name</span>
            <input name="bank_name" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Bank name" />
            @error('bank_name')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Bank Account Number</span>
            <input name="account_number" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Bank Account Number" />
            @error('account_number')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Bank Branch</span>
            <input name="bank_branch" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Bank Branch" />
            @error('bank_branch')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Routing Number</span>
            <input name="rounting_number" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="Routing Number" />
            @error('rounting_number')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">SWIFT/BIC Code (IBAN)</span>
            <input name="swift_code" type="text" required
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
                placeholder="SWIFT/BIC Code (IBAN)" />
            @error('swift_code')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </label>

        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="method" value="bank">


        <button
            class="mt-4 px-6 py-2 text-sm font-medium leading-5 text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>
    </form>
</x-app-layout>
