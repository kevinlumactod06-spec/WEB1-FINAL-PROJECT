<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Newsfeed - Social App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navbar with Home Button -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=newsfeed">MiniSocial</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php?route=newsfeed">Home</a>
                <a class="nav-link" href="index.php?route=search">Search</a>
                <a class="nav-link" href="index.php?route=profile">Profile</a>
                <a class="nav-link text-danger" href="index.php?route=logout">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Create Post Box -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="index.php?route=create_post" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <textarea class="form-control" name="content" rows="3" placeholder="What's on your mind, <?= htmlspecialchars($_SESSION['full_name'] ?? ''); ?>?" required></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="file" name="image" class="form-control form-control-sm w-50">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Feed -->
                <h4 class="mb-3">Newsfeed</h4>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="assets/images/<?= htmlspecialchars($post['profile_image'] ?? 'default.png'); ?>" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                    <div>
                                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($post['full_name']); ?></h6>
                                        <small class="text-muted">@<?= htmlspecialchars($post['username']); ?> • <?= $post['created_at']; ?></small>
                                    </div>
                                </div>
                                <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])); ?></p>
                                
                                <?php if (!empty($post['image'])): ?>
                                    <img src="assets/images/<?= htmlspecialchars($post['image']); ?>" class="img-fluid rounded mb-3" alt="Post Image">
                                <?php endif; ?>

                                <!-- Like Section -->
                                <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-2">
                                    <?php 
                                        $likeCount = LikeModel::getCountByPostId($post['id']);
                                        $hasLiked = LikeModel::hasLiked($post['id'], $_SESSION['user_id']);
                                    ?>
                                    <a href="index.php?route=toggle_like&post_id=<?= $post['id']; ?>" class="btn btn-sm <?= $hasLiked ? 'btn-danger' : 'btn-outline-secondary'; ?>">
                                        ❤️ Like (<?= $likeCount; ?>)
                                    </a>
                                </div>

                                <!-- Comments List -->
                                <div class="mt-3 bg-light p-2 rounded">
                                    <?php $comments = CommentModel::getByPostId($post['id']); ?>
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="d-flex mb-2 align-items-center">
                                            <img src="assets/images/<?= htmlspecialchars($comment['profile_image'] ?? 'default.png'); ?>" class="rounded-circle me-2" width="25" height="25" alt="Avatar">
                                            <div class="flex-grow-1 bg-white p-2 rounded shadow-sm" style="font-size: 0.9rem;">
                                                <strong><?= htmlspecialchars($comment['full_name']); ?>:</strong> 
                                                <span><?= htmlspecialchars($comment['content']); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Add Comment Form -->
                                    <form action="index.php?route=add_comment" method="POST" class="mt-2 d-flex">
                                        <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                                        <input type="text" name="content" class="form-control form-control-sm me-2" placeholder="Write a comment..." required>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Send</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No posts yet. Be the first to post something!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>