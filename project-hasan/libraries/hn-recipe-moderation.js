function recipe_propositions_display()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if (this.readyState== 4 && this.status== 200)
        {
            document.getElementById("propositions").innerHTML= this.responseText;
        }
    };
    xhttp.open("POST", "recipe-propositions-display-call.php", true);
    xhttp.send();
}

function recipe_proposition_validate(recipe_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
        if (this.readyState== 4 && this.status== 200)
        {
            document.getElementById("propositions").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "recipe-proposition-validate-call.php?recipe_id="+recipe_id, true);
    xhttp.send();

    recipe_propositions_display();
}

function recipe_propsition_refuse(recipe_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("propositions").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "recipe-proposition-refuse-call.php?recipe_id="+recipe_id, true);
    xhttp.send();

    recipe_propositions_display();
}

function user_recipes_display(user_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("segment-recipe").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "recipes-display-call.php?user_id="+user_id, true);
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
    xhttp.open("GET", "user-comment-display-call.php?user_id="+user_id, true);
    xhttp.send();
}

function recipe_search_initialise()
{
    recipe_search_jQuery_initialise();
}

function recipe_search_jQuery_initialise(){
    (jQuery)(function($)
    {
        $(document).ready(function(){
            recipe_search();
        });
    });
}

function recipe_search()
{
    document.getElementById("display").style.display = "none";
    $("#search").on('keyup', function(){
        var search = $(this).val();

        if(search == '')
        {
            $("#display").html('');
            document.getElementById("display").style.display = "none";
            return;
        }

        document.getElementById('display').style.display = "block";

        $.ajax({
            url: 'search-call.php',
            type: 'POST',
            data: {search:search},
            success: function(response){
                $("#display").html(response);
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                alert('An error has occured.');
            },
            complete: function(){
                console.log('Search completed.');
            }
        });

    });
}

function recipe_destroy(recipe_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("user-recipes").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "recipe-remove-call.php?recipe_id="+recipe_id, true);
    xhttp.send();
}

function browse_display_call()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("browse").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "browse-display-call.php", true);
    xhttp.send();
}  