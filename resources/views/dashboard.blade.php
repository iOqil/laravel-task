<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->role->name == 'manager')
                        <h1 class="text-xl">Received Applications</h1>

                        <!-- component -->
                        <!-- This is an example component -->
                        @if ($applications->count() > 0)
                            @foreach ($applications as $application)
                                <div
                                    class="mt-4 rounded-xl border dark:border-neutral-700 p-5 shadow-md bg-white dark:bg-gray-800">
                                    <div
                                        class="flex w-full items-center justify-between border-b dark:border-neutral-700 pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                            </div>
                                            <div class="text-lg font-bold text-slate-700 dark:text-slate-200">
                                                {{ $application->user->name }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button
                                                class="rounded-2xl border dark:border-neutral-700 bg-neutral-100 dark:bg-neutral-700 px-3 py-1 text-xs font-semibold">
                                                {{ $application->id }}
                                            </button>
                                            <div class="text-xs text-neutral-500">
                                                {{ $application->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-6">
                                        <div class="mb-3 text-xl font-bold">
                                            {{ $application->subject }}
                                        </div>
                                        <div class="text-sm text-neutral-600 dark:text-neutral-50"
                                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; text-transform: capitalize;">
                                            {{ $application->message }}
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between text-slate-500">
                                            <div class="flex space-x-4 md:space-x-8">
                                                <a href="mailto:{{ $application->user->email }}">
                                                    {{ $application->user->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4">
                                {{ $applications->links() }}
                            </div>
                        @else
                            <p class="text-gray-500">No applications found.</p>
                        @endif
                    @else
                        <!-- component -->
                        <div class="bg-gray-100">
                            <div
                                class="header bg-white h-16 px-10 py-8 border-b-2 border-gray-200 flex items-center justify-between">
                                <div class="flex items-center space-x-2 text-gray-400">
                                    Submit your Applications
                                </div>
                            </div>
                            <div class="header my-3 h-12 px-10 flex items-center justify-between">
                                <h1 class="font-medium text-gray-800 text-2xl">All Applications</h1>
                                @if(session()->has('error'))
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                        role="alert">
                                        <strong class="font-bold">Error!</strong>
                                        <span class="block sm:inline">{{ session('error') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col mx-3 mt-6 lg:flex-row">
                                <div class="w-full lg:w-1/3 m-1">
                                    <form action="{{ route('applications.store') }}" enctype="multipart/form-data"
                                        class="w-full bg-white shadow-md p-6" method="POST">
                                        @csrf
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-full px-3 mb-6">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2"
                                                    htmlFor="category_name">Subject</label>
                                                <input
                                                    class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#98c01d]"
                                                    type="text" name="subject" placeholder="Subject" required />
                                            </div>
                                            <div class="w-full px-3 mb-6">
                                                <textarea textarea rows="4"
                                                    class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none focus:border-[#98c01d]"
                                                    type="text" name="message" required> </textarea>
                                            </div>
                                            <div class="w-full px-3 mb-8">
                                                <label
                                                    class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center justify-center rounded-xl border-2 border-dashed border-green-400 bg-white p-6 text-center"
                                                    htmlFor="dropzone-file">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-10 w-10 text-green-800" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>

                                                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">
                                                        Application File</h2>

                                                    <p class="mt-2 text-gray-500 tracking-wide">Upload or drag & drop
                                                        your file PDF, DOC, PPT, XLS </p>

                                                    <input id="dropzone-file" type="file" class="hidden"
                                                        name="file"
                                                        accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                                                </label>
                                            </div>

                                            <div class="w-full md:w-full px-3 mb-6">
                                                <button
                                                    class="appearance-none block w-full bg-green-700 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-3 leading-tight hover:bg-green-600 focus:outline-none focus:bg-white focus:border-gray-500">
                                                    Send Application
                                                </button>
                                            </div>



                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="w-full lg:w-2/3 m-1 bg-white shadow-lg text-lg rounded-sm border border-gray-200">
                                    <div class="overflow-x-auto rounded-lg p-3">
                                        <table class="table-auto w-full">
                                            <thead
                                                class="text-sm font-semibold uppercase text-gray-800 bg-gray-50 mx-auto">
                                                <tr>
                                                    <th></th>
                                                    <th><svg xmlns="http://www.w3.org/2000/svg"
                                                            class="fill-current w-5 h-5 mx-auto">
                                                            <path
                                                                d="M6 22h12a2 2 0 0 0 2-2V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm7-18 5 5h-5V4zm-4.5 7a1.5 1.5 0 1 1-.001 3.001A1.5 1.5 0 0 1 8.5 11zm.5 5 1.597 1.363L13 13l4 6H7l2-3z">
                                                            </path>
                                                        </svg></th>
                                                    <th class="p-2">
                                                        <div class="font-semibold">Application</div>
                                                    </th>
                                                    <th class="p-2">
                                                        <div class="font-semibold text-left">Description</div>
                                                    </th>
                                                    <th class="p-2">
                                                        <div class="font-semibold text-center">Action</div>
                                                    </th>
                                                </tr>
                                                @foreach ($clieant_applications as $application)
                                                    <tr>
                                                        <td>{{ $application->id }}</td>
                                                        <td>
                                                            @if ($application->file_url)
                                                                <a href="{{ asset('storage/' . $application->file) }}"
                                                                    target="_blank"
                                                                    class="text-blue-600 hover:underline">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        strokeWidth={1.5} stroke="currentColor"
                                                                        className="size-6">
                                                                        <path strokeLinecap="round"
                                                                            strokeLinejoin="round"
                                                                            d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                                    </svg>

                                                                </a>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" strokeWidth={1.5}
                                                                    stroke="currentColor" className="size-6">
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                                </svg>
                                                            @endif
                                                        </td>
                                                        <td>{{ $application->subject }}</td>
                                                        <td
                                                            style="width: 300px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; text-transform: capitalize;">
                                                            {{ $application->message }}</td>
                                                        <td class="p-2">
                                                            <div class="flex justify-center">
                                                                <a href="#"
                                                                    class="rounded-md hover:bg-green-100 text-green-600 p-2 flex justify-between items-center">
                                                                    <span>
                                                                        <FaEdit class="w-4 h-4 mr-1" />
                                                                    </span> Edit
                                                                </a>
                                                                <button
                                                                    class="rounded-md hover:bg-red-100 text-red-600 p-2 flex justify-between items-center">
                                                                    <span>
                                                                        <FaTrash class="w-4 h-4 mr-1" />
                                                                    </span> Delete
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
