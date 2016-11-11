<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gallery</title>
        <link rel="shortcut icon" type="image/png" href="favicon.png"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/script.js" type="text/javascript"></script>
       
        
    </head>
    <body>
        <form action="addphoto.php" method="post" enctype="multipart/form-data" id="photo">
            <input type="file" name="photo"/>
            <input type="submit"/>
        </form>  
        <div class="gallery"></div>
    </body>
</html>
