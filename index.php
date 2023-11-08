<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:title" content="SCP" />
    <meta property="og:description" content="Assessment1" />
    <meta property="og:image" content="https://30038401.2023.labnet.nz/images/scpins.jpg" />
    <meta property="og:url" content="https://30038401.2023.labnet.nz/index.html" />
    <meta property="og:type" content="website" />

    <title>Home Page</title>
    <link rel="stylesheet" href="./css/homePage.css">
</head>

<body>
    <?php 
        include "error.php";
        include "connection.php"; 
      ?>
    <div class="header">

         <a href="index.php"><img src="./images/logo.png" alt="Logo" class="logo"></a>
            <div class="menu-icon"><img src="./images/menuHome.png" alt="menu"> </div>
            <div class="mobile-nav">
                <div class="close-icon">X</div> <!-- 新增的元素 -->
                <?php foreach($result as $link): ?>  <!-- grab result and save as new link -->
                <div class="nav">
                    <!--get 'subject' as link name -->
                  <a href="https://30038401.2023.labnet.nz/assessment3/index.php?link=<?php echo $link['subject']; ?>" class="nav-link text-light"><?php echo $link['subject']; ?></a>
                </div>
                <?php endforeach; ?>
                
                <input type="text" placeholder="Search..." class="search">
            </div>
        <div class="desktop-nav"> 
            <?php foreach($result as $link): ?>  <!-- grab result and save as new link -->
                <div class="nav">
                    <!--get 'subject' as link name -->
                  <a href="https://30038401.2023.labnet.nz/assessment3/index.php?link=<?php echo $link['subject']; ?>" class="nav-link text-light"><?php echo $link['subject']; ?></a>
                </div>
                <?php endforeach; ?>
            
            <div class="header-right">
                <button onclick="window.location.href='create.php';" class="login">Create SCP</button>
            </div>
        </div>
    </div>
    <div>
        <?php
            //use isset to check if 'link' exist
            if(isset($_GET['link']))
            {
                $subject = $_GET['link'];
                
                // prepared statement
                $stmt = $connection->prepare("select * from scp where subject = ?");
                if(!$stmt)
                {
                    echo "<p>Error in preparing SQL statement</p>";
                    exit;
                }
                $stmt->bind_param("s", $subject);
                
                if($stmt->execute())
                {
                    $result = $stmt->get_result();
                    
                    // check if a record has been retrieved
                    if($result->num_rows > 0) //表示查询结果集中的行数。如果行数大于0，即查询返回至少一行数据
                    {
                        $array = array_map('htmlspecialchars', $result->fetch_assoc()); //当存在一行或多行结果时，fetch_assoc() 方法被调用来从结果集中取出下一行作为关联数组。
                        //htmlspecialchars 函数被用来转义 $array 变量中的特殊字符
                        $update = "update.php?update=" . $array['id'];
                        $delete = "index.php?delete=" . $array['id'];
                        
                        echo "
                            
                            <div class='top-pic'>
                            <img src='{$array['image']}' alt='{$array['subject']}'
                            </div>
                            
                            <div class='item002'>
                                <div class='item002-1'>
                                    <h2>ITEM#:</h2>
                                    <H1>{$array['item']}</H1>
                                    <div class='item-gap'>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class='item-level'>
                                        <p>LEVEL ??</p> 
                                        <p>{$array['class']}</p>
                                    </div>
                                    
                                </div>
                                <div class='item002-2'></div>
                                <div class='item002-3'>
                                    <div class='item-class1'>
                                        <div class='class-left'>
                                            <div class='class-containment'>
                                                
                                                <p>CONTAINMENT CLASS:</p>
                                                <h4>KETER</h4>
                                            </div>
                                            <div class='class-containment2'>
                                                <p>SECONDARY CLASS:</p>
                                                <h4>RADIX</h4>
                                            </div>
                                        </div>
                                        <div class='icon-1'>
                                            <img src='{$array['keter']}' alt='keter'>
                                        </div>
                                        <div class='icon-2'>
                                            <img src='{$array['radix']}' alt='keter'>
                                        </div>
                                    </div>
                        
                                    <div class='item-class2'>
                                        <div class='class-containment3'>
                                            <div>
                                                <p>DISRUPTION CLASS:</p>
                                                <h4>INFRARED</h4>
                                            </div>                    
                                            <div class='icon-3'>
                                                <img src='{$array['infrared']}' alt='keter'>
                                            </div>
                                        </div>
                                        <div class='class-containment4'>
                                            <div>
                                                <p>RISK CLASS:</p>
                                                <h4>CRYPTIC</h4>
                                            </div>
                                            <div class='icon-4'>
                                                <img src='./images/Cryptic.svg' alt='keter'>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='item-class3'>
                                        <div class='icon-top'>
                                            <img src='{$array['keter']}' alt='keter'>
                                        </div>
                                        <div class='icon-center'>
                                            <div class='icon-left'>
                                                <img src='{$array['radix']}' alt='keter'>
                                            </div>
                                            <div class='icon-right'>
                                                <img src='{$array['infrared']}' alt='keter'>
                                            </div>
                                        </div>
                                        
                                        <div class='icon-down'>
                                            <img src='./images/Cryptic.svg' alt='keter'>
                                        </div>
                                    </div>
                                </div>
                        
                                
                            </div>
                            
                            <div class='scp-content'>
                                <p><strong>Description: </strong>{$array['description']}</p>
                                <p><strong>Containment:</strong>{$array['containment']}</p>
                                <div class='udBTN'>
                                    <div class='updateBTN'>
                                    <a href='{$update}' class='btn btn-info'>Update Record</a>
                                    </div>
                                    <div class='deleteBTN'>
                                    <a href='{$delete}' class='btn btn-warning'>Delete Record</a>
                                    </div>
                                </div>
                                
                            </div>
                        ";
                    }
                    else
                    {
                        echo "<p>No record found for subject: {$array['subject']}</p>"; 
                    }
                    
                }
                else
                {
                    echo "<p>Error executing the statement</p>";
                }
            }
            
            //index.php content
            else
            {
                echo "
                <div class='content'>
                    <div class='left-section'>
            
                        <p class='introduction'><strong>WARNING:</strong> THE FOUNDATION DATABASE IS</p>
                        <h1>CLASSIFIED</h1>
                        <p>UNAUTHORIZED PERSONNEL WILL BE</p>
                        <h3>TRACKED, LOCATED, AND DETAINED</h3>
                        <div class='social-icon'>
                            
                            <img src='./images/icon1.png' alt='icon' >
                            <img src='./images/icon2.png' alt='icon' >
                            <img src='./images/icon3.png' alt='icon' >
                            <img src='./images/icon4.png' alt='icon' >
                        </div>
                    </div>
                    
                    
                </div>
                ";
            }
            
            //delete record
            if(isset($_GET['delete']))
            {
                $delID = $_GET['delete'];
                $delete = $connection->prepare("delete from scp where id=?");
                $delete->bind_param("i", $delID);
                
                if($delete->execute())
                {
                    echo "<div class='alert alert-warning'>Recorded Deleted...</div>";
                }
                else
                {
                    echo "<div class='alert alert-danger'>Error deleting record {$delete->error}.</div>";
                }
            }
        ?>
    </div>
    
    <script src="./js/homeMenu.js"></script>
</body>

</html>
