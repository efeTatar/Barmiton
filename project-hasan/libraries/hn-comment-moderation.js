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
    xhttp.open("GET", "recipe-comment-display-call.php?recipe_id="+recipe_id, true);
    xhttp.send();
}