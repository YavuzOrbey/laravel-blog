
<div class="side-menu">
<aside class="menu mt-3">
    <div class="menu-label">General</div>
    <ul class="menu-list">
    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    </ul>
    @if(Auth::user()->hasRole(['editor', 'superadministrator', 'administrator']))

    <p class="menu-label">Administration</p>
    <ul class="menu-list">
        <li><a href="{{route('categories.index')}}">Categories</a></li>
        @if(Auth::user()->hasRole(['superadministrator', 'administrator']))
        <li><a href="{{route('users.index')}}">Manage Users</a></li>
        <li><a href="{{route('roles.index')}}">Roles</a></li>
        <li> <a href="{{route('permissions.index')}}">Permissions</a></li>
        @endif
    @endif
   

    </ul>
</aside>


</div>