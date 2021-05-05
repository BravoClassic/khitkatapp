const form = document.querySelector(".typing-area"),
    messageInput = form.querySelector(".messageInput"),
    sendButton = form.querySelector("button"),
    chat_box = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
}

sendButton.onclick = () => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("POST", "includes/chat.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                let responseFromPHP = data.split(",");
                if (data[1] == data[3]) {
                    console.log(data);
                    if (Notification.permission == "granted") {
                        showNotification(responseFromPHP);
                    } else if (Notification.permission != "denied") {
                        Notification.requestPermission().then(
                            permission => {
                                if (permission == "granted")
                                    showNotification(responseFromPHP);
                            }
                        )
                    }
                }
                messageInput.value = "";
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

chat_box.onmouseenter = () => {
    chat_box.classList.add("active");
}
chat_box.onmouseleave = () => {
    chat_box.classList.remove("active");

}

setInterval(() => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("POST", "includes/get-chat.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chat_box.innerHTML = data;
                if (!chat_box.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500)

function scrollToBottom() {
    chat_box.scrollTop = chat_box.scrollHeight;
}

function showNotification(details) {
    const notification = new Notification(`Message from ${details[4]}`, {
        body: details[2],
    });
    notification.onclick = (e) => {
        window.location.href = `chat.php?user_id=${details[0]}`;
    }
}

window.onbeforeunload = () => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("GET", "includes/logout.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                if (data == "success") {
                    location.href = "login.php";
                }
            }
        }
    }
    xhr.send();
}