<table>
<tr> 
    <td>
       <a href="index.php">Go to Homepage</a>     
    </td>
    <td>
        <a href="login.php">Login</a>
    </td> 
</tr>    
<form name="signupfrm" id="signupfrm" method="post" action="">    
<tr>
    <td>
        <label>Enter Username :</label>    
    </td>
    <td>
       <input type="text" id="username" name="username">    
    </td> 
</tr>
<tr>
    <td>
        <label>Enter Email :</label>    
    </td>
    <td>
       <input type="text" id="email" name="email">    
    </td> 
</tr>
<tr>
     <td>
        <label>Enter Password :</label>    
    </td>
    <td>
       <input type="password" id="pass" name="pass">    
    </td> 
</tr>
<?php
if($success_message) {
?>
<tr>    
    <td colspan="2" align="center" style='color: red'>
       <?php echo $success_message;?>
    </td> 
</tr>
<?php
}
?>
<tr>    
    <td colspan="2" align="center">
       <input type="submit" id="submit" name="submit" value="Submit">    
    </td> 
</tr>
</form>
</table>