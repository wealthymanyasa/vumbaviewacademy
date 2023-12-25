<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">



        <div class="">
            <div class="flex justify-end m-2 p-2 ">
                <a href="{{ route('admin.students.index') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    Students List</a>
            </div>

        </div>
        <div class=" flex justify-center">
            <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

                <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
                    @csrf
                    @method('put')
                    <div class="">
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Update Student</h2>
                    </div>
                    <div class="mb-6  ">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $student->name }}">
                            @error('name')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="surname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surname</label>
                        <input type="text" name="surname"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('surname') border-pink-400 @enderror"
                            value="{{ $student->surname }}">
                            @error('surname')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="dateOfBirth"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Birth</label>
                        <input type="date" name="dateOfBirth"
                            class="shadow-sm bg-purple-50 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('dateOfBirth') border-pink-400 @enderror"
                            value="{{ $student->dateOfBirth }}">
                            @error('dateOfBirth')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="birthEntryNumber"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Entry
                            Number</label>
                        <input type="text" name="birthEntryNumber"
                            class="shadow-sm bg-purple-50 border text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('birthEntryNumber') border-pink-400 @enderror"
                            value="{{ $student->birthEntryNumber }}">
                            @error('birthEntryNumber')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="dateOfEnrolment"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of
                            Enrolment</label>
                        <input type="date" name="dateOfEnrolment"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror"
                            value="{{ $student->dateOfEnrolment }}">
                            @error('dateOfEnrolment')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="mb-6  ">
                        <label for="Student Type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Type</label>
                        <select name="studentType"
                            @selected(true) class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('name') border-pink-400 @enderror">
                            @foreach (App\Enums\StudentType::values() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6  ">
                        <label for="health_status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Health Status/Disability</label>
                        <textarea type="text" name="health_status" rows="3"
                            class="shadow-sm bg-purple-50 border border-purple-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-purple-700 dark:border-purple-600 dark:placeholder-purple-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-blue-500 dark:shadow-sm-light @error('health_status') border-pink-400 @enderror"
                            placeholder="Enter Health Status/Disability Details" value="">
                            {{ $student->health_status}}
                        </textarea>
                        @error('health_status')
                            <h1 class="text-sm text-pink-400">{{ $message }}</h1>
                        @enderror
                    </div>
                    <div class="flex justify-end m-2 p-2 ">
                        <button type="submit"
                            class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
