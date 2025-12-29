<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Book
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">

        <form method="POST"
              action="{{ route('books.update', $book) }}"
              class="bg-white p-6 shadow rounded">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Title</label>
                <input type="text" name="title"
                       value="{{ $book->title }}"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">Author</label>
                <input type="text" name="author"
                       value="{{ $book->author }}"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">ISBN</label>
                <input type="text" name="isbn"
                       value="{{ $book->isbn }}"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">Quantity</label>
                <input type="number" name="quantity"
                       value="{{ $book->quantity }}"
                       class="w-full border rounded p-2"
                       min="0"
                       required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('books.index') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
