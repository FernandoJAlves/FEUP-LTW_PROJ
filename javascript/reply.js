let replyButtons = document.querySelectorAll(".reply");
let userId;


replyButtons.forEach((button) => {
    button.addEventListener('click', replyListener.bind(button));
})

function replyListener(event) {
    let button = this;
    let id = button.getAttribute("data-id");
    let div = document.querySelector("div[id='commentable" +id+"']");
    let aux = div.querySelector("form");
    if (aux == null) {
        form = document.createElement("form");
        form.setAttribute("id", "commentform" + id);
        let text = document.createElement("textarea");
        text.setAttribute("name", "story");
        text.setAttribute("id", "commentform");
        text.setAttribute("rows", "10");
        text.setAttribute("placeholder", "Enter your text here...");
        text.required = true;
        form.appendChild(text);
        let submitButton = document.createElement("input");
        submitButton.setAttribute("type", "submit");
        submitButton.setAttribute("value", "Comment");
        form.appendChild(submitButton);
        submitAction(form, button);
        div.appendChild(form);
        text.focus();
    }
    else{
        aux.remove();
    }


}

function submitAction(form, button) {
    form.addEventListener('submit', submitListener.bind(button, form));
}


function submitListener(form, event) {
    event.preventDefault();
    commentRequest(this, form);
}


function commentRequest(button, form) {
    let text = form.querySelector("textarea").value;
    if (text.search("<script>") >= 0) {
        alert("I know what you tried to do dear hacker!");
    }
    else {
        let request = new XMLHttpRequest();
        request.onload = commentRequestListener.bind(request, button, form);
        request.open("post", "../actions/action_comment.php", true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        let parentId = button.getAttribute("data-id");
        request.send(encodeForAjax({ text: text, id: parentId }));
    }
}


function commentRequestListener(button, form, event) {
    let parentId = button.getAttribute("data-id");
    let str = ".comments[data-id='" + parentId + "']";
    comments_sec = document.querySelector(str);
    let no_comments = document.querySelector("a[id='no_comments']");
    if (no_comments != null) {
        no_comments.remove();
    }
    let response = JSON.parse(this.responseText);
    comments_sec.outerHTML = response[0];
    form.remove();
    replyButtons = document.querySelectorAll(".reply");
    replyButtons.forEach((button) => {
        button.addEventListener('click', replyListener.bind(button));
    })
    let div = document.querySelector("div[id='commentable" +parentId+"']");
    let comments_num = div.querySelector(".comments_count");
    if(comments_num != null)
        comments_num.innerHTML = parseInt(response[1]) + " Comments";
}