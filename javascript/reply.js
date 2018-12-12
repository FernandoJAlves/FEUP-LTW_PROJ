let replyButtons = document.querySelectorAll(".reply");
let userId;


replyButtons.forEach((button)=>{
    button.addEventListener('click', replyListener.bind(button));
})

function replyListener(event){
    let id = this;
    let story = document.querySelector("section[id='stories_content']");
    let button = this;
    form = document.createElement("form");
    form.setAttribute("id","commentform");
    let text = document.createElement("textarea");
    text.setAttribute("name","story");
    text.setAttribute("id","commentform");
    text.setAttribute("cols","100");
    text.setAttribute("rows","10");
    text.setAttribute("placeholder","Enter your text here...");
    form.appendChild(text);
    let submitButton = document.createElement("input");
    submitButton.setAttribute("type","submit");
    submitButton.setAttribute("value","comment");
    form.appendChild(submitButton);
    submitAction(form,button);
    button.replaceWith(form);

}

function submitAction(form,button){
    console.log(form);
    form.addEventListener('submit',submitListener.bind(button,form));
    button.replaceWith(form);
}


function submitListener(form,event){
    event.preventDefault();
    commentRequest(this,form);
}


function commentRequest(button,form){
    let request = new XMLHttpRequest();
    request.onload = commentRequestListener.bind(request,button,form);
    let text = form.querySelector("textarea").value;
    request.open("post", "../actions/action_comment.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    let parentId = button.getAttribute("data-id");
    request.send(encodeForAjax({text: text, id:parentId}));
    
}


function commentRequestListener(button,form,event){
    let parentId = button.getAttribute("data-id");
    let str = ".comments[data-id='" + parentId + "']";
    comments_sec = document.querySelector(str);
    let no_comments = document.querySelector("a[id='no_comments']");
    if(no_comments != null){
    no_comments.remove();
    }
    comments_sec.outerHTML = this.responseText;
    form.replaceWith(button);
    replyButtons = document.querySelectorAll(".reply");
    replyButtons.forEach((button)=>{
        button.addEventListener('click', replyListener.bind(button));
    })
}