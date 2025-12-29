<x-app-layout>
<h1>Borrowers</h1>

<a href="{{ route('borrowers.create') }}" style="margin-bottom:20px; display:inline-block;">Add New Borrower</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($borrowers as $borrower)
        <tr>
            <td>{{ $borrower->id }}</td>
            <td>{{ $borrower->name }}</td>
            <td>{{ $borrower->email }}</td>
            <td>{{ $borrower->phone }}</td>
            <td>
                <form action="{{ route('borrowers.destroy', $borrower->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this borrower?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No borrowers found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
</x-app-layout>
