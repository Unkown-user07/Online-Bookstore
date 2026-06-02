<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tasks</h1>

        {{-- Create form --}}
        <form method="POST" action="/tasks" class="flex gap-2 mb-8">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="New task..."
                required
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Add
            </button>
        </form>

        {{-- Task list --}}
        <ul class="space-y-2">
            @forelse ($tasks as $task)
                <li class="flex items-center justify-between bg-white rounded-lg px-4 py-3 shadow-sm">
                    {{-- Toggle completion --}}
                    <form method="POST" action="/tasks/{{ $task->id }}" class="flex items-center gap-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-5 h-5 rounded border-2 flex items-center justify-center
                            {{ $task->is_completed ? 'bg-green-500 border-green-500' : 'border-gray-400' }}">
                            @if ($task->is_completed)
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            @endif
                        </button>
                        <span class="text-sm text-gray-700 {{ $task->is_completed ? 'line-through text-gray-400' : '' }}">
                            {{ $task->title }}
                        </span>
                    </form>

                    {{-- Delete --}}
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </li>
            @empty
                <li class="text-center text-gray-400 text-sm py-8">No tasks yet. Add one above.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>
