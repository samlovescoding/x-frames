<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>An error occurred</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body{
            height: 100%;
            display:flex;
            flex-direction: column;
            justify-content: center;
        }
        h1{
            font-family:'Segoe UI Light', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 100;
            font-size: 72px;
            text-align:center;
        }
        p{
            font-family:'Segoe UI Light', Tahoma, Geneva, Verdana, sans-serif;
            text-align:center;

        }
    </style>
    <script src="/main.js"></script>
</head>
<body>
    <h1>
        <?php
            if(isset($title)){
                echo $title;
            }else{
                echo "Some Error Occurred";
            }
        ?>
    </h1>
    <p>
        Entropy: <?=rand(100000, 999999)?>
    </p>
</body>
</html>