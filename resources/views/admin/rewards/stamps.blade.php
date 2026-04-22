@extends('admin.layouts.admin')

@section('title','Stamp Rally')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Stamp Rally</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="orders-table-wrapper">
            <table class="table table-sm align-middle orders-table text-center">

                <thead>
                    <tr>
                        <th><span class="th-label">User</span></th>
                        <th><span class="th-label">Stamps</span></th>
                        <th><span class="th-label">Progress</span></th>
                        <th><span class="th-label">Status</span></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>

                            <td>
                                {{ trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) }}
                            </td>

                            <td>
                                {{ $user->stamp_count }}
                            </td>

                            <td>
                                {{ $user->stamp_count }} / 47
                            </td>

                            <td>
                                <span class="order-status {{ $user->status }}">
                                    {{ $user->status === 'completed' ? 'Completed' : 'In Progress' }}
                                </span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection