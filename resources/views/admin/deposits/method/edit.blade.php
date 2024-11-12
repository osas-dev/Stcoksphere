@extends('layouts.admin.app')


@section('content')

    <main class="w-full flex-grow p-6 flex items-center flex-col">
        <p class="text-xl pb-6 flex items-center">
            Edit Deposit method
        </p>

        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2 flex flex-col">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" enctype="multipart/form-data" method="POST" action="{{route('admin.deposits.method.update', $deposit->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                            type="text" required="" placeholder="Bitcoin payment" value="{{$deposit->name}}" aria-label="Name">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="desc">Description</label>
                        <textarea cols="30" rows="8" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="desc" name="desc"
                            type="text" required="" placeholder="Description" aria-label="desc">{{$deposit->desc}}</textarea>
                    </div>
                    <div class="mt-2 ">
                        <label class="block text-sm text-gray-600" for="7d_change">Status</label>
                        <select class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="status" name="status"
                            type="text" required=""  aria-label="status" value="{{$deposit->status}}">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                            file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="method_img" type="file" name="img">
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
