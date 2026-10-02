<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | WEB1 Final Project</title>

    <link rel="stylesheet" href="../../public/assets/css/style.css">

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">
                🌐
            </div>

            <h1>WEB1 FINAL PROJECT</h1>

            <p class="subtitle">
                Mini Social Networking Web Application
            </p>

            <form method="POST" action="index.php?page=login">

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>

                <button type="submit">
                    Login
                </button>

            </form>

            <p class="register-text">

                Don't have an account?

                <a href="index.php?page=register">Register</a>
                 

            </p>

        </div>

    </div>

</body>

</html>