<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-x1 text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Create new user' }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 container">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if(session('error'))
                    <div class="p-2 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" style="border: solid 1px #710000; background: #a52a2a52;" role="alert">
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif
                @if(session('success'))
                    <div class="p-2 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" style="border: solid 1px #0c5c21; background: #4da36794;" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.create-user') }}">
                    @csrf

                    <div class="max-w-xl flex flex-col gap-4">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info required">Name:</h2>
                            <x-text-input class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info required">E-mail:</h2>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info required">Password:</h2>
                            <x-text-input class="mt-1 block w-full" type="password" type="password"
                            name="password"
                            required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info required">Confirm Password:</h2>
                            <x-text-input class="mt-1 block w-full" type="password" 
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">Role:</h2>
                            <select name="user-role" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                                <option value="regular">Regular</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div>
                            <x-primary-button class="">
                                {{ __('Create User') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>