<table>
<?php
if($username) {
?>
<tr> 
    <td colspan='2'>
        <a href="blogpost.php">Post a blog</a>   
    </td>
    <td>
        <a href="logout.php">Logout</a>   
    </td> 
</tr>  
<?php
} else {
?>
<tr> 
    <td colspan="3">
        <a href="login.php">Login</a>   
    </td>    
</tr>  
<?php
}
?>
<tr>   
    <td>
        <label>Username</label>   
    </td> 
    <td>
        <label>Title</label>   
    </td>
    <td>
        <label>Body</label>   
    </td>
</tr>
<?php
if($allusers) {
  foreach($allusers as $user) {   
?>
<tr>   
    <td>
        <a href="addcomment.php?blogid=<?php echo $user['_id'];?>"><?php echo $user['user'];?></a>    
    </td>
    <td><?php echo $user['title'];?></td> 
    <td><?php echo $user['body'];?></td> 
</tr> 
<?php
  } 
}else {
?>
<tr>
    <td colspan='3'>No Record Found</td>
</tr>
<?php
}
?>
</table>