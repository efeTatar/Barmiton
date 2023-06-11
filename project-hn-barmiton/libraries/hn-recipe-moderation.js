
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
    xhttp.open("POST", "../requests/recipe-moderation-requests/recipe_propositions_display_request.php", true);
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
    xhttp.open("GET", "../requests/recipe-moderation-requests/recipe-validate-request.php?recipe_id="+recipe_id, true);
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
    xhttp.open("GET", "../requests/recipe-moderation-requests/recipe-refuse-request.php?recipe_id="+recipe_id, true);
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
    xhttp.open("GET", "../requests/recipe-moderation-requests/user-recipes-display-request.php?user_id="+user_id, true);
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
            url: '../requests/recipe-moderation-requests/search-call.php',
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
    xhttp.open("GET", "../requests/recipe-moderation-requests/recipe-remove-request.php?recipe_id="+recipe_id, true);
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
    xhttp.open("GET", "../requests/recipe-moderation-requests/browse-display-request.php", true);
    xhttp.send();
}  

function recipe_display_call(recipe_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("recipe-display-box").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/recipe-moderation-requests/recipe-display-request.php?recipe_id="+recipe_id, true);
    xhttp.send();
}

function ingredient_display_call()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("ingredients").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/recipe-moderation-requests/ingredient-display-request.php", true);
    xhttp.send();
}

function price_modify(price, ingredient_id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (this.readyState== 4 && this.status== 200) {
            document.getElementById("ingredients").innerHTML= this.responseText;
        }
    };
    xhttp.open("GET", "../requests/recipe-moderation-requests/ingredient-price-modify-request.php?price="+price+"&ingredient_id="+ingredient_id, true);
    xhttp.send();

    ingredient_display_call();
}