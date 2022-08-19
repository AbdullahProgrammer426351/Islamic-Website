<?php
echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Web</title>
</head>
<style>
    *{
    margin: 0;
    padding: 0;
    overflow: hidden;
}
#nav{
    display: flex;
    flex-direction: row;
    height: fit-content;
    width: 100%;
    padding: 10px;
    align-items: center;
    justify-content: center;
    background-color: blue;
}
#nav ul{
    display: flex;
    flex-direction: row;
    list-style: none;
}
#nav ul li a{
    text-decoration: none;
    color: white;
    font-size: 20px;
    margin: 20px;
}
</style>

<body>
    <nav id="nav">
        <ul>
            <li>
                <a href="#">Quran</a>
            </li>
            <li>
                <a href="#">Hadees</a>
            </li>
        </ul>
    </nav>
</body>

</html>';
?>