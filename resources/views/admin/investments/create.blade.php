@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6 flex items-center flex-col">
        <p class="text-xl pb-6 flex items-center">
            Create a new Investment Plan
        </p>

        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2 flex flex-col">
            <div class="leading-loose">
                <form method="POST" action="{{ route('admin.plans.store') }}" enctype="multipart/form-data"
                    class="p-10 bg-white rounded shadow-xl">
                    @csrf
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                            type="text" required placeholder="Plan Name" aria-label="Name">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="rate">Rate</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="rate" name="rate"
                            type="number" required placeholder="Plan rate ex: 5.5%" aria-label="rate">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="duration">Duration</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="duration" name="duration"
                            type="number" required placeholder="Duration" aria-label="duration">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="min_value">Plan Minimum Amount</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="min_value" name="min_value"
                            type="number" required placeholder="Minimum amount" aria-label="min_value">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="max_value">Plan Maximum Amount</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="max_value" name="max_value"
                            type="number" required placeholder="Maximum Amount" aria-label="max_value">
                    </div>
                    <div class="mt-2 ">
                        <label class="block text-sm text-gray-600" for="frequency">Frequency</label>
                        <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="frequency" name="frequency"
                            type="text" required  aria-label="frequency">
                            <option value="hourly">Hourly</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="mt-2 hidden">
                        <label class="block text-sm text-gray-600" for="7d_change">status</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="status" name="status"
                            type="hidden" required placeholder="5" aria-label="status" value="Active">
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
