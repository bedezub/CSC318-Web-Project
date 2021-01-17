<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/loginstyles.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <form id="form" class="form" method="POST">
            <div class="form-control">
                <label for="username">Student ID</label>
                <input type="text" placeholder="2018" id="username" />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="username">Password</label>
                <input type="password" placeholder="Password" id="password"/>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="acc-exist-wrapper">
                <p class="acc-exist">
                    <a href="../registrationpage/registration.html">Register an account</a>
                </p>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>