<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'vumbaview@web') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class=" p-4 space-y-6">
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10 pb-10 space-y-6">
                <div class="border-l-4 border-purple-300 flex justify-between">
                    <span class="p-4 uppercase font-semibold "> vumba view academy Uniforms Invoice </span>

                    <div class="flex items-center">
                        <a href="{{ route('admin.uniforms.index') }}"
                            class="p-2 px-4 bg-purple-500 text-white cursor-pointer rounded-full hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400">
                            Back</a>
                    </div>
                </div>


                <!-- Grid -->
                <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-2xl font-semibold text-purple-800 dark:text-gray-200">Invoice</h2>
                        <span class="text-sm">Single payment</span>
                    </div>
                    <!-- Col -->

                    <div class="inline-flex gap-x-2">
                        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-full border font-medium bg-white text-gray-700 shadow-sm align-middle border-purple-300 hover:bg-purple-300 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                            href="#" print>
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                            Invoice PDF
                        </a>
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-purple-500 text-white hover:bg-white hover:text-gray-800 hover:border hover:border-purple-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="#">
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>
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
                                    <a class="inline-flex items-center gap-x-1.5 text-purple-600 decoration-2 hover:underline font-medium"
                                        href="#">
                                        {{ $uniform->student->name ?? 'None' }}
                                        {{ $uniform->student->surname ?? 'None' }}
                                    </a>
                                </dd>
                            </dl>

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                    Student ID:
                                </dt>
                                <dd class="text-gray-800 dark:text-gray-200">
                                    <a class="inline-flex items-center gap-x-1.5 text-purple-600 decoration-2 hover:underline font-medium"
                                        href="#">
                                        {{ $uniform->student->id ?? 'None' }} </a>
                                </dd>
                            </dl>

                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                    Physical Address:
                                </dt>
                                <dd class="font-medium text-gray-800 dark:text-gray-200">

                                    {{ $address ?? 'None' }}

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
                                    {{ $uniform->receipt_number }}
                                </dd>
                            </dl>
                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                    Billing method:
                                </dt>
                                <dd class="font-medium text-gray-800 dark:text-gray-200">
                                    {{ $uniform->bill_type }}
                                </dd>
                            </dl>
                            <dl class="grid sm:flex gap-x-3 text-sm">
                                <dt class="min-w-[150px] max-w-[200px] text-gray-500">
                                    Billing period:
                                </dt>
                                <dd class="font-medium text-gray-800 dark:text-gray-200">
                                    Term {{ $uniform->term }} of {{ $uniform->academic_year }}
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
                        <div class="text-start text-xs font-medium text-gray-500 uppercase">Date Of Payment</div>
                        <div class="text-end text-xs font-medium text-gray-500 uppercase">Amount</div>
                    </div>

                    <div class="hidden sm:block border-b border-gray-200 dark:border-gray-700"></div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                            <p class="font-medium text-gray-800 dark:text-gray-200">Uniforms</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Date OF Payment</h5>
                            <p class="text-gray-800 dark:text-gray-200">{{ $uniform->date_of_payment }}</p>
                        </div>

                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                            <p class="sm:text-end text-gray-800 dark:text-gray-200">${{ $uniform->amount }}</p>
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
                                <dt class="col-span-3 text-gray-500">Total:</dt>
                                <dd
                                    class="col-span-2 font-medium text-gray-800 dark:text-gray-200 border-b-4 border-black">
                                    ${{ $uniform->amount }}
                                </dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3 text-sm ">
                                <dt class="col-span-3 text-gray-500">Due balance:</dt>
                                <dd
                                    class="col-span-2 font-medium text-gray-800 dark:text-gray-200 border-b-4 border-black">
                                    ${{ $uniform->balance }}
                                </dd>
                            </dl>
                        </div>
                        <!-- End Grid -->
                    </div>
                </div>


                <!-- End Flex -->
            </div>
        </div>

    </div>
</body>

</html>
