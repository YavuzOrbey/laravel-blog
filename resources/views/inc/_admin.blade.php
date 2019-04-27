<div class="side-menu">
<aside class="menu mt-3">
    <div class="menu-label">General</div>
    <ul class="menu-list">
    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    </ul>

    <p class="menu-label">Administration</p>
    <ul class="menu-list">
        <li><a href="{{route('users.index')}}">Manage Users</a></li>
    <ul>
        <li>
            <a href="{{route('roles.index')}}">Roles</a>
        </li>
        <li> <a href="{{route('permissions.index')}}">Permissions</a></li>
    </ul>
    </ul>
</aside>


</div>