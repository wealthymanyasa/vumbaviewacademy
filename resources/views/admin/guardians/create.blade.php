<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">

        <div class="">
            <div class="flex justify-end m-2 p-2 ">
                <a href="{{ route('admin.guardians.index') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    Guardians List</a>
            </div>

        </div>
        <div class=" flex justify-center">
            <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

                <form method="POST" action="{{ route('admin.guardians.store') }}">
                    @csrf

                    <div class="">
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Create Guardian</h2>
                    </div>
                    @if (session('message'))
                        <div class="w-full py-4 bg-pink-300 rounded-lg flex justify-center">
                            <h2>{{ session('message') }}</h2>
                        </div>
                    @endif
                    <div class="mb-6  ">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span class="text-pink-500">*</span></label>
                        <input type="text" name="name"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            placeholder="Enter name">
                            @error('name')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="surname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surname<span class="text-pink-500">*</span></label>
                        <input type="text" name="surname"
                            class="shadow-sm bg-purple-50 borde text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('surname') border-pink-400 @enderror"
                            placeholder="Enter surname">
                            @error('surname')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address <span class="text-purple-500">(Optional)</span></label>
                        <input type="email" name="email"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('email') border-pink-400 @enderror"
                            placeholder="Enter email address">
                    </div>
                    <div class="mb-6  ">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Physical Address<span class="text-pink-500">*</span></label>
                        <input type="text" name="address"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('address') border-pink-400 @enderror"
                            placeholder="Enter physical address">
                            @error('address')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                            Number<span class="text-pink-500">*</span></label>
                        <input type="text" name="phone"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('phone') border-pink-400 @enderror"
                            placeholder="Enter phone number">
                            @error('phone')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="student_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Identification Number<span class="text-pink-500">*</span></label>
                        <input type="text" name="student_id"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('student_id') border-pink-400 @enderror"
                            placeholder="Enter student identification number">
                            @error('student_id')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="relationship_to_student"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship Of Parent To Student<span class="text-pink-500">*</span></label>
                        <input type="text" name="relationship_to_student"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('relationship_to_student') border-pink-400 @enderror"
                            placeholder="Enter relationship of parent to student">
                            @error('relationship_to_student')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>


                    {{-- @if ($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif --}}


                    <div class="flex justify-end m-2 p-2 ">
                        <button type="submit"
                            class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Create Guardian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
