let conf = document.querySelector("input[name='conf']");
let pass = document.querySelector("input[name='pass']");

conf.addEventListener('keyup',checkPassword);
pass.addEventListener('keyup',checkPassword);

function checkPassword(){
    
    let section = document.querySelector("section[id='register_content']");
    let message  = document.querySelector("label[id='message']");
    if(conf.value != pass.value){
        if(message == null){
            message = document.createElement("label");
            message.setAttribute('id','message');
            section.appendChild(message);
        }
        message.innerHTML = "The value of the password must be the same";
    }
    else{
        if(message != null){
            message.remove();
        }
    }
}