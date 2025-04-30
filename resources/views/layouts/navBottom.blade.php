<!-- Bottom Menu -->
<div class="bottom-menu ">
    <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <ion-icon name="home-outline"></ion-icon>
        <p style="margin-top: -0.5rem; font-size: 12px;">Home</p>
    </a>
    <a href="/attendance/history" class="menu-item {{ request()->is('attendance/history') ? 'active' : '' }}">
        <ion-icon name="document-text-outline"></ion-icon>
        <p style="margin-top: -0.5rem; font-size: 12px;">History</p>
    </a>
    <a href="/attendance/create" class="menu-item {{ request()->is('attendance/create') ? 'active' : '' }}">
        <ion-icon name="camera" style="font-size: 2rem; color: #1171ba;"></ion-icon>
    </a>
    <a href="/attendance/permission" class="menu-item {{ request()->is('attendance/permission') ? 'active' : '' }}">
        <ion-icon name="calendar-outline"></ion-icon>
        <p style="margin-top: -0.5rem; font-size: 12px;">Permmission</p>
    </a>
    <a href="/editprofile" class="menu-item {{ request()->is('editprofile') ? 'active' : '' }}">
        <ion-icon name="person-outline"></ion-icon>
        <p style="margin-top: -0.5rem; font-size: 12px;">Profile</p>
    </a>
</div>
