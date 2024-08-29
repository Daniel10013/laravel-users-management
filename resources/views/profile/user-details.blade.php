<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-x1 text-gray-800 dark:text-gray-200 leading-tight">
            User <span class="dark:text-gray-400">{{$user->name}} </span>details page
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 container">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('profile.partials.user-data')
                <div class="max-w-xl flex flex-col gap-4 mt-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">Account Status:</h2>
                        @php
                        $status = $user->account_locked == 1 ? "Blocked" : "Active";
                        @endphp
                        <x-text-input
                            disabled
                            class="mt-1 block w-3/4"
                            value="{{ $status }}" />
                    </div>

                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.admin-delete')
                </div>
            </div>
            @include('profile.partials.admin-unlock')
           
        </div>
    </div>
</x-app-layout>