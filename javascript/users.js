const searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button"),
    usersList = document.querySelector(".users .users-list"),
    logoutBtn = document.querySelector(".users .logout");


searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = () => {
    let searchKeyWord = searchBar.value;

    if (searchKeyWord == "") {
        searchBar.classList.remove("active");
    } else {
        searchBar.classList.add("active");
    }

    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("POST", "includes/search.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("searchKeyWord=" + searchKeyWord);
}

logoutBtn.onclick = () => {
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

setInterval(() => {
    let xhr = new XMLHttpRequest(); //creating XML object 
    xhr.open("GET", "includes/users.inc.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!searchBar.classList.contains("active")) {
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 1000)