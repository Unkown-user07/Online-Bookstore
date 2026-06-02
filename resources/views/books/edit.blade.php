<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book — Online Bookstore</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 min-h-screen">

    <header class="bg-amber-800 text-white shadow-lg">
        <div class="max-w-2xl mx-auto px-6 py-4 flex items-center gap-3">
            <span class="text-3xl">📚</span>
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Online Bookstore</h1>
                <p class="text-amber-200 text-sm">Edit Book</p>
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6 py-8">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-amber-900 mb-6">✏️ Edit Book</h2>
            <form action="/books/{{ $book->id }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Author <span class="text-red-500">*</span></label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @error('author') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (₱) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $book->price) }}" step="0.01" min="0" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('description', $book->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image URL</label>
                    @if($book->image_url)
                        <img src="{{ $book->image_url }}" alt="Current cover"
                            class="w-20 h-28 object-cover rounded-lg mb-2 border border-gray-200">
                    @endif
                    <input type="url" name="image_url" value="{{ old('image_url', $book->image_url) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                        placeholder="https://example.com/cover.jpg">
                    @error('image_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="bg-amber-700 hover:bg-amber-800 text-white font-semibold px-6 py-2 rounded-lg transition">
                        Save Changes
                    </button>
                    <a href="/"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2 rounded-lg transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
