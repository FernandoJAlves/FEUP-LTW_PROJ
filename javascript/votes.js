let upbuttons = document.querySelectorAll(".up-vote");
let downbuttons = document.querySelectorAll(".down-vote");


upbuttons.forEach((button)=>{
    let storyId = button.getAttribute("data-id");

    button.addEventListener('click', voteAJAXRequest.bind(storyId,1,button));
})

downbuttons.forEach((button)=>{
    let storyId = button.getAttribute("data-id");

    button.addEventListener('click', voteAJAXRequest.bind(storyId,-1,button));
})

function requestListener(button,event) {
    let reply = JSON.parse(this.responseText);
    let str = ".vote-number[data-id='" + reply[0] + "']";
    let votes = document.querySelector(str);
    let num = parseInt(votes.innerHTML);
    votes.innerHTML = (num+parseInt(reply[1]));

}

function voteAJAXRequest(value,button,event){
    let request = new XMLHttpRequest();
    request.onload = requestListener.bind(request, button);
    
    request.open("post", "../actions/action_vote.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(encodeForAjax({value: value, storyId: this}));
    
}


function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}