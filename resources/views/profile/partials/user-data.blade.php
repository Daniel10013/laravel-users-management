<div class="max-w-xl flex flex-col gap-4">
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">Name:</h2>
        <x-text-input
            disabled
            class="mt-1 block w-3/4"
            value="{{ $user->name }}" />
    </div>
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">E-mail:</h2>
        <x-text-input
            disabled
            class="mt-1 block w-3/4"
            value="{{ $user->email }}" />
    </div>
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">Role:</h2>
        <x-text-input
            disabled
            class="mt-1 block w-3/4"
            value="{{ $user->role }}" />
    </div>
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 user-info">Created at:</h2>
        @php
            $datetimeString = $user->created_at;
            $date = \Carbon\Carbon::parse($datetimeString)->format('Y-m-d'); // Format to 'YYYY-MM-DD'
        @endphp
        <x-text-input
            disabled
            class="mt-1 block w-3/4"
            value="{{ $date }}" />
    </div>
</div>