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
    <a href="{{ route('admin.restaurants.index') }}" class="{{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">Restaurants</a>
    <a href="{{ route('admin.products.index') }}"
    class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    Products
    </a>
    <a href="{{ route('admin.users.index') }}"
        class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        Users</a>

    <div class="menu-item">
        <a href="{{ route('admin.rewards.dashboard') }}" class="menu-title">
            Rewards
        </a>

        <div class="submenu">
            <a href="{{ route('admin.rewards.coupons') }}"
            class="{{ request()->routeIs('admin.rewards.coupons') ? 'active' : '' }}">
                Coupons
            </a>

            <a href="{{ route('admin.rewards.point-history') }}"
            class="{{ request()->routeIs('admin.rewards.point-history') ? 'active' : '' }}">
                Point History
            </a>

            <a href="{{ route('admin.rewards.stamps') }}"
            class="{{ request()->routeIs('admin.rewards.stamps') ? 'active' : '' }}">
                Stamp Rally
            </a>
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
