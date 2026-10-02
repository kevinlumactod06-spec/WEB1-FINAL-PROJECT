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

    <title>Search | WEB1 Final Project</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

<div class="search-container">


    <!-- HEADER -->

    <header class="search-header">

        <div>

            <h1>
                🌐 WEB1 Final Project
            </h1>

            <p>
                Search Users and Posts
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


    <!-- SEARCH FORM -->

    <main class="search-content">

        <section class="search-card">

            <h2>
                🔎 Search
            </h2>


            <form
                method="GET"
                action="index.php"
                class="search-form"
            >

                <input
                    type="hidden"
                    name="page"
                    value="search"
                >


                <input
                    type="text"
                    name="keyword"
                    placeholder="Search users or posts..."
                    value="<?php
                    echo htmlspecialchars(
                        $keyword ?? ""
                    );
                    ?>"
                    required
                >


                <button type="submit">
                    Search
                </button>

            </form>

        </section>


        <?php if (!empty($keyword)): ?>


            <!-- USER RESULTS -->

            <section class="search-results">

                <h2>
                    👤 Users
                </h2>


                <?php if (empty($users)): ?>

                    <p>
                        No users found.
                    </p>

                <?php else: ?>


                    <?php foreach ($users as $user): ?>

                        <div class="search-user-card">

                            <div class="search-user-icon">
                                👤
                            </div>


                            <div>

                                <h3>
                                    <?php
                                    echo htmlspecialchars(
                                        $user["full_name"]
                                    );
                                    ?>
                                </h3>


                                <p>
                                    @<?php
                                    echo htmlspecialchars(
                                        $user["username"]
                                    );
                                    ?>
                                </p>


                                <?php if (
                                    !empty($user["bio"])
                                ): ?>

                                    <small>
                                        <?php
                                        echo nl2br(
                                            htmlspecialchars(
                                                $user["bio"]
                                            )
                                        );
                                        ?>
                                    </small>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>


                <?php endif; ?>

            </section>


            <!-- POST RESULTS -->

            <section class="search-results">

                <h2>
                    📝 Posts
                </h2>


                <?php if (empty($posts)): ?>

                    <p>
                        No posts found.
                    </p>

                <?php else: ?>


                    <?php foreach ($posts as $post): ?>

                        <article class="search-post-card">


                            <div class="search-post-header">

                                <strong>
                                    <?php
                                    echo htmlspecialchars(
                                        $post["full_name"]
                                    );
                                    ?>
                                </strong>


                                <small>
                                    @<?php
                                    echo htmlspecialchars(
                                        $post["username"]
                                    );
                                    ?>
                                </small>

                            </div>


                            <div class="search-post-content">

                                <?php
                                echo nl2br(
                                    htmlspecialchars(
                                        $post["content"]
                                    )
                                );
                                ?>

                            </div>


                            <div class="search-post-date">

                                <?php
                                echo htmlspecialchars(
                                    $post["created_at"]
                                );
                                ?>

                            </div>


                        </article>

                    <?php endforeach; ?>


                <?php endif; ?>

            </section>


        <?php else: ?>


            <section class="search-empty">

                <h2>
                    🔎 Search for something
                </h2>

                <p>
                    Enter a username, person's name,
                    or words from a post.
                </p>

            </section>


        <?php endif; ?>


    </main>

</div>

</body>

</html>