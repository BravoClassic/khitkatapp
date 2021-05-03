const form = document.querySelector(".login form"),
    registerBtn = document.querySelector(".button input"),
    errorMessage = document.querySelector(".form form .error-text");


form.onsubmit = (e) => {
    e.preventDefault();
}

registerBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("POST", "includes/login.inc.php", true);
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

function showNotification() {
    var notification = new Notification("Thank you! - Khitkhat", {
        body: "This is a notification from Khitkhat!",
        icon: "images/icon/icon.png"
    });
}

window.onload = () => {
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    }
    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(function(permission) {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                showNotification();
            }
        });
    }
}