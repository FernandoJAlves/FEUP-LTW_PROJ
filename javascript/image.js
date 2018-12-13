let input = document.querySelector(".imgInput");

input.addEventListener('change',updateImg);


function updateImg(){
    let img = document.querySelector(".imgProfile");
    var reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
    reader.onload = function(e) {
        img.setAttribute('src',e.target.result);
    }
    
}