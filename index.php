<?php
include_once 'include/db_connect.php';
include_once 'include/functions.php';
sec_session_start();
if (login_check($mysqli)) {
    header('Location: ./calendar.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="styles/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger">';
                        switch ($_GET['error']) {
                                case "1":
                                    echo 'There is no such user or password';
                                    break;
                                default:
                                    echo 'An unknown error occured';
                            }
                    echo '</div>';
                }
                if (login_check($mysqli) == true) :
                    header('Location: ./calendar.php');
                else :
            ?>
            <form class="form-signin" action="process/login.php" method="post" name="login_form">
                <h2 class="form-signin-heading">Please sign in</h2>
                <input class="form-control"
                       type="text"
                       name="username"
                       placeholder="Username"
                       required
                       autofocus>
                <input class="form-control"
                       type="password"
                       name="password"
                       id="password"
                       placeholder="Password"
                       required>
                <br />
                <input type="button"
                       class="btn btn-lg btn-primary btn-block"
                       value="Login"
                       onclick="return login(this.form);">
                <p>If you don't have a login, please ask the HR for one</p>
            </form>
            <?php endif; ?>
        </div>
    </body>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/user.js"></script>
</html>
