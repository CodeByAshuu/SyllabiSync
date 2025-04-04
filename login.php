<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AICTE Portal</title>
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign up</h1>
            <form>
                <div class="input-area">
                    <div class="input-field" id="namefield">
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="input-field" id="phonefield">
                        <input type="tel" placeholder="Phone no." pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    </div>
                    <div class="input-field" id="emailfield">
                        <input type="text" placeholder="Email address">
                    </div>
                    <div class="input-field" id="passwordfield">
                        <input type="password" placeholder="Password" pattern="(?=.*\d).{6,}" required>
                    </div>
                    <div class="input-field" id="forgotpasswordfield" style="max-height: 0; overflow: hidden;">
                        <a href="#" id="forgotPasswordLink">Forgot Password?</a>
                    </div>
                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn">Sign up</button>
                    <button type="button" id="signinBtn" class="disable">Sign in</button>
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

            function showSignInFields() {
                namefield.style.maxHeight = "0";
                phonefield.style.maxHeight = "0";
                emailfield.style.maxHeight = "60px";
                passwordfield.style.maxHeight = "60px";
                forgotpasswordfield.style.maxHeight = "60px";
                title.innerHTML = "Sign In";
                signupBtn.classList.add("disable");
                signinBtn.classList.remove("disable");
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
    </script>
</body>
</html>