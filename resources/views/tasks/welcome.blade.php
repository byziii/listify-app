<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LISTIFY</title>

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F9FA;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            padding: 50px 20px;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #555;
        }
        .logo-text {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
    </head>
    <body>
        <div class="logo-text">LISTIFY</div>
        <div class="container">
            <h1>Your path of productivity<br>start here.</h1>
            <p>Make Every Moment Count.</p>
            <form method="POST" action="/todo">
            <a href="#" class="button">Get started</a>
            </form>
            </div>
        </div>
    </body>
</html>