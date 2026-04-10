@extends('admin.layouts.admin')

@section('title','Inquiries')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Inquiries</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table align-middle orders-table text-center">
                <thead>
                    <tr>
                        <th><span class="th-label">Inquiry ID</span></th>
                        <th><span class="th-label">Name</span></th>
                        <th><span class="th-label">Email</span></th>
                        <th><span class="th-label">Subject</span></th>
                        <th><span class="th-label">Status</span></th>
                        <th><span class="th-label">Created at</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                    <tr onclick="window.location='{{ route('admin.inquiries.show', $inquiry->id) }}'">
                        <td>{{ $inquiry->id }}</td>
                        <td>{{ $inquiry->name }}</td>
                        <td>{{ $inquiry->email }}</td>
                        <td>{{ $inquiry->subject }}</td>
                        <td>
                            <span class="order-status status-{{ $inquiry->status }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </td>
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
