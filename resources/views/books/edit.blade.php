<x-layouts.app :title="__('Edit Book')">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Book</h1>

        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                <input type="text" name="title" id="title" value="{{ $book->title }}" placeholder="Enter book title" required
                    class="block w-full h-12 px-4 py-2 text-base text-gray-700 bg-white placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-gray-100 caret-blue-600"/>
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Author</label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" placeholder="Enter author name" required
                    class="block w-full h-12 px-4 py-2 text-base text-gray-700 bg-white placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-gray-100 caret-blue-600"/>
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Published Year</label>
                <input type="number" name="published_year" id="published_year" value="{{ $book->published_year }}" placeholder="e.g. 2024" required
                    class="block w-full h-12 px-4 py-2 text-base text-gray-700 bg-white placeholder-gray-400 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-gray-100 caret-blue-600"/>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
