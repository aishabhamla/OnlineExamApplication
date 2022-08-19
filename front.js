function login(){
    // declare
    var ajaxRequest;

    try{
        ajaxRequest = new XMLHttpRequest();
    } catch (e){
        try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                alert("ERROR!");
                return false;
            }
        }
    }
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState === 4){
            var ajaxDisplay = document.getElementById('ajaxDiv');
            ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
    }

    //
    var name = document.getElementById('login:username').value;
    var pass = document.getElementById('login:password').value;
    var myJSONObject = {"name": name,"pass":pass};
    ajaxRequest.open("POST", MID_PATH+"login.php", true);
    ajaxRequest.send(JSON.stringify(myJSONObject));
}