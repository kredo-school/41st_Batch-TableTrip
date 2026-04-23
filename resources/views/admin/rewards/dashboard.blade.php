@extends('admin.layouts.admin')

@section('title', 'Rewards Dashboard')

@section('content')

<div class="rewards-dashboard">
    <h2 class="dashboard-title mt-4 mb-4">Rewards Dashboard</h2>

    <!-- Top KPI Cards -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card rewards-kpi-card h-100">
                <div class="card-body">
                    <p class="rewards-kpi-label">Total Points Issued</p>
                    <p class="rewards-kpi-value">{{ number_format($totalPointsIssued ?? 0) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card rewards-kpi-card h-100">
                <div class="card-body">
                    <p class="rewards-kpi-label">Reward Users</p>
                    <p class="rewards-kpi-value">{{ number_format($rewardUsers ?? 0) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card rewards-kpi-card h-100">
                <div class="card-body">
                    <p class="rewards-kpi-label">Welcome Coupons Issued</p>
                    <p class="rewards-kpi-value">{{ number_format($welcomeCouponsIssued ?? 0) }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card rewards-kpi-card h-100">
                <div class="card-body">
                    <p class="rewards-kpi-label">Stamp Rally Completed</p>
                    <p class="rewards-kpi-value">{{ number_format($stampRallyCompleted ?? 0) }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Section -->
    <div class="row g-4">

        <!-- Membership Rank -->
        <div class="col-xl-6 col-lg-12">
            <div class="card rewards-section-card h-100">
                <div class="card-body">
                    <div class="rewards-card-header">
                        <h3 class="rewards-section-title mb-0">Membership Rank</h3>
                    </div>

                    <p class="membership-rank-note">
                        All registered users start at Bronze and receive a 10% welcome coupon.
                    </p>

                    @php
                        $totalUsers = max(
                            ($bronzeCount ?? 0) + ($silverCount ?? 0) + ($goldCount ?? 0) + ($diamondCount ?? 0),
                            1
                        );

                        $bronzePercent = round((($bronzeCount ?? 0) / $totalUsers) * 100);
                        $silverPercent = round((($silverCount ?? 0) / $totalUsers) * 100);
                        $goldPercent = round((($goldCount ?? 0) / $totalUsers) * 100);
                        $diamondPercent = round((($diamondCount ?? 0) / $totalUsers) * 100);
                    @endphp

                    <div class="rank-list">

                        <div class="rank-row">
                            <div class="rank-info">
                                <span class="rank-name bronze">🥉 Bronze</span>
                                <span class="rank-users">{{ number_format($bronzeCount ?? 0) }} users</span>
                                <span class="rank-percent">{{ $bronzePercent }}%</span>
                            </div>
                            <div class="rank-progress">
                                <div class="rank-progress-fill bronze-bar" style="width: {{ $bronzePercent }}%;"></div>
                            </div>
                        </div>

                        <div class="rank-row">
                            <div class="rank-info">
                                <span class="rank-name silver">🥈 Silver</span>
                                <span class="rank-users">{{ number_format($silverCount ?? 0) }} users</span>
                                <span class="rank-percent">{{ $silverPercent }}%</span>
                            </div>
                            <div class="rank-progress">
                                <div class="rank-progress-fill silver-bar" style="width: {{ $silverPercent }}%;"></div>
                            </div>
                        </div>

                        <div class="rank-row">
                            <div class="rank-info">
                                <span class="rank-name gold">🥇 Gold</span>
                                <span class="rank-users">{{ number_format($goldCount ?? 0) }} users</span>
                                <span class="rank-percent">{{ $goldPercent }}%</span>
                            </div>
                            <div class="rank-progress">
                                <div class="rank-progress-fill gold-bar" style="width: {{ $goldPercent }}%;"></div>
                            </div>
                        </div>

                        <div class="rank-row mb-0">
                            <div class="rank-info">
                                <span class="rank-name diamond">💎 Diamond</span>
                                <span class="rank-users">{{ number_format($diamondCount ?? 0) }} users</span>
                                <span class="rank-percent">{{ $diamondPercent }}%</span>
                            </div>
                            <div class="rank-progress">
                                <div class="rank-progress-fill diamond-bar" style="width: {{ $diamondPercent }}%;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Point History -->
        <div class="col-xl-6 col-lg-12">
            <div class="card rewards-section-card h-100">
                <div class="card-body">
                    <div class="rewards-card-header recent-history-header">
                        <h3 class="rewards-section-title mb-0">Recent Point History</h3>
                        <a href="{{ route('admin.rewards.points.index') }}" class="view-all-link">View All</a>
                    </div>

                    <div class="recent-history-table-wrapper">
                        <table class="table align-middle rewards-history-table">
                            <thead>
                                <tr>
                                    <th><span class="th-label">User</span></th>
                                    <th><span class="th-label">Points</span></th>
                                    <th><span class="th-label">Type</span></th>
                                    <th><span class="th-label">Date</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPointHistories ?? [] as $history)
                                    <tr>
                                        <td>{{ $history->user->name ?? '—' }}</td>
                                        <td>{{ number_format($history->points) }}</td>
                                        <td class="text-capitalize">{{ $history->type }}</td>
                                        <td>{{ $history->created_at ? $history->created_at->format('M d, Y') : '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No point history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection