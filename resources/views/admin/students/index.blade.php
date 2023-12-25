<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class=" p-4 space-y-6">
        <div class="border-l-4 border-purple-300 flex justify-between">
            <span class="p-4 uppercase font-semibold "> Students </span>

            <div class="flex items-center">
                <a href="{{ route('admin.students.create') }}"
                    class="p-2 px-4  bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                    New Student</a>
            </div>
        </div>
        <div class="relative overflow-x-auto rounded-lg shadow-purple-200 shadow-md">
            <table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs  text-gray-700 uppercase  bg-purple-300 dark:bg-purple-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Surname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Birth Entry No
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Date Of Birth
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date Of Enrolment
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Student Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Health Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="bg-purple-100 border-b dark:bg-gray-800 dark:border-purple-700">

                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->id }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->name }}
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->surname }}
                            </td>
                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->birthEntryNumber }}
                            </td>

                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->dateOfBirth }}

                            </td>
                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->dateOfEnrolment }}
                            </td>
                            <td scope="row max-w-[200px]"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $student->studentType }}
                            </td>
                            <td scope="row max-w-[200px]"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $student->health_status ?? 'None'}}
                        </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex space-x-2">
                                    <a href=" {{ route('admin.students.show', $student->id) }}"
                                        class="px-4 py-2 bg-cyan-500  text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">View</a>
                                    <a href=" {{ route('admin.students.edit', $student->id) }}"
                                        class="px-4 py-2 bg-purple-500  text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">Edit</a>
                                    <form
                                        class="text-white px-4 py-2 bg-pink-500 rounded-full cursor-pointer hover:bg-white hover:text-gray-800 hover:border hover:border-pink-400"
                                        method="POST" action="{{ route('admin.students.destroy', $student->id) }}"
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
                                </p class="text-center">No students found</p>
                            </td>
                   </tr>
                    @endforelse
                </tbody>
            </table>
               {{-- <!-- Invoice -->
<div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
    <!-- Grid -->
    <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
      <div>
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Invoice</h2>
      </div>
      <!-- Col -->

      <div class="inline-flex gap-x-2">
        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" href="#">
          <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
          Invoice PDF
        </a>
        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
          <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
          Print
        </a>
      </div>
      <!-- Col -->
    </div>
    <!-- End Grid -->

    <!-- Grid -->
    <div class="grid md:grid-cols-2 gap-3">
      <div>
        <div class="grid space-y-3">
          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Billed to:
            </dt>
            <dd class="text-gray-800 dark:text-gray-200">
              <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium" href="#">
                sara@site.com
              </a>
            </dd>
          </dl>

          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Billing details:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              <span class="block font-semibold">Sara Williams</span>
              <address class="not-italic font-normal">
                280 Suzanne Throughway,<br>
                Breannabury, OR 45801,<br>
                United States<br>
              </address>
            </dd>
          </dl>

          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Shipping details:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              <span class="block font-semibold">Sara Williams</span>
              <address class="not-italic font-normal">
                280 Suzanne Throughway,<br>
                Breannabury, OR 45801,<br>
                United States<br>
              </address>
            </dd>
          </dl>
        </div>
      </div>
      <!-- Col -->

      <div>
        <div class="grid space-y-3">
          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Invoice number:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              ADUQ2189H1-0038
            </dd>
          </dl>

          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Currency:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              USD - US Dollar
            </dd>
          </dl>

          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Due date:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              10 Jan 2023
            </dd>
          </dl>

          <dl class="grid sm:flex gap-x-3 text-sm">
            <dt class="min-w-[150px] max-w-[200px] text-gray-500">
              Billing method:
            </dt>
            <dd class="font-medium text-gray-800 dark:text-gray-200">
              Send invoice
            </dd>
          </dl>
        </div>
      </div>
      <!-- Col -->
    </div>
    <!-- End Grid -->

    <!-- Table -->
    <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4 dark:border-gray-700">
      <div class="hidden sm:grid sm:grid-cols-5">
        <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase">Item</div>
        <div class="text-start text-xs font-medium text-gray-500 uppercase">Qty</div>
        <div class="text-start text-xs font-medium text-gray-500 uppercase">Rate</div>
        <div class="text-end text-xs font-medium text-gray-500 uppercase">Amount</div>
      </div>

      <div class="hidden sm:block border-b border-gray-200 dark:border-gray-700"></div>

      <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
        <div class="col-span-full sm:col-span-2">
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
          <p class="font-medium text-gray-800 dark:text-gray-200">Design UX and UI</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
          <p class="text-gray-800 dark:text-gray-200">1</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
          <p class="text-gray-800 dark:text-gray-200">5</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
          <p class="sm:text-end text-gray-800 dark:text-gray-200">$500</p>
        </div>
      </div>

      <div class="sm:hidden border-b border-gray-200 dark:border-gray-700"></div>

      <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
        <div class="col-span-full sm:col-span-2">
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
          <p class="font-medium text-gray-800 dark:text-gray-200">Web project</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
          <p class="text-gray-800 dark:text-gray-200">1</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
          <p class="text-gray-800 dark:text-gray-200">24</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
          <p class="sm:text-end text-gray-800 dark:text-gray-200">$1250</p>
        </div>
      </div>

      <div class="sm:hidden border-b border-gray-200 dark:border-gray-700"></div>

      <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
        <div class="col-span-full sm:col-span-2">
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
          <p class="font-medium text-gray-800 dark:text-gray-200">SEO</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
          <p class="text-gray-800 dark:text-gray-200">1</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
          <p class="text-gray-800 dark:text-gray-200">6</p>
        </div>
        <div>
          <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
          <p class="sm:text-end text-gray-800 dark:text-gray-200">$2000</p>
        </div>
      </div>
    </div>
    <!-- End Table -->

    <!-- Flex -->
    <div class="mt-8 flex sm:justify-end">
      <div class="w-full max-w-2xl sm:text-end space-y-2">
        <!-- Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
          <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
            <dt class="col-span-3 text-gray-500">Subotal:</dt>
            <dd class="col-span-2 font-medium text-gray-800 dark:text-gray-200">$2750.00</dd>
          </dl>

          <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
            <dt class="col-span-3 text-gray-500">Total:</dt>
            <dd class="col-span-2 font-medium text-gray-800 dark:text-gray-200">$2750.00</dd>
          </dl>

          <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
            <dt class="col-span-3 text-gray-500">Tax:</dt>
            <dd class="col-span-2 font-medium text-gray-800 dark:text-gray-200">$39.00</dd>
          </dl>

          <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
            <dt class="col-span-3 text-gray-500">Amount paid:</dt>
            <dd class="col-span-2 font-medium text-gray-800 dark:text-gray-200">$2789.00</dd>
          </dl>

          <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
            <dt class="col-span-3 text-gray-500">Due balance:</dt>
            <dd class="col-span-2 font-medium text-gray-800 dark:text-gray-200">$0.00</dd>
          </dl>
        </div>
        <!-- End Grid -->
      </div>
    </div>
    <!-- End Flex -->
  </div>
  <!-- End Invoice --> --}}

        </div>
    </div>

</x-admin-layout>
