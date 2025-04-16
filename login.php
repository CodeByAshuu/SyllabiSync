<?php include 'db/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SyllabiSync Portal</title>
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign up</h1>
            <form method="POST" action="db/signup.php" id="authForm">
                <div class="input-area">
                    <div class="input-field" id="namefield">
                        <input type="text" name="name1" placeholder="Your Name" required>
                    </div>
                    <div class="input-field" id="phonefield">
                        <input type="tel" name="phone" placeholder="Phone no." pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    </div>
                    <div class="input-field" id="emailfield">
                        <input type="text" name="email" placeholder="Email address" required>
                    </div>
                    <div class="input-field" id="passwordfield">
                        <input type="password" name="password" placeholder="Password" pattern="(?=.*\d).{6,}" required>
                    </div>
                    <div class="input-field" id="forgotpasswordfield" style="max-height: 0; overflow: hidden;">
                        <a href="#" id="forgotPasswordLink">Forgot Password?</a>
                    </div>
                </div>
                <div>
                    <a href="#" id="admin">Login as Admin?</a>
                    <a href="#" id="faculty">Login as Faculty?</a>

                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn" name="signUp">Sign up</button>
                    <button type="button" id="signinBtn" name= "signIn" class="disable">Sign in</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let signupBtn = document.getElementById("signupBtn");
            let signinBtn = document.getElementById("signinBtn");
            let namefield = document.getElementById("namefield");
            let phonefield = document.getElementById("phonefield");
            let emailfield = document.getElementById("emailfield");
            let passwordfield = document.getElementById("passwordfield");
            let forgotpasswordfield = document.getElementById("forgotpasswordfield");
            let title = document.getElementById("title");
            
            let authForm = document.getElementById("authForm");

            function showSignInFields() {
                namefield.style.maxHeight = "0";
                phonefield.style.maxHeight = "0";
                emailfield.style.maxHeight = "60px";
                passwordfield.style.maxHeight = "60px";
                forgotpasswordfield.style.maxHeight = "60px";
                title.innerHTML = "Sign In";
                signupBtn.classList.add("disable");
                signinBtn.classList.remove("disable");

                // 🔁 Change form action to signin
                authForm.setAttribute("action", "db/signup.php");
            }

            function showSignUpFields() {
                namefield.style.maxHeight = "60px";
                phonefield.style.maxHeight = "60px";
                emailfield.style.maxHeight = "60px";
                passwordfield.style.maxHeight = "60px";
                forgotpasswordfield.style.maxHeight = "0";
                title.innerHTML = "Sign up";
                signupBtn.classList.remove("disable");
                signinBtn.classList.add("disable");

                // 🔁 Change form action to signup
                authForm.setAttribute("action", "db/signup.php");
            }

            signinBtn.onclick = function () {
                showSignInFields();
            };

            signupBtn.onclick = function () {
                showSignUpFields();
            };

            
            showSignUpFields();

            let forgotPasswordLink = document.getElementById("forgotPasswordLink");
            forgotPasswordLink.addEventListener("click", function (event) {
                event.preventDefault();
                
                alert("Forgot Password clicked!");
            });
        });

        document.querySelector("form").addEventListener("submit", function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const actionUrl = form.getAttribute("action");

            fetch(actionUrl, {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                showNotification(data.message, data.success);
                if (data.success) {
                    setTimeout(() => {
                        window.location.href = "landing_page.php";
                    }, 1000);
                }
            })
            .catch(() => {
                showNotification("Something went wrong. Try again.", false);
            });
        });

        function showNotification(msg, isSuccess) {
            let notif = document.createElement("div");
            notif.innerText = msg;
            notif.style.position = "fixed";
            notif.style.bottom = "30px";
            notif.style.left = "50%";
            notif.style.transform = "translateX(-50%)";
            notif.style.background = isSuccess ? "#4CAF50" : "#f44336";
            notif.style.color = "#fff";
            notif.style.padding = "10px 20px";
            notif.style.borderRadius = "6px";
            notif.style.boxShadow = "0 2px 10px rgba(0,0,0,0.2)";
            notif.style.fontSize = "14px";
            notif.style.zIndex = "1000";

            document.body.appendChild(notif);
            setTimeout(() => notif.remove(), 3000);
        }

    </script>
</body>
</html>