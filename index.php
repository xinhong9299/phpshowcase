<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="padding-bottom: 10em">

    <div class="container">
        <h3>INSERT</h3>
        <div class="form-group">
        <label for="value">Value</label>
        <input type="text" name="value" id="value" class="form-control" placeholder="">
        <label for="value2">Value 2</label>
        <input type="text" name="value2" id="value2" class="form-control" placeholder="">
        <br>
        <div id="insert" class="btn btn-primary">INSERT</div>
        </div>

        <h3>REMOVE</h3>
        <div class="form-group">
        <label>ID</label>
        <input type="text" id="removeID" class="form-control" placeholder="">
        <div id="remove" class="btn btn-primary">DELETE</div>
        <br>
        </div>

        <h3>VIEW</h3>
        <div class="form-group">
        <label>ID</label>
        <input type="text" id="viewID" class="form-control" placeholder="">
        <label for="value">Value</label>
        <input type="text" name="value" id="viewValue" class="form-control" placeholder="">
        <label for="value2">Value 2</label>
        <input type="text" name="value2" id="viewValue2" class="form-control" placeholder="">
        <br>
        <div id="view" class="btn btn-primary">VIEW</div>
        </div>

        <h3>UPDATE</h3>
        <div class="form-group">
        <label>ID</label>
        <input type="text" id="updateID" class="form-control" placeholder="">
        <label for="value">Value</label>
        <input type="text" name="value" id="updateValue" class="form-control" placeholder="">
        <label for="value2">Value 2</label>
        <input type="text" name="value2" id="updateValue2" class="form-control" placeholder="">
        <br>
        <div id="update" class="btn btn-primary">UPDATE</div>
        </div>

        <h3>VIEW ALL</h3>
        <div class="form-group">
        <button class="btn btn-primary" id="viewAll">SHOW ALL</button>
        <br><br>
        <textarea id="result" cols=100 rows=10></textarea>
        </div>
        
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<script>

$('#insert').click(function (e) { 
    e.preventDefault();
    insert();
});

$('#remove').click(function (e) { 
    e.preventDefault();
    remove();
});

$('#view').click(function (e) { 
    e.preventDefault();
    view();
});

$('#update').click(function (e) { 
    e.preventDefault();
    update();
});

$('#viewAll').click(function (e) { 
    e.preventDefault();
    viewAll();
});


function insert(){
    $.ajax({
        type: "post",
        url: "../includes/server/index.php",
        data: {
            action: 'insert',
            value: $('#value').val(),
            value2: $('#value2').val()
        },
        success: function (response) {
            alert('Success')
        }
    });
}

function remove(){
    $.ajax({
        type: "post",
        url: "../includes/server/index.php",
        data: {
            action: 'remove',
            id: $('#removeID').val(),
        },
        success: function (response) {
            alert('Success')
        }
    });
}

function view(){
    $.ajax({
        type: "post",
        url: "../includes/server/index.php",
        data: {
            action: 'viewSelected',
            id: $('#viewID').val(),
        },
        success: function (response) {
            $('#viewValue').val(response.results[0].value);
            $('#viewValue2').val(response.results[0].value2);
        }
    });
}

function update(){
    $.ajax({
        type: "post",
        url: "../includes/server/index.php",
        data: {
            action: 'update',
            id: $('#updateID').val(),
            value: $('#updateValue').val(),
            value2: $('#updateValue2').val()
        },
        success: function (response) {
            alert('Success')
        }
    });
}

function viewAll(){
    $.ajax({
        type: "post",
        url: "../includes/server/index.php",
        data: {
            action: 'viewAll',
        },
        success: function (response) {
          $('#result').val(JSON.stringify(response, null, 2));
        }
    });
}

</script>