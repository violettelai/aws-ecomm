<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

function console($output){
    echo '<script>console.log('. json_encode($output, JSON_HEX_TAG).');</script>';
}

// $connection = new mysqli("localhost", "root", "", "ecom");

define('DB_SERVER', 'ecom-phase1-db.cticka8yo4jf.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'adminecom');
define('DB_NAME', 'ecom');
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection->connect_error)
    die("Connection to database failed: " . $connection->connect_error);


if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == 'checkTableExist'){
        $table = mysqli_real_escape_string($connection, "asset");
        $db = mysqli_real_escape_string($connection, "ecom");
        $checktableexist = mysqli_query($connection, "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$table' AND TABLE_SCHEMA = '$db'");

        if(mysqli_num_rows($checktableexist) == 0)
        {
            $query = "CREATE TABLE asset (
            aid INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            category VARCHAR(50) NOT NULL,
            vendor VARCHAR(50) NOT NULL,
            description TEXT,
            qty INT,
            price DECIMAL(10,2),
            date DATETIME NOT NULL,
            pic LONGBLOB
            );";

            if(!mysqli_query($connection, $query)) echo "-1";
            else echo "0";
        } else echo "1";

    }else if($action == 'insertAsset'){
        $name = $_POST['name'];
        $category = $_POST['category'];
        $vendor = $_POST['vendor'];
        $desc = $_POST['desc'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $pic = $_POST['pic'];

        $query = "INSERT INTO asset (name, category, vendor, description, qty, price, date, pic) values (?, ?, ?, ?, ?, ?, ?, ?);";
        $dataType = "ssssssss";
        $param = array($name, $category, $vendor, $desc, $qty, $price, $date, $pic);
        $result = getQueryResult($query, $dataType, $param);

        echo "1";

    }else if($action == 'retrieveAssetDashb'){
        $query = "SELECT aid,name,category,pic FROM asset;";
        $result = getQueryResult($query, "", "");

        $assetList = array();
        while($row = $result->fetch_assoc()){
            $asset = array();
            array_push($asset, $row['aid']);
            array_push($asset, $row['name']);
            array_push($asset, $row['category']);
            array_push($asset, $row['pic']);
            array_push($assetList, $asset);
        }

        echo json_encode($assetList);

    }else if($action == 'retrieveAssetEdit'){ 
        $aid = $_POST['aid'];
        $query = "SELECT * FROM asset WHERE aid=?;";
        $dataType = "s";
        $param = array($aid);
        $result = getQueryResult($query, $dataType, $param);
        echo json_encode($result->fetch_assoc());

    }else if($action == 'updateAsset'){
        $aid = $_POST['aid'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $vendor = $_POST['vendor'];
        $desc = $_POST['desc'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $pic = $_POST['pic'];

        $query = "UPDATE asset SET name=?, category=?, vendor=?, description=?, qty=?, price=?, date=?, pic=? WHERE aid =?;";
        
        $dataType = "sssssssss";
        $param = array($name, $category, $vendor, $desc, $qty, $price, $date, $pic, $aid);
        $result = getQueryResult($query, $dataType, $param);
        echo "1";
        
    }else if($action == 'removeAsset'){
        $aid = $_POST['aid'];

        $query = "DELETE FROM asset WHERE aid=?;";
        $dataType = "s";
        $param = array($aid);
        $result = getQueryResult($query, $dataType, $param);

        echo "1"; 

    }else if($action == 'test'){
        echo "test from backend";
    }
}

$connection->close(); 

function getQueryResult($query, $dataType, $param){
    global $connection;
    $statement = $connection->prepare($query);
    if(strlen($dataType)>0)
        $statement->bind_param($dataType, ...$param);
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}

?>