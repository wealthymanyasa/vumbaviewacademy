<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 p-4 space-y-6">
        <div class="border-l-4 border-purple-300 flex justify-between">
            <span class="p-4 uppercase font-semibold "> Fees </span>

            <div class="flex items-center">
                <a href="{{ route('admin.fees.create') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    New Payment</a>
            </div>
        </div>
        <div class="relative overflow-x-auto rounded-lg shadow-purple-200 shadow-md">

            <table id="feesTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs  text-gray-700 uppercase  bg-purple-300 dark:bg-purple-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Student Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Student Surname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date of payment
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            Period
                        </th> --}}
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Balance
                        </th>


                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fees as $fee)
                        <tr class="bg-purple-100 border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $fee->student->name ?? '' }}
                            </td>


                        <td scope="row max-w-[200px]"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $fee->student->surname ?? '' }}
                        </td>

                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $fee->dateOfPayment }}
                        </td>
                        {{-- <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Term {{ $fee->bill->term ?? ''}} of {{ $fee->bill->academic_year ?? '' }}
                        </td> --}}

                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${{ $fee->amount }}
                        </td>

                        <td scope="row max-w-[200px]"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${{ $fee->balance }}
                        </td>




                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.fees.edit', $fee->id) }}"
                                    class="px-4 py-2 bg-purple-500  text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">Edit</a>
                                <form
                                    class="text-white px-4 py-2 bg-pink-500 rounded-full cursor-pointer hover:bg-white hover:text-gray-800 hover:border hover:border-pink-400"
                                    method="POST" action="{{ route('admin.fees.destroy', $fee->id) }}"
                                    onSubmit="return confirm('Are you sure you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    @empty

                        <td scope="row max-w-[200px] " colspan="7"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-purple-100 border-b dark:bg-gray-800 dark:border-purple-700">
                            </p class="text-center">No fees payments found</p>
                        </td>



                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-admin-layout>
