<?php include("includes/header.php");
include("includes/class_encription.php");


 ?>
<div class="container">
    <div class="row">
        <div class="icon-blk">          
            <?php 
          
                if(isset($_GET['path'])){
                    $res = scan($_GET['path']);     
                }else{
                    $res = scan(ROOTPATH);  
                }
              // print_r($res);die;
                foreach ($res as $inarray) {
                    if($inarray['type'] == "file"){
                      //  print_r($inarray['path']);die;
                   // echo "<a class='media-icon' href='gal_list.php?path=".encrypt_decrypt('encrypt', $inarray['path'])."'>".$inarray['name']."</a>";
                        echo "<a href='gal_list.php'>".$inarray['name']."</a><br>";
                    }
                    else if($inarray['type'] == "folder"){  
                                            
                        echo "<a class='media-icon' href='gal_list.php?path=".encrypt_decrypt('encrypt', $inarray['path'])."'>".$inarray['name']."</a>";
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
