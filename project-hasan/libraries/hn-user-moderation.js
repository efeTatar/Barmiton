function user_info_display(user_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("user-info").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "user-info-display-call.php?user_id="+user_id, true);
    xhttp.send();
}

function profile_comment_switch(){
    document.getElementById("segment-comment").style.display = "inline";
    document.getElementById("segment-recipe").style.display = "none";
}
function profile_recipe_switch(){
    document.getElementById("segment-comment").style.display = "none";
    document.getElementById("segment-recipe").style.display = "inline";
}

function user_profile_picture_display(user_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("profile-picture-div").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "user_picture_display_call.php?user_id="+user_id, true);
    xhttp.send();
}