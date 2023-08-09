<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href={{ route('home') }}>MY-PRODUCT</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href={{ route('home') }}>MP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @cannot('isUser')
                <li class="nav-item {{ $type_menu === 'user' ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-user"></i>
                        <span>User</span></a>
                </li>
            @endcannot
            @cannot('isSuperAdmin')
                <li class="nav-item {{ $type_menu === 'product' ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" class="nav-link"><i class="fas fa-box-open"></i>
                        <span>Product</span></a>
                </li>
            @endcannot
        </ul>
    </aside>
</div>
