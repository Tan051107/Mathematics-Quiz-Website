function logOutConfirmation(){
    let confirmation = "Confirm to log out?";
    if (confirm(confirmation)==true){
        window.location.href = "logout.php";
    }
    else{
        return;
    }

}