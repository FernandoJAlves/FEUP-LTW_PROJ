let upbuttons = document.querySelectorAll(".up-vote");
let downbuttons = document.querySelectorAll(".down-vote");


upbuttons.forEach((button)=>{
    let storyId = button.getAttribute("data-id");
    console.log(button);
    console.log(storyId);
    button.addEventListener('click', voteAJAXRequest.bind(storyId,1));
})

downbuttons.forEach((button)=>{
    let storyId = button.getAttribute("data-id");
    console.log(button);
    console.log(storyId);
    button.addEventListener('click', voteAJAXRequest.bind(storyId,-1));
})

function requestListener () {
    console.log(this.responseText)
}

function voteAJAXRequest(value,event){
    let request = new XMLHttpRequest();
    request.onload = requestListener;
    request.open("post", "../actions/action_vote.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(encodeForAjax({value: value, storyId: this}));
    
}


function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}