<table>
<tr>
    <td>
        <a href="index.php">Go to Homepage</a>        
        <a href="signup.php">SignUp</a>    
    </td>     
</tr> 
<form name="loginfrm" id="loginfrm" method="post" action="">
<tr>
    <td>         
        <label>Username :</label>  
    </td>
    <td>         
        <input type="text" id="username" name="username" maxlength="20">  
    </td> 
</tr>
<tr>
    <td>         
        <label>Password :</label>  
    </td>
    <td>      
        <input type="password" id="pass" name="pass" maxlength="20">
    </td> 
</tr> 
<?php 
if($error_message) {
?>
<tr>
    <td style="color:red" colspan="2"><?php echo $error_message;?></td>     
</tr>
<?php }?>
<tr>    
    <td align="center" colspan="2">              
        <input type="submit" name="submit" value="submit">
    </td> 
</tr>
</form>
</table>