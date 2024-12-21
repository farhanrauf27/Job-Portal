<x-bootstrap/>
<div class="sidebar">
    <ul class="list-unstyled">
        <li>
            <a href="{{route('company.dashboard')}}" class="sidebar-item">
                <i class="fas fa-tachometer-alt"></i> 
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-item">
                <i class="fas fa-briefcase"></i>
                <span>Jobs</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-item">
                <i class="fas fa-users"></i>
                <span>Applications</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-item">
                <i class="fas fa-chart-line"></i>
                <span>Reports</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-item">
                <i class="fas fa-building"></i>
                <span>Company Profile</span>
            </a>
        </li>
        <li>
            <a href="#" class="sidebar-item">
                <i class="fas fa-cogs"></i>
                <span>Settings</span>
            </a>
        </li>
        <li >
            <a class="sidebar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
<div class="content">
    @yield('content')
</div>
<style>
    /* Sidebar styling */
    .sidebar {
        background-color: #2c3e50;
        height: 100vh;
        padding-top: 50px;
        position: fixed;
        width: 250px;
        color: white;
    }
    .sidebar .list-unstyled {
        padding-left: 0;
    }
    .sidebar-item {
        display: block;
        color: white;
        padding: 12px 20px;
        text-decoration: none;
        font-size: 16px;
        transition: all 0.3s;
    }
    .sidebar-item i {
        margin-right: 10px;
    }
    .sidebar-item:hover {
        background-color: #34495e;
        border-radius: 5px;
    }
    .sidebar-item span {
        font-weight: 600;
    }
</style>
