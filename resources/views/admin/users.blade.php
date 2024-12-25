<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Users</title>
<style>
    .table th, .table td {
    vertical-align: middle;
}

.table td {
    font-size: 14px;
}

.table th {
    font-size: 16px;
    text-align: center;
}

.btn {
    padding: 8px 12px;
    font-size: 14px;
}



</style>
</head>
<body>
    <x-bootstrap/>
    @extends('layouts.adminNav') 
@section('content')
<div class="container d-flex justify-content-center ">
    <div class="w-100">
        <h2 class="mb-4 text-center mt-4">All  Users</h2>
        @if ($users->isEmpty())
        <div class="alert alert-warning">No users found.</div>
        @else
        <table class="table table-striped table-hover table-bordered shadow-sm">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="d-flex justify-content-center">
                        
                
                        <!-- Delete form -->
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="special-button-red" title="Delete User" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection

</body>
</html>