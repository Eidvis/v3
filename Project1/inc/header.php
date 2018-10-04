<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>File Manager</title>
  </head>
  <body>
  <div class="container">
        <div class="jumbotron m-1 p-3"  style="background-color: #cccccc">
            <div class="row">
                <div class="col-md-9">
                <h1>File Manager</h1> 
                </div>
                <div class="col-md-3 m-0">
                    <h6 style="float: right !important;">Logout</h6>
                </div>
            </div>
        </div>  
    <div class="row">
        <div class="col-sm form-group rounded m-1 ml-3 p-4" style="background-color: #e6e6e6">
            <form>
                <label for="newFile"><h5 class="text-secondary">Create new .txt file</h5></label>
                <input type="text" class="form-control" id="newFile" name="filename" value="">
                <br>