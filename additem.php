<html>
    <header>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>E-Commerce</title>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <h3>Add Asset</h3>
        <form name="addform">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <!-- dropdown select -->
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"><br> 
            <label for="vendor">Vendor:</label>
            <input type="text" id="vendor" name="vendor"><br> 
            <label for="desc">Description:</label>
            <textarea id="desc" name="desc" rows="2" cols="50"></textarea><br>
            <label for="qty">Quantity:</label>
            <input type="number" id="qty" name="qty" value="0"><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="0.00"><br>
            <label for="price">Image File (.png, .jpeg, .jpg) </label>
            <input type="file" accept="image/png, image/jpeg, image/jpg" onchange="preview(event)"><br>
            <img id="pic" src="image/default.png" alt="stock img">
        </form>
        <button onclick="insert()">Add</button>
        <button class="" onclick='window.location = "index.php"'>Return</button>
    </body>
</html>