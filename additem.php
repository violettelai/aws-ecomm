<html>
    <header>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>E-Commerce</title>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <h3 class="title">Add Asset</h3>
        <div class="holder">
            <form name="addform">
                <table>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><input type="text" id="name" name="name"></td>
                    </tr>
                    <tr>
                        <td><label for="category">Category</label></td>
                        <td><input type="text" id="category" name="category"></td>
                    </tr>
                    <tr>
                        <td><label for="vendor">Vendor</label></td>
                        <td><input type="text" id="vendor" name="vendor"></td>
                    </tr>
                    <tr>
                        <td><label for="desc">Description</label></td>
                        <td><textarea id="desc" name="desc" rows="2" cols="50"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="qty">Quantity</label></td>
                        <td><input type="number" id="qty" name="qty" value="0"></td>
                    </tr>
                    <tr>
                        <td><label for="price">Price</label></td>
                        <td><input type="number" id="price" name="price" value="0.00"></td>
                    </tr>
                    <tr>
                        <td><label for="price">Image File (.png, .jpeg, .jpg) </label></td>
                        <td><input type="file" accept="image/png, image/jpeg, image/jpg" onchange="preview(event)"></td>
                    </tr>
                </table>

                <div class="holder">
                    <img id="pic" src="image/default.png" alt="stock img">
                </div>
            </form>
        </div>
        <div class="holder">
            <button class="button" onclick="insert()">Add</button>
            <button class="button" class="" onclick='window.location = "index.php"'>Return</button>
        </div>
    </body>
</html>