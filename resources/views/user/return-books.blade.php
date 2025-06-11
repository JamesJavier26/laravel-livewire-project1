<x-layouts.app :title="__('Return Books')">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Books You've Borrowed</h1>

        <div class="grid grid-cols-1 gap-4">
            @forelse($borrowedBooks as $borrowing)
                <div class="p-4 bg-white dark:bg-zinc-800 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $borrowing->book->title }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Author: {{ $borrowing->book->author }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Published: {{ $borrowing->book->published_year }}</p>
                        <p class="text-sm text-yellow-500 font-medium">Borrowed: {{ $borrowing->borrowed_at->format('M d, Y') }}</p>
                    </div>

                    <form action="{{ route('return.book', $borrowing->book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                            Return
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">You have no currently borrowed books.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
