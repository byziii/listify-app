<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LISTIFY</title>
        <link rel="icon" href="{{ URL('images/listify.png') }}" type="image/x-icon"/>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F9FA;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.8em;
            font-weight: bold;
            padding: 25px;
        }
        .logo-icon {
            width: 50px;
            height: 50px;
            vertical-align: middle;
            margin-right: 20px;
            border-radius: 15%;
        }
        .container {
            text-align: center;
            padding: 50px 20px;
            margin-top: 10%;
        }
        h1 {
            font-size: 3.7em;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.7em;
            margin-bottom: 50px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1.3em;
            color: #fff;
            background-color: #002f6c;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #555;
        }
    </style>
    </head>
    <body>
        <div class="logo">
            <img src="{{ URL('images/listify.png') }}" class="logo-icon" alt="Logo Icon"> LISTIFY
        </div>
        <div class="container">
            <h1>Your path of productivity<br>start here.</h1>
            <p>Make Every Moment Count.</p>
            <form method="POST" action="/todo">
            <a href="#" class="button" onclick="redirectToTasks()">Get started</a>
            </form>
            </div>
        </div>
        <script>
            function redirectToTasks() {
                window.location.href = '/tasks'; // Redirect to tasks page
            }
        </script>
    </body>
</html>