
document.addEventListener('DOMContentLoaded', function() {
    var loc = ""+ window.location;
    var arr = loc.split('/');
    var page = arr[arr.length-1];

    if(page == "index.php" || page == ""){
        var data = new FormData();
        data.append('action', 'retrieveAssetDashb');
    
        var assetList = runAjax(data, 'json');
        
        var data = "";
        for(i=0; i<assetList.length; i++){
            data += `<div class=itemCard data-aid="`+assetList[i][0]+`" onclick='window.location = "edititem.php"; editpage(this)'>
                <div class="itemCardInner">
                    <div class="itemCardFront">
                        <img src="`+assetList[i][3]+`" alt="stock img">
                    </div>
                    <div class="itemCardBack">
                        <h5>`+assetList[i][1]+`</h5>
                        <p>`+assetList[i][2]+`</p>
                    </div>
                </div>
            </div>`;
        }

        document.getElementById('itemContainer').innerHTML = data;
    }
    else if(page == "edititem.php"){
        aid = localStorage.getItem('aid');

        var data = new FormData();
        data.append('action', 'retrieveAssetEdit');
        data.append('aid', aid);

        var asset = runAjax(data, 'json');

        if(asset != ""){
            document.getElementById('aid').value = asset.aid;
            document.getElementById('name').value = asset.name;
            document.getElementById('category').value = asset.category;
            document.getElementById('vendor').value = asset.vendor;
            document.getElementById('desc').value = asset.description;
            document.getElementById('qty').value = asset.qty;
            document.getElementById('price').value = asset.price;
            document.getElementById('date').value = asset.date;
            document.getElementById('pic').src = asset.pic;
        }
    }
})

function insert(){

    aname = document.getElementById('name').value;
    category = document.getElementById('category').value;
    vendor = document.getElementById('vendor').value;
    desc = document.getElementById('desc').value;
    qty = document.getElementById('qty').value;
    price = document.getElementById('price').value;

    d = new Date();
    addDate = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();

    pic = document.getElementById('pic').src;

    var data = new FormData();
    data.append('action', 'insertAsset');
    data.append('name', aname);
    data.append('category', category);
    data.append('vendor', vendor);
    data.append('desc', desc);
    data.append('qty', qty);
    data.append('price', price);
    data.append('date', addDate);
    data.append('pic', pic);

    var response = runAjax(data, 'html');
    if(response == "1"){
        alert("Asset added!"); //+ JSON.stringify(a)
        window.location = "index.php";
    } 

}

function editpage(asset){
    localStorage.setItem('aid', asset.getAttribute('data-aid'));
}

function update(){
    aid = document.getElementById('aid').value;
    aname = document.getElementById('name').value;
    category = document.getElementById('category').value;
    vendor = document.getElementById('vendor').value;
    desc = document.getElementById('desc').value;
    qty = document.getElementById('qty').value;
    price = document.getElementById('price').value;

    d = new Date();
    editDate = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();

    pic = document.getElementById('pic').src;

    var data = new FormData();
    data.append('action', 'updateAsset');
    data.append('aid', aid);
    data.append('name', aname);
    data.append('category', category);
    data.append('vendor', vendor);
    data.append('desc', desc);
    data.append('qty', qty);
    data.append('price', price);
    data.append('date', editDate);
    data.append('pic', pic);

    var response = runAjax(data, 'html');

    if(response == "1"){
        document.getElementById('date').value = editDate;
        alert("Asset updated!");
    }else console.log(response)
    
}

function remove(){
    var aid = document.getElementById('aid').value;

    var data = new FormData();
    data.append('action', 'removeAsset');
    data.append('aid', aid);

    response = runAjax(data, 'html')

    if(response == "1"){
        alert("Asset "+aid+" deleted!");
        window.location = "index.php";
    }else console.log(response)
    
}

function preview(event){
    var reader = new FileReader();
    reader.onload = function(){
        var image = document.getElementById('pic');
        image.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);

}

function runAjax(data, dataType){
    var result = "";
    $.ajax({
        type: "POST",
        url: 'backend.php',
        data: data,
        processData: false,
        contentType: false,
        async: false,
        dataType: dataType,
        success: function(response){
            // console.log(response);
            if(dataType=='html'){
                if(response.includes("Connection to database failed") || response.includes("No connection could be made")){
                    alert("Connection to database failed");
                    result = "";
                }
                else if(response.includes("max_allowed_packet")){
                    alert("The total file size to submit is too large");
                    result = "";
                }
                else if(response.includes("Unknown database 'uvms'")){
                    alert("Database is not created!");
                    result = "";
                }
                else if(response.includes("bind_param() on bool")){
                    alert("Execution of query failed!");
                    result = "";
                }
                else
                    result = response;
            }
            else
                result = response;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            // if got error such as response is not valid JSON, run again in html to know true error
            response2 = runAjax(data, 'html');
        } 
    });
    return result;
}
