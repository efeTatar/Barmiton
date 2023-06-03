<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Cocktail's receipts</title>
    <script type="text/javascript" src="FormCreate.js"></script>
    <link rel="stylesheet" href="FormCreateStyle.css">
   
</head>
<body>

    <progress id="progress_bar" value="0" max="100"></progress>

    <form id = "Phase_process" onsubmit="return false">
        
        <div id="phase_1">
      
        <fieldset class="phase">
                <legend>1st Part : Introduction</legend>
                <label>Name of the Cocktail:</label>
                    <input type = "text"  placeholder="Write the name" id="name">
                <br><br>
                <label>Difficulty : </label> <select id="difficulty">
                    <option>Easy</option>
                    <option>Medium</option>
                    <option>Hard</option>
                    <option>Expert</option>
                </select><br><br>
                <label>Type : </label> <select id="type_of_drink">
                    <option>Beverage</option>
                    <option>Aperitif</option>
                </select><br><br>
                <button onclick="process_phase_1()">Continue</button>
            </fieldset>
        </div>

        <div id="phase_2">

            <fieldset class="phase">
                <legend>2nd Part : Ingredients</legend>
                <label>Add Ingredient : </label>
                <button onclick="add_ingredient()">+</button>
                <br><br>

                <fieldset>
                    <legend>List : </legend>
                    <div id="ingredients_list"></div>
                </fieldset>
                <button onclick="process_phase_2()">Continue</button>
            </fieldset>
        </div>

        <div id="phase_3">
            <fieldset class="phase">
                <legend>Process</legend>
                <p>Please enter the process :</p>
                <textarea id="process" rows="5" cols="33"></textarea>
                <br><br>
                <button onclick="process_phase_3()">Continue</button>
            </fieldset>
        </div>

        <div id="phase_4">
            <fieldset class="phase">
                <legend>Pictures</legend>
                <p> Please enter the picture you want to attach with the receipt : </p>
                <input type="file" id="image_pick" accept=".png, .jpeg, .jpg, .pm3">
            </fieldset>
            <button onclick="final_process()">Continue</button>
        </div>

        <div id="all_data">
            <fieldset class="phase">
            <legend>Résumé : </legend>
                <br>
                <p>Nom : </p><span id="display_name"></span><br>
                <p>Difficulty : </p><span id="display_difficulty"></span><br><br>
                <p>Type of Drink : </p><span id="display_type_of_drink"></span><br><br>
                <p>Image : </p><span id="display_type_of_drink"></span><br><br>
                <p>Process : </p><span id="display_process"></span><br><br>

                <fieldset>
                    <legend>Ingredient :</legend>
                    <br>
                    <span id="display_ingredients"></span>
                </fieldset>
                <span id="response"></span>
                <br><br>
                <button type="submit" onclick="submit_form()">Submit</button>
            </fieldset>
        </div>
</form>

        <div id="php_part">
            <fieldset class="phase">
                <legend>Php response</legend>
                <span id="php_emit"></span>
            </fieldset>
        </div>

</body>
</html>