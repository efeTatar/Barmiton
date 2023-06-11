function user_info_display(user_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("user-info").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/user-moderation-requests/user-information-display-request.php?user_id="+user_id, true);
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
    xhttp.open("GET", "../requests/user-moderation-requests/profile-picture-display-request.php?user_id="+user_id, true);
    xhttp.send();
}

function navigation_bar_user_segment_display()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("navigation-bar-user-segment").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/user-moderation-requests/user_log_in_state_request.php", true);
    xhttp.send();
}

function admin_console_button_display()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("admin-button").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/user-moderation-requests/admin-state-request.php", true);
    xhttp.send();
}