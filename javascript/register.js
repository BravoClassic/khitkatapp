const form = document.querySelector(".signup form"),
    registerBtn = document.querySelector(".button input"),
    errorMessage = document.querySelector(".form form .error-text");


form.onsubmit = (e) => {
    e.preventDefault();
}

registerBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("POST", "includes/register.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == "success") {
                    location.href = "users.php";
                } else {
                    errorMessage.style.display = "block";
                    errorMessage.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form); //new form data object created
    xhr.send(formData); // sending the data to php
}