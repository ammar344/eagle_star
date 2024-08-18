<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>
<body>
<form action="server.php" method="post" enctype="multipart/form-data">
    Product Name: <input type="text" name="product_name"><br>
    Select Image: <input type="file" name="img"><br>
    Product Price: <input type="text" name="product_price"><br>
    <input type="hidden" name="cmd" value="upload">
    <button name="upload">Upload</button>
</form>

<br>
<br>
<form action="server.php" method="post" enctype="multipart/form-data">
    Product Name: <input type="text" name="featured_name"><br>
    Select Image: <input type="file" name="featured-img"><br>
    Product Price: <input type="text" name="featured_price"><br>
    <input type="hidden" name="cmd" value="featuredUpload">
    <button name="featuredUpload">Upload</button>
</form>

</body>
</html>