<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/attendance/history" class="item {{ request()->is('attendance/history') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>History</strong>
        </div>
    </a>
    <a href="/attendance/create" class="item {{ request()->is('attendance/create') ? 'active' : '' }}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/attendance/permission" class="item {{ request()->is('attendance/permission') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline"></ion-icon>
            <strong>Permission</strong>
        </div>
    </a>
    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
