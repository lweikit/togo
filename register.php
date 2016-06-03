<?php
include_once 'include/db_connect.php';
include_once 'include/functions.php';
sec_session_start();
if (!admin_login_check($mysqli)) {
    header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register a user</title>

        <!-- Bootstrap core CSS -->
        <link href="styles/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <!-- Registration form to be output if the POST variables are not
            set or if the registration script caused an error. -->
            <?php
                if (!empty($error_msg)) :
                    echo '<div class="alert alert-danger">';
                        echo $error_msg;
                    echo '</div>';
                endif;
                if (login_check($mysqli) == true) :
                        header('Location: ./calendar.php');
                    else :
            ?>
            <form action="process/register.php"
                    method="post"
                    name="registration_form"
                    class="form-signin">

                <h1 class="form-signin-heading">Register user</h1>
                <input class="form-control"
                       type="text"
                       name="username"
                       id="username"
                       placeholder="Username"
                       required
                       autofocus>
                <input class="form-control"
                       type="password"
                       name="password"
                       id="password"
                       placeholder="Password"
                       required>
                <input class="form-control"
                       type="password"
                       name="confirmpwd"
                       id="confirmpwd"
                       placeholder="Confirm Password"
                       required>
                <select class="form-control"
                        name="typelist"
                        required>
                  <option value="admin">Admin</option>
                  <option value="employee">Employee</option>
                </select>
                <br />
                <input type="button"
                       class="btn btn-lg btn-primary btn-block"
                       value="Register"
                       onclick="return regformhash(this.form);">
                <p>Already registered? <a href="index.php">Login here</a>.</p>
            </form>
            <?php endif; ?>
        </div>
    </body>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/user.js"></script>
</html>
