@props(['user', 'class' => ''])

@if($user->avatar)
    <img
        src="{{ Storage::url($user->avatar) }}"
        alt="Avatar"
        class="{{ $class }} rounded-full object-cover border-2 border-blue-500"
    >
@else
    <div class="{{ $class }} bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
@endif
