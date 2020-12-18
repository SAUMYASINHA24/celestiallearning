function validation() {

    var oldpassword = document.getElementsByName("OldPassword")[0].value;

    var newpassword = document.getElementsByName("NewPassword")[0].value;

    var confirmnewpassword = document.getElementsByName("ConfirmNewPassword")[0].value;


    if (oldpassword.length == 0 || newpassword.length == 0 || confirmnewpassword.length == 0) {
        alert("Passwords can't be empty.");
        return false;
    }


    if (newpassword == oldpassword) {

        alert("New Password cannot be same as Old Password!.");
        return false;
    }

    if (newpassword != confirmnewpassword) {

        alert("Passwords do not match.");
        return false;
    }

    if (newpassword.length > 72) {
        alert("Password length must be less than 72 characters");
        return false;
    }
}