forms = document.querySelectorAll("form");

forms.forEach(element => {
    element.addEventListener('submit',detectScriptInjection.bind(element));
});


function detectScriptInjection(event){
    let form = this;
    inputs = form.querySelectorAll("input, textarea");
    inputs.forEach(input => {
        if(input.value.search("<script>") >= 0){
            event.preventDefault();
            alert("I know what you tried to do dear hacker!");
        }
    });
}