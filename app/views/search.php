<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Users - Social App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=newsfeed">MiniSocial</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?route=newsfeed">Home</a>
                <a class="nav-link" href="index.php?route=profile">Profile</a>
                <a class="nav-link text-danger" href="index.php?route=logout">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="index.php" method="GET" class="input-group mb-4">
                    <input type="hidden" name="route" value="search">
                    <input type="text" name="q" class="form-control" placeholder="Search users by name or username..." value="<?= htmlspecialchars($query ?? ''); ?>" required>
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
                <h4 class="mb-3">Search Results</h4>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                        <div class="card shadow-sm mb-2">
                            <div class="card-body d-flex align-items-center">
                                <img src="assets/images/<?= htmlspecialchars($u['profile_image'] ?? 'default.png'); ?>" class="rounded-circle me-3" width="40" height="40" alt="Avatar">
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= htmlspecialchars($u['full_name']); ?></h6>
                                    <small class="text-muted">@<?= htmlspecialchars($u['username']); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (!empty($query)): ?>
                    <p class="text-muted">No users found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>