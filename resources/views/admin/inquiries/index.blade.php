@extends('admin.layouts.admin')

@section('title','Inquiries')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Inquiries</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">
                <thead>
                    <tr>
                        <th><span class="th-label">Name</span></th>
                        <th><span class="th-label">Email</span></th>
                        <th><span class="th-label">Message</span></th>
                        <th><span class="th-label">Created At</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                    <tr>
                        <td>{{ $inquiry->name }}</td>
                        <td>{{ $inquiry->email }}</td>
                        <td>{{ $inquiry->message }}</td>
                        <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="text-center mt-3">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-link">
        Home
    </a>
</div>

@endsection
