<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Books
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">

        <div class="mb-4">
            <a href="{{ route('books.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add Book
            </a>
        </div>

        <div class="bg-white shadow rounded">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3">Title</th>
                        <th class="p-3">Author</th>
                        <th class="p-3">ISBN</th>
                        <th class="p-3">Quantity</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                        <tr class="border-t">
                            <td class="p-3">{{ $book->title }}</td>
                            <td class="p-3">{{ $book->author }}</td>
                            <td class="p-3">{{ $book->isbn }}</td>
                            <td class="p-3">{{ $book->quantity }}</td>
                            <td class="p-3 flex gap-2">
    <a href="{{ route('books.edit', $book) }}"
       class="bg-yellow-500 text-white px-3 py-1 rounded">
        Edit
    </a>

    <form method="POST"
          action="{{ route('books.destroy', $book) }}">
        @csrf
        @method('DELETE')
        <button class="bg-red-600 text-white px-3 py-1 rounded">
            Delete
        </button>
    </form>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
