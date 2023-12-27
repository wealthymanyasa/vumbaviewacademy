<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="">
            <div class="flex justify-end m-2 p-2 ">
                <a href="{{ route('admin.fees.index') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    Fees List</a>
            </div>

        </div>
        <div class=" flex justify-center">
            <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

                <form method="POST" action="{{ route('admin.fees.store') }}">
                    @csrf

                    <div class="">
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Create Fees Payment</h2>
                    </div>
                    {{-- @if (session('message'))
                        <div class="w-full py-4 bg-pink-300 rounded-lg flex justify-center">
                            <h2>{{ session('message') }}</h2>
                        </div>
                    @endif --}}
                    <div class="mb-6  ">
                        <label for="amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount<span
                                class="text-pink-500">*</span></label>
                        <input type="number" name="amount"
                            class="shadow-sm bg-purple-50 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('amount') border-pink-400 @enderror"
                            placeholder="Enter amount" value="{{ old('amount') }}">
                        @error('amount')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>

                    <div class="mb-6  ">
                        <label for="student_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Identification
                            Number<span class="text-pink-500">*</span></label>
                        <input type="number" name="student_id"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('student_id') border-pink-400 @enderror"
                            placeholder="Enter Student Identification Number" value="{{ old('student_id') }}">
                        @error('student_id')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="receipt_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receipt Number<span
                                class="text-pink-500">*</span></label>
                        <input type="text" name="receipt_number"
                            class="shadow-sm bg-purple-50 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('receipt_number') border-pink-400 @enderror"
                            placeholder="Enter receipt number" value="{{ old('receipt_number') }}">
                        @error('receipt_number')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>

                    <div class="mb-6  ">
                        <label for="date_of_payment"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Payment<span
                                class="text-pink-500">*</span></label>
                        <input type="date" name="date_of_payment"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('date_of_payment') border-pink-400 @enderror"
                            placeholder="Enter Date Of Payment" value="{{ old('date_of_payment') }}">
                        @error('date_of_payment')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>

                    <div class="mb-6  ">
                        <label for="academic_year"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Academic Year<span
                                class="text-pink-500">*</span></label>
                        <select type="text" name="academic_year"
                            class="shadow-sm bg-purple-50 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('academic_year') border-pink-400 @enderror">
                            <option value="{{ old('academic_year') }}">{{ old('academic_year') }}</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>

                        @error('academic_year')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="term"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term<span
                                class="text-pink-500">*</span></label>
                        <select type="number" name="term"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('term') border-pink-400 @enderror">
                            <option value="{{ old('term') }}">{{ old('term') }}</option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                        </select>
                        @error('term')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  " style="display: none">
                        <label for="bill_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bill
                            Type<span class="text-pink-500">*</span></label>
                        <select type="text" name="bill_type"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror">
                            <option selected value="Fees">Fees</option>

                        </select>
                        @error('bill_type')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    {{-- @if ($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif --}}

                    <div class="flex justify-end m-2 p-2 ">
                        <button type="submit"
                            class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Create Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
