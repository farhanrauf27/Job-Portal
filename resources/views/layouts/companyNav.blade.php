<x-bootstrap/>
<style>

    .special-button-red {
        background-color: red; 
        color: #fff; 
        border: none; 
        border-radius: 5px;
        padding: 8px 12px; 
        font-size: 14px; 
        font-weight: bold; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        display: inline-flex;
        align-items: center; 
        gap: 6px; 
        cursor: pointer; 
    }
    .special-button-blue {
        background-color: blue; /* Bright red color for visibility */
        color: #fff; /* White text */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 8px 12px; /* Padding for a comfortable click area */
        font-size: 14px; /* Text size */
        font-weight: bold; /* Bold text for emphasis */
        transition: all 0.3s ease; /* Smooth transition for hover effects */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        display: inline-flex; /* Align icon and text properly */
        align-items: center; /* Vertical alignment */
        gap: 6px; /* Space between icon and text */
        cursor: pointer; /* Pointer cursor for clarity */
    }
    .special-button-green {
        background-color: green; 
        color: #fff; 
        border: none; 
        border-radius: 5px;
        padding: 8px 12px; 
        font-size: 14px; 
        font-weight: bold; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        display: inline-flex;
        align-items: center; 
        gap: 6px; 
        cursor: pointer; 
    }
    .special-button-yellow {
        background-color: yellow; 
        color: #000; 
        border: none; 
        border-radius: 5px;
        padding: 8px 12px; 
        font-size: 14px; 
        font-weight: bold; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        display: inline-flex;
        align-items: center; 
        gap: 6px; 
        cursor: pointer; 
    }
    
    .special-button-red:hover,
    .special-button-blue:hover,
    .special-button-yellow:hover,
    .special-button-green:hover {
        background-color: #2c3e50; /* Darker red for hover effect */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Enhance shadow on hover */
        transform: translateY(-2px); /* Subtle lift effect */
    }
    
    
    </style>
<div class="sidebar">
    <ul class="list-unstyled">
        <li>
            <a href="{{route('company.dashboard')}}" class="sidebar-item">
                <i class="fas fa-tachometer-alt"></i> 
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('company.createJob')}}" class="sidebar-item">
                <i class="fas fa-briefcase"></i>
                <span>Create Jobs</span>
            </a>
        </li>
        <li>
            <a href="{{route('company.showJobs')}}" class="sidebar-item">
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
            <a href="{{ route('company.editProfile', ['id' => Auth::guard('company')->user()->id]) }}" class="sidebar-item">
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
            <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

