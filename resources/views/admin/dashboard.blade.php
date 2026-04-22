@extends('admin.layouts.admin')

@section('title','Dashboard')

@section('content')

<h2 class="dashboard-title mt-4 mb-4">Dashboard</h2>

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">
        <a href="/admin/restaurants?status=pending" class="dashboard-link">
            <div class="card dashboard-card-small">
                <div class="card-body">
                    <p class="card-label">Restaurant<br>Applications</p>
                    <p class="card-text fs-3 dashboard-number">{{ $reportedReviewsCount }}</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="/admin/orders?status=paid" class="dashboard-link">
            <div class="card dashboard-card-small">
                <div class="card-body">
                    <p class="card-label">Pending<br>Shipments</p>
                    <p class="card-text fs-3 dashboard-number">8</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="/admin/inquiries?status=open" class="dashboard-link">
            <div class="card dashboard-card-small">
                <div class="card-body">
                    <p class="card-label">Open<br>Inquiries</p>
                    <p class="card-text fs-3 dashboard-number">{{ $openInquiryCount }}</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="/admin/reviews?reported=1" class="dashboard-link">
            <div class="card dashboard-card-small">
                <div class="card-body">
                    <p class="card-label">Reported<br>Reviews</p>
                    <p class="card-text fs-3 reported-number">1</p>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card">
            <div class="card-body">
                <p class="card-label">Total Users</p>
                <h3 class="card-number">1,284</h3>
                <p class="card-sub">+27 this week</p>
                <p class="card-sub"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card">
            <div class="card-body">
                <p class="card-label">Orders Today</p>
                <h3 class="card-number">38</h3>
                <p class="card-sub">Revenue (MTD) ¥428,300 / Last Month ¥1,120,540</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card">
            <div class="card-body">
                <p class="card-label">Restaurants / Products</p>
                <h3 class="card-number">82 / 341</h3>
                <p class="card-sub">+3 restaurants</p>
                <p class="card-sub">+15 products</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card">
            <div class="card-body">
                <p class="card-label">Rewards Issued</p>
                <h3 class="card-number">12,430</h3>
                <p class="card-sub">Coupons 2,134</p>
                <p class="card-sub">Points 9,820</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                Sales Analytics
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                Recent Orders
            </div>

            <div class="card-body">
                <ul class="recent-orders">

                @foreach($recentOrders as $order)

                <li class="recent-order-item">

                <span class="order-id">
                #{{ $order->id }}
                </span>

                <span class="order-price">
                ¥{{ number_format($order->total_price) }}
                </span>

                <span class="order-time">
                {{ $order->created_at->diffForHumans() }}
                </span>


                </li>

                @endforeach

                </ul>
            </div>
        </div>
    </div>

</div>

@push('scripts')

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: @json($labels),

        datasets: [{
            label: 'Orders',

            data: @json($ordersPerDay),

            borderWidth: 2,
            borderColor:'#B8D9D0',
            backgroundColor:'rgba(184,217,208,0.2)',
            tension:0.4,
            fill:true
        }]
    },

    options: {
        responsive: true,

        plugins: {
            legend: {
                labels: {
                    font: {
                        family: 'Playfair Display'
                    }
                }
            }
        },

        scales: {
            x: {
                ticks: {
                    font: {
                        family: 'Playfair Display'
                    }
                }
            },
            y: {
                ticks: {
                    font: {
                        family: 'Playfair Display'
                    }
                }
            }
        }
    }

});

</script>

@endpush
@endsection

