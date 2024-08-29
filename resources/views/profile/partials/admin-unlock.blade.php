@if(session('error'))
<div class="p-2 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" style="border: solid 1px #710000; background: #a52a2a52;" role="alert">
    <span class="font-medium">{{ session('delete-error') }}</span>
</div>
@endif
@if(session('success'))
<div class="p-2 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" style="border: solid 1px #0c5c21; background: #4da36794;" role="alert">
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

@if($status == "Blocked")
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full">
    <div class="max-w-xl">
        <section class="space-y-6">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 w-full">
                    {{ __('Activate Account') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 w-full">
                    {{ __('Ops! Looks like this account is locked. You can activate it again by clicking on the button bellow!') }}
                </p>
            </header>
            <form method="post" action="{{ route('details-page.activateUser', $user->id) }}">
                @csrf
                @method('patch')
                <input type="hidden" name="id-to-activate" value="{{$user->id}}">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" style="background-color: green !important">
                    Unlock Account!
                </button>
            </form>
        </section>
    </div>
</div>
@endif