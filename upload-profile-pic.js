const fileInput = document.getElementById('profile-pic-input');
const uploadButton = document.getElementById('upload-profile-pic-button');
document.getElementById("invalid-photo message").textContent = "";


fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const maxFileSize =  2* 1024 * 1024; //allowed maximum file size
        const allowedFormat = ["image/jpeg", "image/png"]; //allowed photo format

        if (!allowedFormat.includes(file.type)){
            document.getElementById("invalid-photo message").textContent = "Invalid photo format";
            fileInput.value ="";
            return 
        }
        if (file.size > maxFileSize){
            document.getElementById("invalid-photo message").textContent = "Invalid file size";
            fileInput.value ="";
            return 
        }

        uploadFile(fileInput.files[0]);
        document.getElementById("invalid-photo message").textContent = "";
    }
});

function uploadFile(file) {
    const formData = new FormData();
    formData.append("uploadfile", file);

    fetch("", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        

        if (result.includes("File uploaded successfully")) {
            const uploadedFileName = file.name; 


            const timestamp = new Date().getTime();
            document.getElementById("profilePic").src = "./profilepic/" + uploadedFileName + "?t=" + timestamp;
        }
    })
    .catch(error => {
        echo("Upload failed!");
    });
}

