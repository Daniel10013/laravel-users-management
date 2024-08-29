<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hello! <span class="dark:text-gray-400">{{$userName}}</span> {{ __('Check out the registered users!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="alert alert-success">
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <a href="{{route('create-page')}}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="background-color: green !important">
                        Add new user
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(empty($users) != true)
                    <table class="w-full">
                        <thead class="">
                            <tr class="w-auto border-b">
                                <th class="w-64 text-lg">Name</th>
                                <th class="w-64 text-lg">Email</th>
                                <th class="w-28 text-lg">Role</th>
                                <th class="w-28 text-lg">Created At</th>
                                <th class="w-28 text-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($users as $user)
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">{{ $user->role }}</td>
                                @php
                                $datetimeString = $user->created_at;
                                $date = \Carbon\Carbon::parse($datetimeString)->format('Y-m-d'); // Format to 'YYYY-MM-DD'
                                @endphp
                                <td class="py-2 px-4">{{ $date }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{route('render-details-page', $user->id)}}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="background-color: #2727bd !important">
                                        Account Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2>Nothing to See Here</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>