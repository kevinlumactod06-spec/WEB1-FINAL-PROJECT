<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}

require_once "../config/database.php";
require_once "../app/models/CommentModel.php";

$commentModel = new CommentModel($GLOBALS["conn"]);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Newsfeed | WEB1 Final Project</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="newsfeed-container">

    <header class="newsfeed-header">

        <div>

            <h1>🌐 WEB1 Final Project</h1>

            <p>
                Welcome,
                <?php echo htmlspecialchars($_SESSION["full_name"]); ?>!
            </p>

        </div>

        <div>

            <a href="index.php?page=dashboard">
                Dashboard
            </a>

            <a href="index.php?page=logout">
                Logout
            </a>

        </div>

    </header>


    <main class="newsfeed-content">

        <section class="create-post-card">

            <h2>📝 Create a Post</h2>

            <form method="POST" action="index.php?page=create_post">

                <textarea
                    name="content"
                    placeholder="What's on your mind?"
                    rows="4"
                    required
                ></textarea>

                <button type="submit">
                    Post
                </button>

            </form>

        </section>


        <section class="posts-section">

            <h2>📰 Newsfeed</h2>


            <?php if (empty($posts)): ?>

                <div class="empty-posts">

                    <p>No posts yet.</p>

                    <p>Be the first to create a post!</p>

                </div>

            <?php else: ?>


                <?php foreach ($posts as $post): ?>

                    <article class="post-card">

                        <div class="post-header">

                            <div>

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


                            <?php if (
                                $post["user_id"] == $_SESSION["user_id"]
                            ): ?>

                                <div class="post-actions">

                                    <button
                                        type="button"
                                        onclick="showEditForm(
                                            <?php echo $post['id']; ?>
                                        )"
                                    >
                                        Edit
                                    </button>


                                    <form
                                        method="POST"
                                        action="index.php?page=delete_post"
                                        style="display:inline;"
                                    >

                                        <input
                                            type="hidden"
                                            name="post_id"
                                            value="<?php
                                            echo $post['id'];
                                            ?>"
                                        >

                                        <button type="submit">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            <?php endif; ?>

                        </div>


                        <div
                            class="post-content"
                            id="post-content-<?php
                            echo $post['id'];
                            ?>"
                        >

                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $post["content"]
                                )
                            );
                            ?>

                        </div>


                        <div
                            class="edit-post-form"
                            id="edit-form-<?php
                            echo $post['id'];
                            ?>"
                            style="display:none;"
                        >

                            <form
                                method="POST"
                                action="index.php?page=edit_post"
                            >

                                <input
                                    type="hidden"
                                    name="post_id"
                                    value="<?php
                                    echo $post['id'];
                                    ?>"
                                >

                                <textarea
                                    name="content"
                                    rows="4"
                                    required
                                ><?php
                                echo htmlspecialchars(
                                    $post["content"]
                                );
                                ?></textarea>

                                <button type="submit">
                                    Save Changes
                                </button>

                                <button
                                    type="button"
                                    onclick="hideEditForm(
                                        <?php echo $post['id']; ?>
                                    )"
                                >
                                    Cancel
                                </button>

                            </form>

                        </div>


                        <div class="post-date">

                            <?php
                            echo htmlspecialchars(
                                $post["created_at"]
                            );
                            ?>

                        </div>


                        <!-- COMMENTS -->

                        <div class="comments-section">

                            <h3>💬 Comments</h3>


                            <?php

                            $comments =
                                $commentModel->getCommentsByPost(
                                    $post["id"]
                                );

                            ?>


                            <?php if (empty($comments)): ?>

                                <p class="no-comments">
                                    No comments yet.
                                </p>

                            <?php else: ?>


                                <?php foreach ($comments as $comment): ?>

                                    <div class="comment-item">

                                        <div class="comment-header">

                                            <strong>
                                                <?php
                                                echo htmlspecialchars(
                                                    $comment["full_name"]
                                                );
                                                ?>
                                            </strong>

                                            <small>
                                                @<?php
                                                echo htmlspecialchars(
                                                    $comment["username"]
                                                );
                                                ?>
                                            </small>

                                        </div>


                                        <div class="comment-content">

                                            <?php
                                            echo nl2br(
                                                htmlspecialchars(
                                                    $comment["content"]
                                                )
                                            );
                                            ?>

                                        </div>


                                        <div class="comment-date">

                                            <?php
                                            echo htmlspecialchars(
                                                $comment["created_at"]
                                            );
                                            ?>

                                        </div>


                                        <?php if (
                                            $comment["user_id"]
                                            == $_SESSION["user_id"]
                                        ): ?>

                                            <div class="comment-actions">

                                                <button
                                                    type="button"
                                                    onclick="showCommentEdit(
                                                        <?php
                                                        echo $comment['id'];
                                                        ?>
                                                    )"
                                                >
                                                    Edit
                                                </button>


                                                <form
                                                    method="POST"
                                                    action="index.php?page=delete_comment"
                                                    style="display:inline;"
                                                >

                                                    <input
                                                        type="hidden"
                                                        name="comment_id"
                                                        value="<?php
                                                        echo $comment['id'];
                                                        ?>"
                                                    >

                                                    <button type="submit">
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>


                                            <div
                                                id="comment-edit-<?php
                                                echo $comment['id'];
                                                ?>"
                                                style="display:none;"
                                            >

                                                <form
                                                    method="POST"
                                                    action="index.php?page=edit_comment"
                                                >

                                                    <input
                                                        type="hidden"
                                                        name="comment_id"
                                                        value="<?php
                                                        echo $comment['id'];
                                                        ?>"
                                                    >

                                                    <textarea
                                                        name="content"
                                                        rows="3"
                                                        required
                                                    ><?php
                                                    echo htmlspecialchars(
                                                        $comment["content"]
                                                    );
                                                    ?></textarea>

                                                    <button type="submit">
                                                        Save
                                                    </button>

                                                    <button
                                                        type="button"
                                                        onclick="hideCommentEdit(
                                                            <?php
                                                            echo $comment['id'];
                                                            ?>
                                                        )"
                                                    >
                                                        Cancel
                                                    </button>

                                                </form>

                                            </div>

                                        <?php endif; ?>

                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>


                            <!-- ADD COMMENT -->

                            <form
                                method="POST"
                                action="index.php?page=create_comment"
                                class="comment-form"
                            >

                                <input
                                    type="hidden"
                                    name="post_id"
                                    value="<?php
                                    echo $post['id'];
                                    ?>"
                                >

                                <textarea
                                    name="content"
                                    placeholder="Write a comment..."
                                    rows="2"
                                    required
                                ></textarea>

                                <button type="submit">
                                    Comment
                                </button>

                            </form>

                        </div>

                    </article>

                <?php endforeach; ?>


            <?php endif; ?>

        </section>

    </main>

</div>


<script>

function showEditForm(postId)
{
    document.getElementById(
        "post-content-" + postId
    ).style.display = "none";

    document.getElementById(
        "edit-form-" + postId
    ).style.display = "block";
}


function hideEditForm(postId)
{
    document.getElementById(
        "post-content-" + postId
    ).style.display = "block";

    document.getElementById(
        "edit-form-" + postId
    ).style.display = "none";
}


function showCommentEdit(commentId)
{
    document.getElementById(
        "comment-edit-" + commentId
    ).style.display = "block";
}


function hideCommentEdit(commentId)
{
    document.getElementById(
        "comment-edit-" + commentId
    ).style.display = "none";
}

</script>

</body>

</html>