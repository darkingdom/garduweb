<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex: 1;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #FFF;
        }

        #login {
            box-shadow: 0 0 5px #333;
            padding: 20px;
            border-radius: 5px;
        }

        .input-wrapper {
            padding: 8px 0;
        }

        .form-control {
            padding: 8px 10px;
            border: 1px solid #CCC;
            border-radius: 3px;
        }

        button {
            width: 100%;
            background-color: green;
            border: 0;
            color: #FFF;
            padding: 8px 0;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="login">
            <form action="<?= BASEURL ?>/member/login" method="POST">
                <div class="input-wrapper">
                    <input class="form-control" id="username" name="username" placeholder="Username" />
                </div>
                <div class="input-wrapper">
                    <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                </div>
                <div class="input-wrapper">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>