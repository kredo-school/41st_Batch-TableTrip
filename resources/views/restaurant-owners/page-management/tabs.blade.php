<div class="mb-4 border-bottom">
    <ul class="nav nav-tabs border-0">
        <li class="nav-item">
            <a class="nav-link text-dark {{ request()->is('owner/page-management') ? 'active' : '' }}" href="{{ route('owner.page-management') }}">Basic Info</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark {{ request()->is('owner/page-management/image') ? 'active' : '' }}" href="{{ route('owner.page-management.image') }}">Image</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark {{ request()->is('owner/page-management/menu') ? 'active' : '' }}  " href="{{ route('owner.page-management.menu') }}">Menu</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark {{ request()->is('owner/page-management/preview') ? 'active' : '' }}" href="{{ route('owner.page-management.preview') }}">Preview</a>
        </li>
    </ul>
</div>