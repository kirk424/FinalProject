<x-app-layout>
<h1>Borrow Records</h1>

<h2>New Borrow</h2>
<form action="{{ route('borrows.store') }}" method="POST">
    @csrf
    <label>Borrower:</label>
    <select name="borrower_id" required>
        <option value="">Select Borrower</option>
        @foreach(\App\Models\Borrower::all() as $borrower)
            <option value="{{ $borrower->id }}">{{ $borrower->name }}</option>
        @endforeach
    </select><br><br>

    <label>Book:</label>
    <select name="book_id" required>
        <option value="">Select Book</option>
        @foreach(\App\Models\Book::where('quantity', '>', 0)->get() as $book)
            <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->quantity }} available)</option>
        @endforeach
    </select><br><br>

    <button type="submit">Borrow Book</button>
</form>

<hr>

<h2>Borrow Records</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Borrower</th>
            <th>Book</th>
            <th>Borrowed At</th>
            <th>Returned At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($borrows as $borrow)
        <tr>
            <td>{{ $borrow->id }}</td>
            <td>{{ $borrow->borrower->name }}</td>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ $borrow->borrowed_at }}</td>
            <td>{{ $borrow->returned_at ?? 'Not returned' }}</td>
            <td>
                @if(!$borrow->returned_at)
                <form action="{{ route('borrows.return', $borrow->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PUT')
                    <button type="submit">Return Book</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No borrow records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</x-app-layout>
