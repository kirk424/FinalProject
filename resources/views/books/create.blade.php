<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Add New Book
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">

        <form method="POST" action="{{ route('books.store') }}"
              class="bg-white p-6 shadow rounded">
            @csrf

            <div class="mb-4">
                <label class="block">Title</label>
                <input type="text" name="title"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">Author</label>
                <input type="text" name="author"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">ISBN</label>
                <input type="text" name="isbn"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block">Quantity</label>
                <input type="number" name="quantity"
                       class="w-full border rounded p-2"
                       min="0"
                       required>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('books.index') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
