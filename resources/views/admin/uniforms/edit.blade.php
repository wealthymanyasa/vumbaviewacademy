<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">



        <div class="">
            <div class="flex justify-end m-2 p-2 ">
                <a href="{{ route('admin.uniforms.index') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    Uniforms List</a>
            </div>

        </div>
        <div class=" flex justify-center">
            <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

                <form method="POST" action="{{ route('admin.uniforms.update', $uniform->id) }}">
                    @csrf
                    @method('put')
                    <div class="">
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Update Uniforms</h2>
                    </div>
                    @if (session('message'))
                        <div class="w-full py-4 bg-pink-300 rounded-lg flex justify-center">
                            <h2>{{ session('message') }}</h2>
                        </div>
                    @endif
                    <div class="mb-6  ">
                        <label for="amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="text" name="amount"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $uniform->amount }}">
                    </div>
                    <div class="mb-6  ">
                        <label for="bill"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bill</label>
                        <input type="text" name="bill"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $uniform->bill }}">
                    </div>
                    <div class="mb-6  ">
                        <label for="balance"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Balance</label>
                        <input type="text" name="balance"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $uniform->balance }}">
                    </div>
                    <div class="mb-6  ">
                        <label for="dateOfPayment"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Payment</label>
                        <input type="date" name="dateOfPayment"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $uniform->dateOfPayment }}">
                    </div>


                    <div class="flex justify-end m-2 p-2 ">
                        <button type="submit"
                            class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
