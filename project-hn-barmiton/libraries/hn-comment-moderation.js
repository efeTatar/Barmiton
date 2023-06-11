function recipe_comment_display(recipe_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if (this.readyState== 4 && this.status== 200)
        {
            document.getElementById("comments").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/comment-moderation-requests/recipe_comment_display_request.php?recipe_id="+recipe_id, true);
    xhttp.send();
}

function user_comment_display(user_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("segment-comment").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/comment-moderation-requests/user-comment-display-request.php?user_id="+user_id, true);
    xhttp.send();
}

function comment_remove_call(comment_id)
{
    if (!confirm("Do you want to proceed ?")) {
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if (this.readyState== 4 && this.status== 200)
        {
            document.getElementById("segment-comment").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/comment-moderation-requests/comment-remove-request.php?comment_id="+comment_id, true);
    xhttp.send();
}
