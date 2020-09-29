<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      
      echo "<pre>";
      print_r($_FILES['image']);
      echo "</pre>";

      echo basename($_FILES['image']['name']);
      echo "<br>";
      echo $file_ext;

   }
?>
<html>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" />
    </form>
</body>

</html>