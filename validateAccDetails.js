const form = document.getElementById("account-details-form");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const username = document.getElementById("username-input").value;
    const password = document.getElementById("accPassword").value;

    let isValid = true;

    document.getElementById("username-error").textContent = "";
    document.getElementById("password-error").textContent = "";

    //Validate username
    const usernameRegex = /^[a-zA-Z0-9]{3,15}$/;
    if (!usernameRegex.test(username)) {
        document.getElementById("username-error").textContent = 
            "The length of username should be between 3 to 15 and doesn't contain any space or symbol";
        isValid = false;
    }

    //Validate password
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,12}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById("password-error").textContent = 
            "Password length must be between 8 to 12. Password should contain at least one uppercase letter, lowercase letter, digit and special symbol";
        isValid = false;
    }

    if (isValid) {
        alert("Account details updated successfully!");
        form.submit();
    }
});

