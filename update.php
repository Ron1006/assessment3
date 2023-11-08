<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="container">
      <?php
        include "error.php";
        include "connection.php";
        
        if(isset($_GET['update']))
        {
            $id = $_GET['update'];
            $recordID = $connection->prepare("select * from scp where id = ?");
            if(!$recordID)
            {
                echo "<div class='alert alert-danger g-3 m-2'>Error preparing record for updating</div>";
                exit;
            }
            
            $recordID->bind_param("i", $id);
            if($recordID->execute())
            {
                echo "<div class='alert alert-success g-3 m-2'>Record ready for updating</div>";
                $temp = $recordID->get_result();
                $row = $temp->fetch_assoc();
            }
            else
            {
                echo "<div class='alert alert-danger g-3 m-2'>Error:{$recordID->error}</div>";
            }
        }
        
        if(isset($_POST['update']))
        {
            // write a prepared statement to insert data
            $update = $connection->prepare("update scp set subject=?, pic=?, image=?, item=?, class=?, keter=?, radix=?, infrared=?, description=?, containment=? where id=?");
            $update->bind_param("ssssssssssi", $_POST['subject'], $_POST['pic'], $_POST['image'], $_POST['item'], $_POST['class'], $_POST['keter'], $_POST['radix'], $_POST['infrared'], $_POST['description'], $_POST['containment'], $_POST['id'] );
            
            if($update->execute())
            {
                echo "
                    <div class='alert alert-success p-3'>Record successfully update</div>
                ";
            }
            else
            {
                // $insert->error for debug, data go to log
                echo "
                    <div class='alert alert-danger p-3'>Error: {$update->error}</div> 
                ";
            }
        }
      
      ?>
    <h1>Update SCP</h1>
    <p><a href="index.php" class="btn btn-dark">Back to index page.</a></p>
    <div>
        <form method="post" action="update.php" class="form-group">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Update Subject</label>
            <br>
            <input type="text" name="subject" placeholder="Subject..." class="form-control" required value="<?php echo $row['subject']; ?>">
            <br>
            <label>Update Pic</label>
            <br>
            <input type="text" name="pic" placeholder="Image/nameOfImage.png" class="form-control" required value="<?php echo $row['pic']; ?>">
            <br>
            <label>Update Image</label>
            <br>
            <input type="text" name="image" placeholder="Image/nameOfImage.png" class="form-control" required value="<?php echo $row['image']; ?>">
            <br>
            <label>Update Item</label>
            <br>
            <input type="text" name="item" placeholder="Item" class="form-control" required value="<?php echo $row['item']; ?>">
            <br>
            <label>Update Class</label>
            <br>
            <input type="text" name="class" placeholder="Class" class="form-control" required value="<?php echo $row['class']; ?>">
            <br>
            <label>Update Keter</label>
            <br>
            <input type="text" name="keter" placeholder="Keter" class="form-control" required value="<?php echo $row['keter']; ?>">
            <br>
            <label>Update Radix</label>
            <br>
            <input type="text" name="radix" placeholder="Radix" class="form-control" required value="<?php echo $row['radix']; ?>">
            <br>
            <label>Update Infrared</label>
            <br>
            <input type="text" name="infrared" placeholder="Infrared" class="form-control" required value="<?php echo $row['infrared']; ?>">
            <br>
            <label>Update Description</label>
            <br>
            <textarea name="description" class="form-control"><?php echo $row['description']; ?></textarea>
            <br>
            <label>Update Containment</label>
            <br>
            <textarea name="containment" class="form-control"><?php echo $row['containment']; ?></textarea>
            <br>
            <input type="submit" name="update" class="btn btn-primary">
            
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>