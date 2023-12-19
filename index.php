<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/l ibs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="../asset/images/logoG.png" type="image/x-icon">
    <title>Register Page</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="./app/controllers/register.php">
                <h1>Create Account</h1>
                <div class="inputsdiv">
                  <div>
                    <input name="name" type="text" placeholder="Name">
                    <input name="email" type="email" placeholder="Email">
                    <div id="email-error" class="error-message"></div>

                    <input name="password" type="password" placeholder="Password">
                  </div>
                  <button name="signup" type="submit">Sign Up</button>
              </div>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="./app/controllers/register.php">
                <h1>Log In</h1>
                <div class="inputsdiv">
                  <div>
                    <input name="email" type="email" placeholder="Email">
                    <input name="password" type="password" placeholder="Password">
                  </div>
                  <button type="submit" name="login">Log In</button>
              </div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Already have an accont!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>First time on O'Pep!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src=" ./assets/js/script.js"></script>
</body>

</html>