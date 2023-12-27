<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 p-4 space-y-6">
        <div class="border-l-4 border-purple-300 flex justify-between">
            <span class="p-4 uppercase font-semibold "> Bus Levies </span>

            <div class="flex items-center">
                <a href="{{ route('admin.buslevies.create') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    New Payment</a>
            </div>
        </div>
        <div class="relative overflow-x-auto rounded-lg shadow-purple-200 shadow-md">

            <table id="busleviesTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs  text-gray-700 uppercase  bg-purple-300 dark:bg-purple-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Student
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Date of payment
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Receipt Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Term
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Year
                        </th>
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
                    @forelse ($buslevies as $buslevy)
                        <tr class="bg-purple-100 border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $buslevy->student->name ?? '' }} <br> {{ $buslevy->student->surname ?? '' }}
                            </td>

                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $buslevy->date_of_payment }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $buslevy->receipt_number }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $buslevy->term }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $buslevy->academic_year }}
                            </td>

                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${{ $buslevy->amount }}
                            </td>

                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${{ $buslevy->balance }}
                            </td>




                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex space-x-2">
                                    <a href=" {{ route('admin.buslevies.show', $buslevy->id) }}"
                                        class="px-4 py-2 bg-cyan-500  text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">View</a>

                                    <a href="{{ route('admin.buslevies.edit', $buslevy->id) }}"
                                        class="px-4 py-2 bg-purple-500  text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">Edit</a>
                                    <form
                                        class="text-white px-4 py-2 bg-pink-500 rounded-full cursor-pointer hover:bg-white hover:text-gray-800 hover:border hover:border-pink-400"
                                        method="POST" action="{{ route('admin.buslevies.destroy', $buslevy->id) }}"
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
                                </p class="text-center">No Bus Levy payments found</p>
                            </td>

                            @if ($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
