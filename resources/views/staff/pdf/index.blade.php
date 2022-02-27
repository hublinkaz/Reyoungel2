<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>How to Export HTML to Pdf in Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-size: 14px;
        background-image: linear-gradient(315deg, #9fa4c4 0%, #9e768f 74%);
        font-family: sans-serif;
        background-size: cover;
    }

    h1 {
        font-size: 22px;
    }

    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        padding: 30px;
        background: #fff;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 15px;
        50px rgba(0, 0, 0, .2)
    }

    .image {
        width: 200px;
        height: 200px;
        background: url(authr.jpg);
        background-size: cover;
        float: left;
        margin: 30px 30px 30px 0;
    }
</style>
<body>


<div class="navbar navbar-expand-lg navbar-light bg-light print-hide">
    <a class="navbar-brand" href="#">Laravel Export PDF</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a href="javascript:void(0)" class="nav-link" onclick="export2Pdf()">Download PDF</a>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="image"></div>
    <h1>Some Random Text Title Content</h1>
    <div class="content">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dicta dolorem, expedita
            ipsum maiores quas sapiente vero. Beatae dolore dolores ducimus eos, iusto laborum possimus quibusdam
            reprehenderit
            soluta vero voluptatibus?. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores atque,
            blanditiis consequuntur cupiditate, delectus ea facilis ipsam laborum magni maiores molestiae natus porro quod
            recusandae saepe sequi sint!. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto esse facere
            ipsum ratione. Adipisci animi cumque eligendi excepturi harum praesentium quia. Aperiam cum, error molestiae quae
            quaerat repudiandae unde?. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consequatur culpa cum
            debitis deserunt dolor, et expedita fugiat labore minus modi nam nostrum provident quam quasi quo veniam voluptas
            voluptates.
        </p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
