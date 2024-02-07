<?php 
function console($output){
    echo '<script>console.log('. json_encode($output, JSON_HEX_TAG).');</script>';
}

$connection = new mysqli("localhost", "root", "", "ecom");
if ($connection->connect_error)
    die("Connection to database failed: " . $connection->connect_error);

if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == 'insertAsset'){
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
    }
}

$connection->close(); 

//combine steps: prepare statement, binding, execute, get result
//parameters: query to execute, data type of the inputs clause, input param that match with number of data type
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