<style>
    body {
        display: flex;
        flex-wrap: wrap;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        background: #343a40;
        color: white;
        padding-top: 20px;
        position: fixed;
        transition: all 0.3s ease-in-out;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #495057;
    }

    .content {
        margin-left: 260px;
        width: calc(100% - 260px);
        padding: 20px;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            width: 0;
            overflow: hidden;
        }

        .content {
            margin-left: 0;
            width: 100%;
        }

        .toggle-btn {
            display: block;
            position: absolute;
            top: 10px;
            left: 10px;
            background: #343a40;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    }
</style>

<button class="toggle-btn d-md-none" onclick="toggleSidebar()">☰</button>

<div class="sidebar" id="sidebar">
    <h4 class="text-center">Admin Panel</h4>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ url('/') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ url('/students') }}" class="nav-link"><i class="fas fa-users"></i> Students</a></li>
        <li class="nav-item"><a href="" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px";
    }
</script>