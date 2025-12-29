<x-app-layout>
<h1>Add Borrower</h1>

<form action="{{ route('borrowers.store') }}" method="POST">
    @csrf
    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

    <button type="submit">Save</button>
</form>

<a href="{{ route('borrowers.index') }}">Back to Borrowers</a>
</x-app-layout>
