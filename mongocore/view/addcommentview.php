<?php
$comment_arr = (isset($blogData['comment']))?$blogData['comment']:'';
$tags = ($blogData && $blogData['tags'])?implode(',',$blogData['tags']):'';
?>
<table>  
<tr>
    <td>
        <a href="index.php">Go to Homepage</a>          
    </td>     
</tr>      
<form name="addcommentfrm" id="addcommentfrm" method="post" action="">
<tr>
    <td>Title :</td> 
    <td><?php echo $blogData['title'];?></td> 
</tr>
<tr>
    <td>Body :</td> 
    <td><?php echo $blogData['body'];?></td> 
</tr> 
<tr>
    <td>Tags :</td> 
    <td><?php echo $tags;?></td> 
</tr>
<tr>
    <td colspan="2">
        <label>Add Comment :</label>    
    </td>    
</tr>
<tr>
    <td>
        <label>Name :</label>
    </td>
    <td>
        <input type="text" id="name" name="name"> 
    </td>
</tr>
<tr>
    <td>
        <label>Email :</label>
    </td>
    <td>
        <input type="text" id="email1" name="email1">
    </td>
 </tr>
 <tr>
     <td>
        <label>Comment :</label>
    </td>
    <td>
        <textarea id="comment" name="comment"></textarea> 
    </td>    
</tr>
<tr>    
    <td colspan="2" align="center">
       <input type="submit" id="submit" name="submit" value="Submit">    
    </td> 
</tr>
</form>
  
<?php 
if($comment_arr && sizeof($comment_arr)>0) {
?>
 <tr>
    <td colspan="2">
        <label>Previous Comments :</label>
    </td>    
 </tr>
<?php    
    foreach($comment_arr as $comment) {
?>
 <tr>
    <td>
        <?php echo $comment['content'];?>
    </td>
    <td>
        <?php echo 'by--- '.$comment['name'];?>
    </td>
 </tr>   
<?php   
    }
}
?>
</table>