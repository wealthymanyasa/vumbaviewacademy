<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">



        <div class="">
            <div class="flex justify-end m-2 p-2 ">
                <a href="{{ route('admin.bills.index') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    Bills List</a>
            </div>

        </div>
        <div class=" flex justify-center">
            <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

                <form method="POST" action="{{ route('admin.bills.update', $bill->id) }}">
                    @csrf
                    @method('put')
                    <div class="">
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Update Bill</h2>
                    </div>
                    @if (session('message'))
                        <div class="w-full py-4 bg-pink-300 rounded-lg flex justify-center">
                            <h2>{{ session('message') }}</h2>
                        </div>
                    @endif

                    <div class="mb-6  ">
                        <label for="amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="text" name="bill_amount"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $bill->bill_amount }}">
                    </div>

                    <div class="mb-6  ">
                        <label for="bill_type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bill Type</label>
                        <input type="text" name="bill_type"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $bill->bill_type }}">
                    </div>
                    <div class="mb-6  ">
                        <label for="academic_year"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Academic Year</label>
                        <input type="text" name="academic_year"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $bill->academic_year }}">
                    </div>
                    <div class="mb-6  ">
                        <label for="term"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term</label>
                        <input type="text" name="term"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $bill->term }}">
                    </div>

{{--
                    @if ($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif --}}
                    <div class="flex justify-end m-2 p-2 ">
                        <button type="submit"
                            class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Update Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>