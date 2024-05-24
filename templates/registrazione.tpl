<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"],
        select, /* Added select here */
        button {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        button {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus { /* Added select here */
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Registrazione</h1>
    <form action="registrazione.php" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <select name="type">
            <option value="1">Administrator</option>
            <option value="2">Capo Gruppo</option>
            <option value="3">Utente</option>
        </select>
        <button type="submit" name="register">Registrati</button>
        <p>Hai un account? <a href="index.php">Accedi</a></p>
    </form>
</div>

</body>
</html>
