let replyButtons = document.querySelectorAll(".reply");


replyButtons.forEach((button)=>{
    let storyId = button.getAttribute("data-id");
    button.addEventListener('click', replyListener.bind(storyId));
})

function replyListener(event){
    let id = this;
    let story = document.querySelector("section[id='stories_content'");
    let button = story.querySelector(".reply");
    let str = button.outerHTML;
    let form = document.createElement("form");
    form.setAttribute("id","commentform");
    form.setAttribute("onsubmit","submitAction");
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
    console.log(form);
    submitAction(form);
    button.replaceWith(form);

}

function submitAction(form){
    form.addEventListener('submit',submitListener);
}


function submitListener(event){
    event.preventDefaul();
}