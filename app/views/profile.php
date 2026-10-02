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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Profile | WEB1 Final Project</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

<div class="profile-container">

    <header class="profile-header">

        <div>

            <h1>🌐 WEB1 Final Project</h1>

            <p>
                My Profile
            </p>

        </div>

        <div>

            <a href="index.php?page=dashboard">
                Dashboard
            </a>

            <a href="index.php?page=newsfeed">
                Newsfeed
            </a>

            <a href="index.php?page=logout">
                Logout
            </a>

        </div>

    </header>


    <main class="profile-content">

        <section class="profile-card">

            <div class="profile-icon">
                👤
            </div>


            <h2>
                <?php
                echo htmlspecialchars(
                    $user["full_name"]
                );
                ?>
            </h2>


            <p class="profile-username">

                @<?php
                echo htmlspecialchars(
                    $user["username"]
                );
                ?>

            </p>


            <div class="profile-info">

                <h3>About Me</h3>

                <?php if (!empty($user["bio"])): ?>

                    <p>
                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                $user["bio"]
                            )
                        );
                        ?>
                    </p>

                <?php else: ?>

                    <p>
                        No bio added yet.
                    </p>

                <?php endif; ?>

            </div>


            <div class="profile-edit">

                <h3>✏️ Edit Profile</h3>


                <?php if (
                    isset($_GET["error"])
                    && $_GET["error"] === "empty"
                ): ?>

                    <p class="error-message">
                        Full name cannot be empty.
                    </p>

                <?php endif; ?>


                <?php if (
                    isset($_GET["updated"])
                    && $_GET["updated"] === "1"
                ): ?>

                    <p class="success-message">
                        Profile updated successfully!
                    </p>

                <?php endif; ?>


                <form
                    method="POST"
                    action="index.php?page=update_profile"
                >

                    <label for="full_name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="<?php
                        echo htmlspecialchars(
                            $user["full_name"]
                        );
                        ?>"
                        required
                    >


                    <label for="bio">
                        Bio
                    </label>

                    <textarea
                        id="bio"
                        name="bio"
                        rows="5"
                        placeholder="Tell us something about yourself..."
                    ><?php
                    echo htmlspecialchars(
                        $user["bio"] ?? ""
                    );
                    ?></textarea>


                    <button type="submit">
                        Save Changes
                    </button>

                </form>

            </div>

        </section>

    </main>

</div>

</body>

</html>