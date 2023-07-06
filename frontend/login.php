<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout html</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.scss">

    <style>
        .navbar {
            background-color: #1b2e3f !important;
            margin-bottom: 100px;
        }

        .btn-success {
            background-color: #119c13;
        }

        .btn-primary {
            background-color: #119c13;
        }

        .btn-outline-success:hover {
            background-color: #119c13;
        }


        .card {
            margin-bottom: 15px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #222;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 600px;
            margin: 0 auto;
            padding: 50px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            color: #b38bff;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-size: 18px;
        }

        input {
            padding: 12px;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #555;
        }

        button {
            padding: 10px;
            background-color: #b38bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #8c5fb2;
        }

        a {
            text-decoration: none;
            color: #b38bff;
            font-size: 18px;
            transition: color 0.2s ease-in-out;
        }

        a:hover {
            color: #8c5fb2;
        }

        p {
            text-align: center;
            margin: 8px;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container" id="login-form">
            <div class="logo">
                <img src="ezoom.svg" alt="" srcset="">
            </div>
            <h1>Fotos</h1>
            <form>
                <input type="text" value="user" hidden>
                <label for="username">Email</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <p>Não tem uma conta ? <a href="#" id="signup-link">Criar</a></p>
        </div>

        <div class="form-container" id="signup-form" style="display: none;">
            <h1>Criar conta</h1>
            <form>
                <label for="new-username">Nome </label>
                <input type="text" id="new-username" name="new-username" required>
                <label for="new-email">Email</label>
                <input type="email" id="new-email" name="new-email" required>
                <label for="new-password">Senha</label>
                <input type="password" id="new-password" name="new-password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Já tem uma conta ? <a href="#" id="login-link">Login</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script>
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        const loginLink = document.getElementById('login-link');
        const signupLink = document.getElementById('signup-link');

        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            signupForm.style.display = 'none';
            loginForm.style.display = 'block';

            setTimeout(() => {
                signupForm.style.opacity = 0;
                loginForm.style.opacity = 1;
            }, 10);
        });

        signupLink.addEventListener('click', (event) => {
            event.preventDefault();
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';

            setTimeout(() => {
                loginForm.style.opacity = 0;
                signupForm.style.opacity = 1;
            }, 10);
        });
    </script>
</body>

</html>