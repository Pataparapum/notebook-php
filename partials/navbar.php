<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #005C53;">
    <div class="container-fluid">
        <a class="navbar-brand font-weight-bold" href="index.php">
            <img id="logo" class="mr-2 rounded-circle" src="./static/img/logo.jpg">
        </a>
        <div class="collapse navbar-collapse d-flex justify-content-end">
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex justify-content-between w-100">
                    <?php if (isset($_SESSION['user'])): ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link activate" href="principal.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link actiavate" href="addnote.php">Add note</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link actiavate" href="logout.php">Log out</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link activate" href="register.php">Register</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link actiavate" href="login.php">Login</a>
                            </li>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
           
        </div>
    </div>
</nav>
