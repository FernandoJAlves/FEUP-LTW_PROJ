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
    let str1 = ".vote-number[data-id='" + reply[0] + "']";
    let str2 = ".up-vote[data-id='" + reply[0] + "']";
    let str3 = ".down-vote[data-id='" + reply[0] + "']";
    
    let votes = document.querySelector(str1);
    let upvote = document.querySelector(str2);
    let downvote = document.querySelector(str3);
    let value = reply[2];
    if(value == "1"){
        upvote.setAttribute('src',"../img/utilities/upvote.png");
        downvote.setAttribute('src',"../img/utilities/downvotegrey.png");
    }
    else if(value == "0"){
        upvote.setAttribute('src',"../img/utilities/upvotegrey.png");
        downvote.setAttribute('src',"../img/utilities/downvotegrey.png");
    }
    else if(value == "-1"){
        upvote.setAttribute('src',"../img/utilities/upvotegrey.png");
        downvote.setAttribute('src',"../img/utilities/downvote.png");
    }
    votes.innerHTML = parseInt(reply[1]);

}

function voteAJAXRequest(value,button,event){
    let request = new XMLHttpRequest();
    request.onload = requestListener.bind(request, button);
    let username = button.getAttribute('data-user');
    request.open("post", "../actions/action_vote.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(encodeForAjax({value: value, storyId: this, username: username}));
    
}


function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}