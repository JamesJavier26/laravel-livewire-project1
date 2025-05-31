<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manage Books</h1>
        <a href="{{ route('books.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
            + Create Book
        </a>
    </div>

    <!-- {{-- Live-updating time display --}}
    <div wire:poll.1s class="mb-4 text-green-600 text-sm">
        Current time: {{ now()->format('H:i:s') }}
    </div> -->

    <div wire:poll.1s class="bg-white dark:bg-zinc-800 shadow rounded-lg overflow-hidden">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 dark:bg-zinc-700">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">ID</th>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">Title</th>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">Author</th>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">Published</th>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">Status</th>
                    <th class="px-4 py-2 font-semibold text-gray-700 dark:text-white">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach($books as $book)
                <tr>
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $book->id }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $book->title }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $book->author }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $book->published_year }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $book->isAvailable() ? 'Available' : 'Out' }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($books->isEmpty())
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        No books found.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
