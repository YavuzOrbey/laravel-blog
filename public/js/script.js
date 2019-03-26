let likeButtons = document.getElementsByClassName("like-button");

for (let button of likeButtons) {
    button.addEventListener("click", likeComment);
}

function likeComment() {
    let commentID = this.closest(".comment").getAttribute("data-comment");
    let likeStatus = this.getAttribute("data-like") === "true"; //true or false
    var xhr = new XMLHttpRequest();
    let thisButton = this;
    xhr.withCredentials = true;
    if (!likeStatus) {
        xhr.open("POST", "/likes", true);
    } else {
        xhr.open("DELETE", "/likes", true);
    }
    var metas = document.getElementsByTagName("meta");

    for (i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute("name") == "csrf-token") {
            xhr.setRequestHeader(
                "X-CSRF-Token",
                metas[i].getAttribute("content")
            );
            xhr.setRequestHeader(
                "Content-Type",
                "application/json;charset=UTF-8"
            );
        }
    }
    xhr.onload = function() {
        if (this.status === 200) {
            let output = !likeStatus
                ? '<i class="fas fa-heart"></i>'
                : "<i class='far fa-heart'></i>";
            output += " " + this.responseText;
            thisButton.setAttribute("data-like", !likeStatus);
            thisButton.innerHTML = output;
        }
    };
    xhr.send(JSON.stringify({ likeStatus: likeStatus, commentID: commentID }));
}
