var C_name, difficulty, ingredients, input_array;
var i = 0;

function _(x){

    return document.getElementById(x);
}

function arr_2_str(list_of_inputs){

    string_of_inputs = list_of_inputs[0].value;

    for(let j=1;j<list_of_inputs.length;j++){

        string_of_inputs = string_of_inputs+","+list_of_inputs[j].value;

    }

    return string_of_inputs;
}

function obtain_input(list_of_inputs, block){

    input_array = list_of_inputs;

    for(let j=0;j<input_array.length;j++){
        if(input_array[j].value != ""){

            block.appendChild(document.createTextNode(" -" +input_array[j].value));
            block.appendChild(document.createElement("br"));

        }
    }
    return;
}

function process_phase_1(){

    C_name = _("name").value; 
    difficulty = _("difficulty").value;
    type_of_drink = _("type_of_drink").value;

    if(C_name.length <= 2){

        alert("Please fill the name");

    }
    else{

        _("phase_1").style.display = "none";
        _("phase_2").style.display = "block";
        _("progress_bar").value = 33;

    }

    return;
}

function process_phase_2(){

    _("phase_2").style.display = "none";
    _("phase_3").style.display = "block";
    _("progress_bar").value = 66;
    
    return;
}

function test_function(){
    alert("final phase");
    return;
}

function final_process()
{
    process = _("process").value;

    _("phase_3").style.display = "none";
    _("all_data").style.display = "block";
    _("progress_bar").value = 100;

    _("display_name").innerHTML = C_name;
    _("display_difficulty").innerHTML = difficulty;
    _("display_type_of_drink").innerHTML = type_of_drink;
    _("display_process").innerHTML = process;
    obtain_input(document.getElementsByClassName('inputs'), _("display_ingredients"));
}

function delete_input(x){

    id = x.id;
    chosen_div = _("div"+id);
    chosen_div.remove();

    return;
}

function create_del_button(){

    button = document.createElement("button");

    button.innerText = "X";
    button.setAttribute('id',i);
    button.onclick = function() { delete_input(this); }
    button.style.backgroundColor = "red";

    return button;
}

function create_input(){

    var input = document.createElement("input");

    input.type = "text";
    input.setAttribute('name',"input"+i);
    input.setAttribute('class',"inputs");
    input.setAttribute('id',"input"+i);

    return input;
}

function create_div(root){

    div = document.createElement("div");
    div.setAttribute('id',"div"+i);

    return div; 
}

function append_div(root){

    input = create_input();
    button = create_del_button();
    div = create_div();

    div.appendChild(document.createTextNode("Ingredient : "));
    div.appendChild(input);
    div.appendChild(button);

    div.appendChild(document.createElement("br"));
    div.appendChild(document.createElement("br"));

    root.appendChild(div);
    i++;
    return;
}

function add_ingredient(){

    append_div(_("ingredients_list"));
    
    return;
}

function submit_form(){

    var xhttp = new XMLHttpRequest();

    
    xhttp.onreadystatechange=function() {
        if (this.readyState == 4 && this.status == 200) {
        }
        
    };

    var name = _("name").value;
    var difficulty = _("difficulty").value;
    var type_of_drink = _("type_of_drink").value;
    var process = _("process").value;
    
    var ingredients_list = arr_2_str(document.getElementsByClassName('inputs'));

    xhttp.open("GET","hn_process_receipt.php?name="+name+"&difficulty="+difficulty+"&ingredients_list="+ingredients_list+"&type_of_drink="+type_of_drink+"&process="+process, true);
    xhttp.send();

}