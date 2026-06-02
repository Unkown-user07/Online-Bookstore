<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen">

    <header class="bg-amber-800 text-white shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-3xl">📚</span>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Online Bookstore</h1>
                    <p class="text-amber-200 text-sm">Admin Dashboard</p>
                </div>
            </div>
            <a href="/books/create"
                class="bg-white text-amber-800 font-semibold px-4 py-2 rounded-lg hover:bg-amber-100 transition text-sm">
                ➕ Add Book
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-8 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-amber-900">
                📖 Book Catalog
                <span class="text-sm font-normal text-gray-500 ml-1">({{ $books->count() }} titles)</span>
            </h2>
        </div>

        @if($books->isEmpty())
            <div class="bg-white rounded-2xl shadow-md p-16 text-center text-gray-400">
                <p class="text-6xl mb-4">📭</p>
                <p class="text-lg mb-4">No books yet.</p>
                <a href="/books/create" class="bg-amber-700 text-white px-6 py-2 rounded-lg hover:bg-amber-800 transition">
                    Add Your First Book
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($books as $book)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col">
                    @if($book->image_url)
                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-amber-100 flex items-center justify-center text-5xl">📗</div>
                    @endif
                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-gray-900 text-base leading-tight">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $book->author }}</p>
                        @if($book->description)
                            <p class="text-xs text-gray-400 mt-2 line-clamp-2 flex-1">{{ $book->description }}</p>
                        @endif
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-amber-700 font-bold text-lg">₱{{ number_format($book->price, 2) }}</span>
                            <div class="flex gap-2">
                                <a href="/books/{{ $book->id }}/edit"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium px-3 py-1 rounded-lg transition">
                                    Edit
                                </a>
                                <form action="/books/{{ $book->id }}" method="POST"
                                    onsubmit="return confirm('Delete \'{{ addslashes($book->title) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium px-3 py-1 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </main>

</body>
</html>
