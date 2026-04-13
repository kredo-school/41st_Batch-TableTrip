<nav class="sidebar">

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
       Dashboard
    </a>

    <a href="{{ route('admin.orders.index') }}"
       class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
       Orders
    </a>

    <a href="{{ route('admin.reservations.index') }}">Reservations</a>
    <a href="{{ route('admin.inquiries.index') }}">Inquiries</a>
    <a href="{{ route('admin.reviews.index') }}">Reviews</a>
    <a href="#">Restaurants</a>
    <a href="#">Products</a>
    <a href="#">Users</a>

    <div class="menu-item">
        <a href="{{ route('admin.rewards.dashboard') }}" class="menu-title">
            Rewards
        </a>

        <div class="submenu">
            <a href="/admin/coupons">Coupons</a>
            <a href="{{ route('admin.rewards.point-history') }}">Point History</a>
            <a href="/admin/stamps">Stamp Rally</a>
        </div>
    </div>

</nav>

{{-- @push('scripts')
<script>
document.querySelectorAll('.menu-title').forEach(item => {
    item.addEventListener('click', function(e){
        e.preventDefault();
        this.parentElement.classList.toggle('active');
    });
});
</script>
@endpush --}}
