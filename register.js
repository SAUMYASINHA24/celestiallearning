function validation()
{    
    var error = [];
    var uname = document.getElementsByName("username")[0].value;
 
    var password = document.getElementsByName("password")[0].value;
    
    var confirm_password = document.getElementsByName("confirm_password")[0].value;
    
    var email = document.getElementsByName("email")[0].value;

    
    var emailpattern = /^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;   //Regex for email validation
    
    if(uname.length==0)
    {
       alert("Username should not be empty");
       document.register_form.username.focus() ; 
       return false;   
    }

    
    if(!emailpattern.test(email))
    {
        alert("Invalid Email id");
        document.register_form.email.focus();
        return false;
    }

    if(password.length==0 || confirm_password.length==0)
    {
        alert("Passwords can't be empty.");
        document.register_form.password.focus();
        return false;
    }

    if(password!=confirm_password)
    {

        alert("Passwords do not match.");
        return false;
    }
    if(password.length>72)
    {
        error.push("Password length must be less than 72 characters");
    }   
    
	if (password.length < 8)
	{
		error.push("Password must be 8 charecters long.");
	}
	
	if (password.search(/[0-9]/) < 0)
	{
		error.push("Password must contain at least one digit.");
	}
	if (password.search(/[A-Z]/) < 0)
	{
		error.push("Password must contain at least one uppercase letter.");
	}
	if (password.search(/[a-z]/) < 0)
	{
		error.push("Password must contain at least one lowercase letter.");
	}
	if (password.search(/[!@#$%^&*_]/) < 0)
	{
		error.push("Password must contain at least one special symbol.");
    }
    
    if(error.length>0)
    {
        alert(error.join("\n"));
        document.register_form.password.focus();
        return false;
    }
}