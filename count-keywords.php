<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <h3> YOUTUBE KEYWORDS </h3>
    </header>
    <main>
        <div class="tab">
            <a href="index.php">Get YouTube Keywords</a>
            <a href="count-keywords.php">Count Keywords</a>
        </div>
        <div class="menu center">
            <form action="count-keywords.php" method="post" enctype="multipart/form-data">  
                <input type="submit" value="Upload CSV File" name="uploadFileBtn"><br>
                <input type="file" id="fileToUpload" name="fileToUpload">

                <input type="submit" value="Count Keywords" name="countKeywordsBtn">
                <label>Please enter the csv file name to count keywords: </label>
                <input type='text' id='fileName' name='fileName'>

                <input type="submit" value="List Uploaded Files" name="listFileBtn"></br>
                
                <input type="submit" value="Delete File" name="deleteFileBtn"></br>
                <input type='text' id='deleteFile' name='deleteFile'>
            </form>
        </div>
        <?php 
            function countKeywords($file_name) {
                $target_dir = "uploads/";
                $csv_file = $target_dir . trim($file_name);
                echo('csv file path: ' . $csv_file);
                $res = shell_exec("python count-keywords.py $csv_file");
                return $res;
            }
          
            function uploadFile($file_name) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($file_name);
                $uploadOk = 1;
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry files already exists </br>";
                    $uploadOk = 0;
                } 

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large </br>";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if($fileType != "csv") {
                    echo "Sorry, only csv file is allowed </br>";
                    $uploadOk = 0;
                }
                return $uploadOk;
            }    

            function listUploads() {
                $dir = 'uploads';
                $files = scandir($dir);
                for ($i=3; $i < sizeof($files); $i++) { 
                  echo '<div style="font-size: x-large">';  
                  echo $files[$i];
                  echo '</div>';  
                }
            }  

            function deleteFile($file_name) {
                echo"Delete FILE";
                $dir = 'uploads/'.$file_name;
                unlink($dir);
            }

            // List uploaded files
            if(isset($_POST["listFileBtn"])) {  
                echo '<label>Result: </label>';
                listUploads(); 
            }  

            // Delete a file
            if(isset($_POST["deleteFileBtn"]) && !empty($_POST["deleteFile"])) {  
                echo "DELETE FILE not in func";
                $deleteFile = trim($_POST["deleteFile"]);
                echo $deleteFile;
                deleteFile($deleteFile);
            }  

            // Count keywords of an uploaded file
            if(!empty($_POST["fileName"]) &&  isset($_POST["countKeywordsBtn"])) {  
                $res = countKeywords($_POST["fileName"]);    
                echo '<label>Result: </label>';
                echo " <textarea id='tags' name='tags' rows='20' cols='50'> " . $res . "</textarea>";
            }  

            // Upload a new file 
            if(!empty($_FILES["fileToUpload"]) &&  isset($_POST["uploadFileBtn"])) {   
                $new_file = $_FILES["fileToUpload"]["name"];
                $uploadOk = uploadFile($new_file);
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded </br>";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";       
                    } else {
                        echo "Sorry, there was an error uploading your file </br>";
                    }
                }
            } 


        ?>
    </main>
</body>
</html>
