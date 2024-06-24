<div>
    @if (Auth::guard('admin')->check())
    <div class="sidebar-user">
        <div class="menu-btn-user">
            <i class="fa-solid fa-angles-left"></i>
        </div>
        <div class="head-user">
            <div class="user-img-user">
                <img src="{{ $admin->picture }}" alt="" />
            </div>
            <div class="user-details-user">
                <p class="name-user">{{ $admin->name }}</p>
            </div>
        </div>
        <div class="nav-user">
            <div class="menu-user">
                <p class="title-user">Main</p>
                <ul>
                    <li class="{{ Route::is('admin.home') ? 'active' : '' }}">
                        <a href="{{ route('admin.home') }}"> 
                            <i class="fa-solid fa-chart-line"></i>
                            <span class="text-user">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.profile') ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="text-user">Perfil</span>
                            <i class="arrow-user ph-bold ph-caret-down"></i>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.manage-categories.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.manage-categories.cats-subcats-list') }}">
                            <i class="fa-solid fa-bars"></i>
                            <span class="text-user">Categorias</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu-user">
                <p class="title-user">Settings</p>
                <ul>
                    <li class="{{ Route::is('admin.settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}">
                            <i class="fa-solid fa-gear"></i>
                            <span class="text-user">Configurações</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="menu-user">
            <p class="title-user">Account</p>
            <ul>
                <li>
                    <a href="{{ route('contact-page') }}">
                        <i class="fa-solid fa-circle-info"></i>
                        <span class="text-user">Help</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout_handler') }}" onclick="event.preventDefault();document.getElementById('adminLogoutForm').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="text-user">Logout</span>
                    </a>
                    <form action="{{ route('admin.logout_handler')}}" id="adminLogoutForm" method="POST">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
    
    
    @elseif(Auth::guard('seller')->check())
    <div class="sidebar-user">
        <div class="menu-btn-user">
            <i class="fa-solid fa-angles-left"></i>
        </div>
        <div class="head-user">
            <div class="user-img-user">
                <img src="{{ $seller->picture }}" alt="" />
            </div>
            <div class="user-details-user">
                <p class="name-user">{{ $seller->name }}</p>
            </div>
        </div>
        <div class="nav-user">
            <div class="menu-user">
                <p class="title-user">Main</p>
                <ul>
                    <li class="{{ Route::is('seller.home') ? 'active' : '' }}">
                        <a href="{{ route('seller.home') }}">
                            <i class="fa-solid fa-chart-line"></i>
                            <span class="text-user">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('seller.profile') ? 'active' : '' }}">
                        <a href="{{ route('seller.profile') }}">
                            <i class="fa-solid fa-user"></i>
                            <span class="text-user">Perfil</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('seller.product.*') ? 'active' : '' }}">
                        <a href="{{ route('seller.product.all-products')}}">
                            <i class="fa-solid fa-box-open"></i>
                            <span class="text-user">Products</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu-user">
                <p class="title-user">Settings</p>
                <ul>
                    <li class="{{ Route::is('seller.shop-settings') ? 'active' : '' }}">
                        <a href="{{ route('seller.shop-settings') }}">
                            <i class="fa-solid fa-gear"></i>
                            <span class="text-user">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="menu-user">
            <p class="title-user">Account</p>
            <ul>
                <li>
                    <a href="{{ route('contact-page') }}">
                        <i class="fa-solid fa-circle-info"></i>
                        <span class="text-user">Help</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('seller.logout') }}" onclick="event.preventDefault();document.getElementById('sellerLogoutForm').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="text-user">Logout</span>
                    </a>
                    <form action="{{ route('seller.logout') }}" id="sellerLogoutForm" method="POST">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
    
    @endif
</div>
