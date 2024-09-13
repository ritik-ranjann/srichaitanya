<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
    <a href="index.php" class="navbar-brand p-0">
        <h1 class="m-0 text-uppercase text-primary">
            <img src="img/logo.jpeg" alt="" style="width:32px; height:32px; border-radius: 50%; margin:2px;">
            Sri Chaitanya Techno School
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                <li class="nav-item">
                    <form method="post" class="form-inline">
                        <button type="submit" name="logout" class="logout-button nav-link">Logout</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
