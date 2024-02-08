<html>
    <header>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>E-Commerce</title>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <h3>Edit Asset</h3>

        <img id="pic" src="" alt="stock img">
        <input type="file" accept="image/png, image/jpeg, image/jpg" onchange="preview(event)"><br>
        <table>

        </table>
        <form name="editform">
            <label for="aid">Asset ID:</label>
            <input type="text" id="aid" name="aid" readonly><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"><br> 
            <label for="vendor">Vendor:</label>
            <input type="text" id="vendor" name="vendor"><br> 
            <label for="desc">Description:</label>
            <textarea id="desc" name="desc" rows="2" cols="50"></textarea><br>
            <label for="qty">Quantity:</label>
            <input type="number" id="qty" name="qty"><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price"><br>
            <label for="date">Last Modified:</label>
            <input type="text" id="date" name="date" readonly><br>
        </form>
        <button onclick="update()">Save</button>
        <button onclick="remove()">Delete</button>
        <button class="" onclick='window.location = "index.php"'>Return</button>
    </body>
</html>