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
                    <h2>Sign up</h2>
                    <div class="divider"></div>
                    <span></span>
                    <form action="login.php" method="POST">
                        <div class="form-field">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" autofocus autocomplete="email">

                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" autocomplete="username">

                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">

                            <label for="password_confirmation">Re-Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation">
                        </div>
                        <p class="auth-link">
                            Already a member? <a href="/login">Log in now</a>
                        </p>
                    </form>
                    <button class="button form-sub" onclick="signup()" id="iyakok">Sign Up</button>
                </div>
            </div>
        </div>
    </main>
    <script>
        let message = document.getElementsByTagName("span")[0];

        function signup() {
            let email = document.getElementById("email");
            let username = document.getElementById("username");
            let password = document.getElementById("password");
            let password2 = document.getElementById("password_confirmation");

            message.innerHTML = "";

            if (email.value === "") {
                message.innerHTML += "Email can't be blank <br>";
                email.setAttribute("class", "fieldWithErrors");
            }
            if (username.value === "") {
                message.innerHTML += "Username can't be blank <br>";
                username.setAttribute("class", "fieldWithErrors");
            } else if (!validate(username.value)) {
                message.innerHTML += "Please yes";
                username.setAttribute("class", "fieldWithErrors");
            }
            if (password.value === "") {
                message.innerHTML += "Password can't be blank <br>";
                password.setAttribute("class", "fieldWithErrors");
            }
            if (password2.value === "") {
                message.innerHTML += "Password Confirmation can't be blank <br>";
                password2.setAttribute("class", "fieldWithErrors");
            } 
            if (password.value != password2.value) {
                message.innerHTML += "Password is not match <br>";
                password2.setAttribute("class", "fieldWithErrors");
            }
            var data = {
                email: email.value,
                username: username.value,
                password: password.value,
                password2: password2.value,
            }
            if (message.innerHTML == "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/api/signup", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.response)
                        alert(response.message)
                        if (response.status == 1) window.location.href = "/login";
                    }
                };
                xhr.send(JSON.stringify(data));
            }
        }

        function validate(username) {
            var pattern = /^[a-z0-9]{3,15}$/;
            return pattern.test(username);
        }
    </script>
</body>

</html>