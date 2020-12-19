function validation()
{
    var error = [];
    var password = document.reset_form.new_pass.value;
    var confirm_password = document.reset_form.confirm_pass.value;
    if(password!=confirm_password)
    {
        alert("Passwords do not match.")
        document.reset_form.new_pass.focus();
        return false;
    }
    if(password.length==0 || confirm_password.length==0)
    {
        alert("Passwords can't be empty.");
        document.reset_form.new_pass.focus();
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
        document.reset_form.new_pass.focus();
        return false;
    }
}       