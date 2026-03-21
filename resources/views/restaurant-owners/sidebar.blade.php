
<div class="d-lg-none mb-3">
    <button type="button" class="btn btn-outline-navy" data-bs-toggle="offcanvas" data-bs-target="#ownerSidebar" aria-controls="ownerSidebar">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

<div class="col-3 d-none d-lg-block">
    <div class="list-group sidebar-menu">
        <a href="{{ route('owner.dashboard') }}" class="list-group-item fs-5 {{ request()->is('owner') ? 'active' : '' }}">
            <i class="fa-regular fa-house me-2"></i>Dashboard
        </a>
        <a href="{{ route('owner.reservations') }}" class="list-group-item fs-5 {{ request()->is('owner/reservations*') ? 'active' : '' }}">
            <i class="fa-regular fa-calendar me-2"></i>Reservations
        </a>

        <a href="{{ route('owner.orders') }}" class="list-group-item fs-5 {{ request()->is('owner/orders') ? 'active' : '' }}">
            <i class="fa-solid fa-truck me-2"></i>Orders
        </a>

        <a href="" class="list-group-item fs-5 {{ request()->is('owner/mealkit') ? 'active' : '' }}">
            <i class="fa-solid fa-utensils me-2"></i>Meal Kit
        </a>

        <a href="" class="list-group-item fs-5 {{ request()->is('owner/page-management') ? 'active' : '' }}">
            <i class="fa-solid fa-globe me-2"></i>Page Management
        </a>

        <a href="" class="list-group-item fs-5 {{ request()->is('owner/reviews') ? 'active' : '' }}">
            <i class="fa-solid fa-star me-2"></i>Reviews
        </a>

        <a href="" class="list-group-item fs-5 {{ request()->is('owner/notifications') ? 'active' : '' }}">
            <i class="fa-regular fa-bell me-2"></i>Notifications
        </a>

        <a href="" class="list-group-item fs-5 {{ request()->is('owner/settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear me-2"></i>Settings
        </a>
    </div>
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="ownerSidebar" aria-labelledby="ownerSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ownerSidebarLabel">Owner Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="list-group sidebar-menu">
            <a href="" class="list-group-item {{ request()->is('owner/dashboard') ? 'active' : '' }}">
                <i class="fa-regular fa-house me-2"></i>Dashboard
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/reservations') ? 'active' : '' }}">
                <i class="fa-regular fa-calendar me-2"></i>Reservations
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/orders') ? 'active' : '' }}">
                <i class="fa-solid fa-truck me-2"></i>Orders
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/mealkit') ? 'active' : '' }}">
                <i class="fa-solid fa-utensils me-2"></i>Meal Kit
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/page-management') ? 'active' : '' }}">
                <i class="fa-solid fa-globe me-2"></i>Page Management
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/reviews') ? 'active' : '' }}">
                <i class="fa-solid fa-star me-2"></i>Reviews
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/notifications') ? 'active' : '' }}">
                <i class="fa-regular fa-bell me-2"></i>Notifications
            </a>

            <a href="" class="list-group-item {{ request()->is('owner/settings') ? 'active' : '' }}">
                <i class="fa-solid fa-gear me-2"></i>Settings
            </a>
        </div>
    </div>
</div>