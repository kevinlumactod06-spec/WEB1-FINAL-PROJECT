<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post - Social App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=newsfeed">MiniSocial</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?route=profile">Back to Profile</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h3 class="fw-bold mb-3">Edit Post</h3>
                    <form action="index.php?route=edit_post&id=<?= $post['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Content</label>
                            <textarea name="content" class="form-control" rows="4" required><?= htmlspecialchars($post['content']); ?></textarea>
                        </div>
                        
                        <?php if (!empty($post['image'])): ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Current Image</label>
                                <div>
                                    <img src="assets/images/<?= htmlspecialchars($post['image']); ?>" class="img-fluid rounded mb-2" style="max-height: 200px; object-fit: cover;" alt="Post Image">
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Change Image (Optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php?route=profile" class="btn btn-secondary btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>