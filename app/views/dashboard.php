<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | WEB1 Final Project</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <div class="dashboard-container">

        <header class="dashboard-header">

            <div>
                <h1>🌐 WEB1 Final Project</h1>

                <p>
                    Welcome,
                    <?php echo htmlspecialchars($_SESSION["full_name"]); ?>!
                </p>
            </div>

            <a
                href="index.php?page=logout"
                class="logout-button"
            >
                Logout
            </a>

        </header>


        <main class="dashboard-content">

            <div class="welcome-card">

                <h2>Welcome to your Dashboard</h2>

                <p>
                    You are successfully logged in.
                </p>

            </div>


            <div class="dashboard-grid">

                <div class="dashboard-card">

                    <div class="card-icon">
                        👤
                    </div>

                    <h3>Profile</h3>

                    <p>
                        View and manage your profile.
                    </p>

                </div>


                <div class="dashboard-card">
    <div class="card-icon">📝</div>
    <h3>Posts</h3>
    <p>Create and view posts.</p>

    <a href="index.php?page=newsfeed">
        Open Newsfeed
    </a>
</div>


                <div class="dashboard-card">

                    <div class="card-icon">
                        💬
                    </div>

                    <h3>Comments</h3>

                    <p>
                        Interact with posts.
                    </p>

                </div>


                <div class="dashboard-card">

                    <div class="card-icon">
                        ❤️
                    </div>

                    <h3>Likes</h3>

                    <p>
                        Like posts you enjoy.
                    </p>

                </div>

            </div>

        </main>

    </div>

</body>

</html>