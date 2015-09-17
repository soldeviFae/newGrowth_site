<?php include $_SERVER['DOCUMENT_ROOT'].'/scripts/startScript.php';
  $sql='SELECT * FROM projects WHERE shortName = ? LIMIT 1';
  $shortName = $_GET['name'];
   
  /* Prepare statement */
  $stmt = $db->prepare($sql);
  if($stmt === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $db->error, E_USER_ERROR);
  }
   
  /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
  $stmt->bind_param('s',$shortName);
   
  /* Execute statement */
  $stmt->execute();

  $stmt->bind_result($id, $shortName, $fullName, $tags, $content, $description, $creationUser, $timeStamp, $editUser, $editTimeStamp, $thumbnail, $enabled);
  while ($stmt->fetch()) {
    $title = $fullName;
  }

  include $_SERVER['DOCUMENT_ROOT'].'/header.php';
 ?>
            <div id='clearMain' class='clearBox'>
                <div id='contentArea' class='insetBox fullContent'>
              
             
                        <?php if ($admin==1 && $clientView != 1) { ?>
                          <div class='contentEdit'>
                            <a href='/editProject.php?action=edit&id=<?php echo $id; ?>'><img src='/img/editBtn.png' alt='edit button' /></a>
                            <a href='/deleteProject.php?id=<?php echo $id; ?>'><img src='/img/deleteBtn.png' alt='edit button' /></a>
                          </div>
                        <?php } ?>    
                     <h1><?php echo $fullName; ?></h1>
                     <article class='fullContent'>
                         <div class='date'>
                             <?php echo date('j.n.Y',$timeStamp); ?>
                         </div>
                         <div class='details fullDetails'>
                             <div class='articleContent'>
                                 <?php echo $content; ?>
                             </div>
                             <div class='muted inArticleMute'>-<?php echo $creationUser; ?></div>
                         </div>
                     </article>          
                </div>
                <!--<div class='specialProject insetBox'>
                    <h3>Latest Projects</h3>
                    <?php
                      $sql='SELECT * FROM projects LIMIT 8';
                       
                      /* Prepare statement */
                      $stmt = $db->prepare($sql);
                      if($stmt === false) {
                        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $db->error, E_USER_ERROR);
                      }
                        
                      /* Execute statement */
                      $stmt->execute();

                      $stmt->bind_result($id, $shortName, $fullName, $tags, $content, $creationUser, $timeStamp, $editUser, $editTimeStamp, $thumbnail);
                      while ($stmt->fetch()) {
                    ?>
                    <div class='specialProjectBox clearBox'>
                        <a href='/project/<?php echo $shortName; ?>' class='sideProjectLink'>
                            <img src='<?php echo $thumbnail; ?>' alt='<?php echo $fullName; ?>' class='projectThumb' />
                            <div class='projectName'><?php echo $fullName; ?></div>
                            <div class='projectTags'><?php echo $tags; ?></div>
                        </a>
                    </div>
                    <?php }
                    ?> 
 
                </div>     -->              
            </div>
        </div>
        <?php include 'footer.php'; ?>
        <script>
            if ($(window).width() > 900) {
              parseAndFill('proceduralArea','leftSide','rightSide','middleArea');
            } else {
              $('#proceduralArea').css('background','url(../img/mobileBg.png) center bottom');
            }
        </script>
    </body>
</html>
