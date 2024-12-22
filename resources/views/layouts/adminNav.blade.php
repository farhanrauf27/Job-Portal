<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            a{
                text-decoration: none;
            }
            /* Sidebar styling */
.sidebar {
    width: 250px;
    height: 100%;
    background-color: #343a40;
    padding-top: 20px;
    position: fixed;
}

.sidebar .nav-item {
    color: #ffffff;
    font-size: 16px;
}

.sidebar .nav-item .nav-link {
    color: #ffffff;
    padding: 10px 20px;
}

.sidebar .nav-item .nav-link:hover {
    background-color: #495057;
    text-decoration: none;
}

.sidebar .nav-item .nav-link .fas {
    margin-right: 10px;
}

.sidebar .nav-item .nav-link.active {
    background-color: #007bff;
    color: white;
}

.sidebar .nav-item .nav-link:active {
    background-color: #0056b3;
}

.sidebar .nav .nav-item ul.nav {
    display: none;
    padding-left: 20px;
}

.sidebar .nav-item:hover ul.nav {
    display: block;
}

.sidebar .nav-item ul.nav .nav-link {
    padding: 8px 20px;
}

        </style>


</head>
<body>

<div class="sidebar">
    <ul class="nav flex-column">
        <div class="logo mb-4">
            @if(Auth::guard('company')->check() && Auth::guard('company')->user()->logo)
                <a href="{{ route('company.dashboard') }}">
                    <img src="{{ asset('storage/logos/' . Auth::guard('company')->user()->logo) }}" alt="Company Logo" style="max-width: 100px;">
                </a>
            @else
                <a href="{{ route('company.dashboard') }}">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Default Logo">
                </a>
            @endif
        </div>
        
                <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <!-- Users -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users') }}">
                <i class="fas fa-users"></i> Users
            </a>
            
        </li>

        <!-- Jobs -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-briefcase"></i> Jobs
            </a>
            <ul class="nav flex-column ml-3">
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-check-circle"></i> Active
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-clock"></i> Pending
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-th-large"></i> Categories
                    </a>
                </li>
            </ul>
        </li>

        <!-- Applications -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-paper-plane"></i> Applications
            </a>
        </li>

        <!-- Reports -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <ul class="nav flex-column ml-3">
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-users-cog"></i> User Activity
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-chart-pie"></i> Job Analytics
                    </a>
                </li>
            </ul>
        </li>

        <!-- Content Management -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-cogs"></i> Content Management
            </a>
            <ul class="nav flex-column ml-3">
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-file-alt"></i> Pages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-blog"></i> Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-question-circle"></i> FAQs
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-cogs"></i> Settings
            </a>
            <ul class="nav flex-column ml-3">
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-cogs"></i> General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-lock"></i> Security
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-envelope"></i> Email
                    </a>
                </li>
            </ul>
        </li>

        <!-- Profile -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-user-circle"></i> Profile
            </a>
        </li>

        <!-- Log Out -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

<!-- Add appropriate CSS styles to make it look good -->

<div class="content">
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
