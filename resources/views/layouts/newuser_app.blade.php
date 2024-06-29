<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #002f6c;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #f0f0f0;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 400px;
            height: 400px;
            text-align: center;
        }

        .container h1 {
            margin-bottom: 20px;
        }

        form {
            margin-top: 10%;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            margin-left: 10%;
            text-align: left;
        }

        form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form button {
            width: 30%;
            margin-top: 10%;
            padding: 10px;
            background-color: #002f6c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #011C48;
        }

        .login {
            margin-top: 20px;
        }

        .login a {
            color: #002f6c;
            text-decoration: none;
        }

        .login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
