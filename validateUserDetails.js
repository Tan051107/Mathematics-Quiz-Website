const form = document.getElementById("user-details-form");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fName = document.getElementById("fname").value;
    const lName = document.getElementById("lname").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;

    let isValid = true;

    document.getElementById("fname-error").textContent = "";
    document.getElementById("lname-error").textContent = "";
    document.getElementById("email-error").textContent = "";
    document.getElementById("phone-error").textContent = "";

    //Validate first name
    const nameRegex = /^[a-zA-Z]{1,30}$/;
    if (!nameRegex.test(fName)) {
        document.getElementById("fname-error").textContent = 
            "First name must be 1-30 letters.";
        isValid = false;
    }

    //Validate last name
    if (!nameRegex.test(lName)) {
        document.getElementById("lname-error").textContent = 
            "Last name must be 1-30 letters.";
        isValid = false;
    }

    //Validate email
    const emailRegex = /^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,3})$/;
    if (!emailRegex.test(email)) {
        document.getElementById("email-error").textContent = 
            "Invalid email address.";
        isValid = false;
    }

    //Validate phone number
    const phoneRegex = /^01[0-9]{8,9}$/;
    if (!phoneRegex.test(phone)) {
        document.getElementById("phone-error").textContent = 
            "Phone must be 10 or 11 digits.";
        isValid = false;
    }

    if (isValid) {
        alert("Profile details updated successfully!");
        form.submit();
    }
});


