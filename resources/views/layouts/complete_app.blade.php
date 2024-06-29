<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Tasks</title>
    <style>
        /* Add the same styles here as in index.blade.php */
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
            display: flex;
            height: 80%;
            width: 70%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .username {
            font-size: 1.2em;
            font-weight: bold;
        }

        .menu {
            flex-grow: 1;
        }

        .menu-item {
            margin: 20px;
            display: flex;
            align-items: center;
            padding: 10px 0;
            cursor: pointer;
            font-size: 1.2em;
        }

        .menu-item:hover {
            background-color: #ddd;
        }

        .icon {
            margin-right: 30px;
        }

        .new-list-button {
            width: 100%;
            padding: 10px;
            font-size: 1.2em;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .new-list-button:hover {
            background-color: #555;
        }

        .main-content {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        h1 {
            margin-top: 30px;
            font-size: 2em;
            margin-left: 40px;
        }

        hr {
            border: 0;
            border-top: 1px solid #333;
            margin: 20px;
        }

        .add-task {
            display: flex;
            align-items: center;
            width: 80%;
            justify-content: center;
            margin: 0 auto;
            margin-top: auto;
            margin-bottom: 30px;
        }

        .task-input {
            flex-grow: 1;
            padding: 10px;
            font-size: 1.2em;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }

        .add-task-button {
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .add-task-button:hover {
            background-color: #555;
        }

        .edit-btn, .remove-btn {
            font-size: 10px;
            padding: 1px;
        }

        .todo-table {
            width: 95%;
            margin: 1px auto;
            border-collapse: collapse;
        }

        .todo-table th, .todo-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .todo-table th {
            background-color: #f0f0f0;
        }

        .th2 {  
            width: 20%;
        }
        
        .th3 {
            text-align: center;
            width: 10%;
        }

        .todo-table-container {
            max-height: 300px; /* Adjust the height as needed */
            overflow-y: auto;
            width: 100%;
            margin: 1px auto;
        }

        .todo-table thead, .todo-table tbody tr {
            width: 100%;
            table-layout: fixed;
        }

        .todo-table-container::-webkit-scrollbar {
            width: 5px;
        }

        .todo-table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .todo-table-container::-webkit-scrollbar-thumb {
            background: #888;
        }

        .todo-table-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>