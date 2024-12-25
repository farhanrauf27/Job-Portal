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
        transform: translateY(-2px); 
        color: white;
    }

        </style>


</head>
<body>

<div class="sidebar">
    <ul class="nav flex-column">
        
        
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
            <a class="nav-link" href="{{route('admin.jobs')}}">
                <i class="fas fa-briefcase"></i> Jobs
            </a>
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
                    <a class="nav-link" href="{{ route('admin.analytics') }}">
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
            <a class="nav-link" href="{{route('admin.updateProfile')}}">
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
    <div class="container d-flex justify-content-center">
        <div class="text-center mt-5">
            <a href="">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" class="mb-3" style="max-width: 150px;">
            </a>
            <h2 class="mb-4"> {{$user->name}}- Admin Dashboard</h2>
        </div>
    </div>
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
