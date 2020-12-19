<html>
    <head>
            <script type="text/javascript" src="../../js/reset_verify.js"></script>
    </head>
    <?php 
        $email = $_GET["t1"];
    ?>
        <form action = "reset_verify.php" name = "reset_form" method ="POST" onsubmit="return validation();">
            New Password <input type = "password" name = "new_pass">
            Confirm Password <input type="password" name = "confirm_pass">
            <input type = "hidden" name = "email" value="<?php echo $email;?>">
            <button type="submit">Submit</button>           
        </form>
    </body>
</html>







