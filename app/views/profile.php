<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - Social App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .cover-container {
            position: relative;
            height: 250px;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            border-radius: 0 0 10px 10px;
        }
        .profile-avatar-container {
            position: relative;
            margin-top: -75px;
            margin-bottom: 15px;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=newsfeed">MiniSocial</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?route=newsfeed">Home</a>
                <a class="nav-link" href="index.php?route=search">Search</a>
                <a class="nav-link active" href="index.php?route=profile">Profile</a>
                <a class="nav-link text-danger" href="index.php?route=logout">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Facebook-style Profile Header Section -->
    <div class="bg-white shadow-sm mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 px-0">
                    <!-- Cover Photo -->
                    <div class="cover-container"></div>
                    
                    <!-- Profile Info Row -->
                    <div class="d-flex flex-column flex-md-row align-items-center align-items-md-end px-4 pb-4">
                        <!-- Profile Picture -->
                        <div class="profile-avatar-container text-center text-md-start">
                            <img src="assets/images/<?= htmlspecialchars($user['profile_image'] ?? 'default.png'); ?>" class="rounded-circle profile-avatar bg-white" alt="Avatar">
                        </div>
                        
                        <!-- Name & Username -->
                        <div class="ms-md-4 mb-3 mb-md-0 text-center text-md-start flex-grow-1">
                            <h2 class="mb-0 fw-bold"><?= htmlspecialchars($user['full_name'] ?? ''); ?></h2>
                            <p class="text-muted mb-0">@<?= htmlspecialchars($user['username'] ?? ''); ?></p>
                        </div>
                        
                        <!-- Edit Profile Button -->
                        <div class="mb-3 mb-md-0">
                            <button class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Bio Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">About</h5>
                        <p class="card-text text-secondary"><?= nl2br(htmlspecialchars($user['bio'] ?? 'No bio yet.')); ?></p>
                    </div>
                </div>

                <!-- My Posts Section -->
                <h4 class="mb-3 fw-bold">My Posts</h4>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted"><?= $post['created_at']; ?></small>
                                    <div>
                                        <!-- Edit and Delete Buttons -->
                                        <a href="index.php?route=edit_post&id=<?= $post['id']; ?>" class="btn btn-outline-secondary btn-sm me-1">Edit</a>
                                        <a href="index.php?route=delete_post&id=<?= $post['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Sigurado ka bang gusto mong burahin ang post na ito?');">Delete</a>
                                    </div>
                                </div>
                                <p class="card-text mt-2"><?= nl2br(htmlspecialchars($post['content'])); ?></p>
                                <?php if (!empty($post['image'])): ?>
                                    <img src="assets/images/<?= htmlspecialchars($post['image']); ?>" class="img-fluid rounded mb-3 w-100" style="max-height: 400px; object-fit: cover;" alt="Post Image">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card shadow-sm text-center p-4">
                        <p class="text-muted mb-0">You haven't posted anything yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="index.php?route=update_profile" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bio</label>
                            <textarea name="bio" class="form-control" rows="3" placeholder="Tell something about yourself..."><?= htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Profile Picture</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>