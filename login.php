<?php include('Parsial/connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.MJT</title>
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/login.css">

</head>
<body>
    <div id="response" class="alert alert-success" style="display:none;">
    <a href="#" class="close" data-bs-dismiss="alert"><i class="fa-solid fa-circle-xmark"></i></a>
    <div class="message"></div>
    </div>
    <div id="login">
        <h2>Selamat Datang</h2>
        <form id="login-form" method="post">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="username" id="username-label">
                    Username
                </label>
                <input type="text"
                name="username"
                id="username"
                class="form-control"
                placeholder="Masukkan Username"
                required/>
            </div>
            <div class="form-group">
                <label for="password" id="password-label">
                    Password
                </label>
                <input type="password"
                name="password"
                id="password"
                class="form-control"
                placeholder="Masukkan Password"
                required/>
            </div>
            <div>
            <label>
			</label>
            </div>
            <div class="form-group-custom">
                <button type="submit" id="btn_login" class="submit-button">Login</button>
            </div>
        </form>
    </div>
    <?php include 'Parsial/footer.php';
    ?>