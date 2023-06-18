<?php
if (isset($_SESSION['id'])) {
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["title"] ?> - Login</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-4 artwork">
                    <div class="artwork-image" style="margin-top: 100px;"></div>
                </div>
                <div class="col-md-8 iya">
                    <h2>Sign in</h2>
                    <div class="divider"></div>
                    <span></span>
                    <form name="login" onsubmit="return login1()">
                        <div class="form-field">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username">

                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <p class="auth-link">
                            Not a member? <a href="/signup">Sign up now</a>
                        </p>
                        <input class="button form-sub" type="submit" value="Log in">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        let message = document.getElementsByTagName("span")[0];

        function login1() {
            window.event.preventDefault();

            let username = document.getElementById("username");
            let password = document.getElementById("password");

            message.innerHTML = "";

            if (username.value == "") {
                message.innerHTML += "Username can't be blank <br>";
                username.setAttribute("class", "fieldWithErrors");
            }

            if (password.value == "") {
                message.innerHTML += "Password can't be blank <br>";
                password.setAttribute("class", "fieldWithErrors");
            }

            if (message.innerHTML == "") {
                var data = {
                    username: username.value,
                    password: password.value,
                }

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/api/login", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.response)
                        alert(response.message)
                        if (response.status == 1) window.location.href = "/";
                    }
                };
                xhr.send(JSON.stringify(data));
            }
        }
    </script>
</body>

</html>