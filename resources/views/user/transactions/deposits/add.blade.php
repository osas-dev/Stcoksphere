<x-app-layout>
    <x-slot name="header">{{ __('New Deposit') }}</x-slot>

    <div class="w-60 h-w-60 pb-6">
        <img class="" src="{{ asset($method->img) }}" alt="">
    </div>
    <span class="pt-4 uppercase font-bold dark:text-gray-300">{{ $method->name }} details:</span>
    <p class="dark:text-gray-300">{{ $method->desc }}</p>

    <form method="POST" action="{{ route('user.transactions.add_deposits') }}" enctype="multipart/form-data"
        class="px-4 py-3 mt-5 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="method" value="{{ $method->name }}">

        <div>
            <label for="proof" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proof</label>
            <input
                class="block w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 rounded-lg"
                id="proof" type="file" name="img" required>
            <span class="mt-1 text-xs text-gray-500 dark:text-gray-300">Upload your proof of payment here.</span>
            @error('img')
                <p class="mt-1 text-sm text-red-500" id="file_input_help">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button
            class="mt-4 px-6 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Submit
        </button>
    </form>
</x-app-layout>
