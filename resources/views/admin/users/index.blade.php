@extends('admin.layouts.admin')

@section('title','Users')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Users</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table users-table text-center">
                <thead>
                    <tr>
                        <th><span class="th-label">User ID</span></th>
                        <th><span class="th-label">Name</span></th>
                        <th><span class="th-label">Username</span></th>
                        <th><span class="th-label">Rank</span></th>
                        <th><span class="th-label">Date</span></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr onclick="window.location='{{ route('admin.users.show', $user->id) }}'">
                        <td>#{{ $user->id }}</td>

                        <td>
                            {{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: 'No Name' }}
                        </td>

                        <td>
                            {{ $user->user_name ?? '-' }}
                        </td>

                        <td>
                            <span class="order-status {{ strtolower($user->rank ?? 'bronze') }}">
                                {{ ucfirst($user->rank ?? 'bronze') }}
                            </span>
                        </td>

                        <td>
                            {{ $user->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $users->links() }}
</div>

<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>

@endsection