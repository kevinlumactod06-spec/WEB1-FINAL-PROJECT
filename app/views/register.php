<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | WEB1 Final Project</title>

    <link rel="stylesheet" href="../../public/assets/css/style.css">

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">
                🌐
            </div>

            <h1>Create Account</h1>

            <p class="subtitle">
                Join our mini social network
            </p>


            <form method="POST" action="?page=register_process">


                <!-- FULL NAME -->

                <div class="form-group">

                    <label for="full_name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                <!-- USERNAME -->

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Choose a username"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a password"
                        required
                    >

                </div>


                <!-- CONFIRM PASSWORD -->

                <div class="form-group">

                    <label for="confirm_password">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Confirm your password"
                        required
                    >

                </div>


                <!-- REGISTER BUTTON -->

                <button type="submit">
                    Register
                </button>

            </form>


            <p class="register-text">

                Already have an account?

                <a href="?page=login">
                    Login
                </a>

            </p>

        </div>

    </div>

</body>

</html>