<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCP test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="container">
      <?php
        include "error.php";
        include "connection.php";
        
        if(isset($_POST['submit']))
        {
            // write a prepared statement to insert data
            $insert = $connection->prepare("insert into scp(subject, pic, image, item, class, keter, radix, infrared, description, containment) values(?,?,?,?,?,?,?,?,?,?)");
            $insert->bind_param("ssssssssss", $_POST['subject'], $_POST['pic'], $_POST['image'], $_POST['item'], $_POST['class'], $_POST['keter'], $_POST['radix'], $_POST['infrared'], $_POST['description'], $_POST['containment'],);
            
            if($insert->execute())
            {
                echo "
                    <div class='alert alert-success p-3'>Record successfully created</div>
                ";
            }
            else
            {
                // $insert->error for debug, data go to log
                echo "
                    <div class='alert alert-danger p-3'>Error: {$insert->error}</div> 
                ";
            }
        }
      
      ?>
    <h1>Create SCP</h1>
    <p><a href="index.php" class="btn btn-dark">Back to index page.</a></p>
    <div>
        <form method="post" action="create.php" class="form-grop">
            <label>Enter SCP Subject</label>
            <br>

            <input type="text" name="subject" placeholder="Subject..." class="form-control" required>
            <br>
            <label>Enter SCP Pic</label>
            <br>
            <input type="text" name="pic" placeholder="Image/nameOfImage.png" class="form-control" required>
            <br>
            <label>Enter SCP Image</label>
            <br>
            <input type="text" name="image" placeholder="Image/nameOfImage.png" class="form-control" required>
            <br>
            <label>Enter SCP Item</label>
            <br>
            <input type="text" name="item" placeholder="Item" class="form-control" required>
            <br>
            <label>Enter SCP Class</label>
            <br>
            <input type="text" name="class" placeholder="Class" class="form-control" required>
            <br>
            <label>Enter SCP Keter</label>
            <br>
            <input type="text" name="keter" placeholder="Keter" class="form-control" required>
            <br>
            <label>Enter SCP Radix</label>
            <br>
            <input type="text" name="radix" placeholder="Radix" class="form-control" required>
            <br>
            <label>Enter SCP Infrared</label>
            <br>
            <input type="text" name="infrared" placeholder="Infrared" class="form-control" required>
            <br>
            <label>Enter SCP Description</label>
            <br>
            <textarea name="description" class="form-control">Enter description:</textarea>
            <br>
            <label>Enter SCP Containment</label>
            <br>
            <textarea name="containment" class="form-control">Enter containment:</textarea>
            <br>
            <input type="submit" name="submit" class="btn btn-primary">
            
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>