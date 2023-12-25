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
            {{-- <div class="m-2  bg-purple-100 sm:w-[500px] w-full p-4 rounded-lg">

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
                    <div class="grid grid-cols-2 p-6">
                        <div><span class="uppercase">student health status</span></div>
                        <div>{{ $student->health_status ?? 'None'}}</div>
                    </div>



                </form>
            </div> --}}
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
                <!-- Grid -->
                <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-2xl font-semibold text-purple-700 dark:text-gray-200">{{ $student->name }}'s
                            Details</h2>
                    </div>
                    <!-- Col -->

                    {{-- <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-purple-500 text-white hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="#">
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9" />
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                            <rect width="12" height="8" x="6" y="14" />
                        </svg>
                        Print
                    </a> --}}
                    <!-- Col -->
                </div>
                <!-- End Grid -->


                <!-- Table -->
                <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4 dark:border-gray-700">
                    <div class="hidden sm:grid sm:grid-cols-8">
                        <div class="text-xs font-medium text-gray-500 uppercase">Name</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">Surname</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">birth entry number</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">Date of Birth</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">DATE OF ENROLMENT</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">STUDENT TYPE</div>
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">STUDENT health status</div>

                    </div>

                    <div class="hidden sm:block border-b border-gray-200 dark:border-gray-700"></div>

                    <div class="grid grid-cols-3 sm:grid-cols-8 gap-2">
                        <div class="">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Name</h5>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $student->name }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Surname</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->surname }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">birth Entry Number</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->birthEntryNumber }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Date Of Birth</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->dateOfBirth }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Date Of Enrolment</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->dateOfEnrolment }}</p>
                        </div>
                        <div>

                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Student Type</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->studentType }}</p>
                        </div>

                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Health Status</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $student->health_status ?? 'None' }}</p>
                        </div>


                    </div>


                </div>
                <!-- End Table -->


            </div>
        </div>
    </div>

</x-admin-layout>
