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
                        <h2 class="text-xl font-bold text-purple-700 uppercase text-center">Student Details</h2>
                    </div>
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">Name</span></div>
                        <div>{{ $student->name }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">surname</span></div>
                        <div>{{ $student->surname }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">date of birth</span></div>
                        <div>{{ $student->dateOfBirth }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">Date of enrolment</span></div>
                        <div>{{ $student->dateOfEnrolment }}</div>
                    </div>
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">student type</span></div>
                        <div>{{ $student->studentType }}</div>
                    </div>



                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
