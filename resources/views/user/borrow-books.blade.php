
<x-layouts.app :title="__('Borrow Books')">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Available Books to Borrow</h1>

        <div class="grid grid-cols-1 gap-4">
            @forelse($books as $book)
                <div class="p-4 bg-white dark:bg-zinc-800 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $book->title }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Author: {{ $book->author }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Published: {{ $book->published_year }}</p>
                        <p class="text-sm font-medium {{ $book->isAvailable() ? 'text-green-500' : 'text-red-500' }}">
                            {{ $book->isAvailable() ? 'Available' : 'Out' }}
                        </p>
                    </div>

                    @if($book->isAvailable())
                        <form action="{{ route('borrow.book', $book) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                Borrow
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">No books available.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
