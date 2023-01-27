<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN AREA</title>
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
            background-color: #444;
        }

        #login {
            /* box-shadow: 0 0 5px #333; */
            padding: 20px;
            border-radius: 5px;
            width: 250px;
        }

        .input-wrapper {
            padding: 8px 0;
            width: 100%;
        }

        .form-control {
            padding: 8px 10px;
            border: 1px solid #444;
            /* border-radius: 3px; */
            width: 100%;
        }

        button {
            width: 100px;
            background-color: #444;
            border: 2px solid #FFF;
            color: #FFF;
            padding: 8px 0;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="login">
            <form action="<?= BASEURL ?>/admin/login" method="POST">
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