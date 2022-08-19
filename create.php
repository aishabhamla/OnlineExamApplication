<?php require_once 'navbarT.php' ?>
<?php
    $data = array(
        'display_question' => "display_question",
    );
    
    if(isset($_POST['sort'])){
        $data=$_POST;
        //print_r($data);
    }


    if(isset($_POST['submit'])){ 
        if($_POST['topic'] != '' || $_POST['question'] != ''){
            $key=array_keys($_POST); 
            if (in_array("testcase2", $key) == "TRUE" && in_array("testcase6", $key) != "TRUE")
            {  
                $topic = $_POST['topic'];
                $difficulty = $_POST['difficulty'];
                $constraints = $_POST['constraints'];
                $question = rawurlencode($_POST['question']);
                $testcase1 = rawurlencode($_POST['testcase1']);
                $output_testcase1 = rawurlencode($_POST['output_testcase1']);
                $testcase2 = rawurlencode($_POST['testcase2']);
                $output_testcase2 = rawurlencode($_POST['output_testcase2']);
                $testcase3 = rawurlencode($_POST['testcase3']);
                $output_testcase3 = rawurlencode($_POST['output_testcase3']);
                $testcase4 = rawurlencode($_POST['testcase4']);
                $output_testcase4 = rawurlencode($_POST['output_testcase4']);
                $testcase5 = rawurlencode($_POST['testcase5']);
                $output_testcase5 = rawurlencode($_POST['output_testcase5']);

                $data = array(
                    'topic' => $topic,
                    'difficulty' => $difficulty,
                    'constraints' => $constraints,
                    'question' => $question,
                    'testcase1' => $testcase1,
                    'output_testcase1' => $output_testcase1,
                    'testcase2' => $testcase2,
                    'output_testcase2' => $output_testcase2,
                    'testcase3' => $testcase3,
                    'output_testcase3' => $output_testcase3,
                    'testcase4' => $testcase4,
                    'output_testcase4' => $output_testcase4,
                    'testcase5' => $testcase5,
                    'output_testcase5' => $output_testcase5,
                );
            }
            else if (in_array("testcase6", $key))
            {
                echo "<h4 style=color:red;><center>Extra Test cases (you can't have more than 5 testcases.)</center></h4>";
            }
            else
            {
                echo "<h4 style=color:red;><center>No Test cases. (Please enter atleast 2 testcases.)</center></h4>";
            }
        }
        else{
            echo "<h4 style=color:red;><center>Topic or Question or Test case slot is empty, Please enter something</center></h4>";
        }
    }
    

    $url = "https://afsaccess4.njit.edu/~arn2/middle.php";

    // curl*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    $recieved_array = array();
    $recieved_array = json_decode($result,true);
    //echo "<br>";
    //print_r($recieved_array);
    //var_dump($recieved_array);
?>
<script>
function addElement(elId,e,i) {
        for(var x=0; x<i; x++ ){
            var holder = document.getElementById(elId),
                num = e.currentTarget.dataset.count++,
                divIdName = elId + num,
                newdiv = document.createElement('div');

            newdiv.setAttribute("id", divIdName);
            newdiv.innerHTML = "<lable>Testcase "+(num+1) + "</lable><textarea class=\"form-control\" name=\"testcase" + (num+1) + "\"></textarea><a href=\"javascript:;\" onclick=\"removeElement(\'" + divIdName + "\',\'" + elId + "\')\">Remove</a>";

            holder.appendChild(newdiv);
            setTimeout(function() {
                newdiv.className += "show";
            }, 10);
        }
}
function addElement1(elId,e,i) {
    for(var x=0; x<i; x++ ){
        var holder = document.getElementById(elId),
            num = e.currentTarget.dataset.count++,
            divIdName = elId + num,
            newdiv = document.createElement('div');

        newdiv.setAttribute("id", divIdName);
        
        newdiv.innerHTML = "<lable>Output for Testcase "+(num+1) + "</lable><textarea class=\"form-control\" name=\"output_testcase" + (num+1) + "\"></textarea><a href=\"javascript:;\" onclick=\"removeElement(\'" + divIdName + "\',\'" + elId + "\')\">Remove</a>";

        holder.appendChild(newdiv);
        setTimeout(function() {
            newdiv.className += "show";
        }, 10);
    }
}
/*
function removeElement(divNum,elId) {
    var holder = document.getElementById(elId);
    var olddiv = document.getElementById(divNum);
    olddiv.className = "";
    
    setTimeout(function() {
        holder.removeChild(olddiv);
    }, 600);
}*/
</script>
<head>
    <meta charset="UTF-8">
    <title>Create Question</title>
</head>
<br>
<div class="row">
    <div class="col" style= "margin-left: 20;">
        <h1><b>Create a Question</b></h1>
        <form action method = "post">
            <p> Topic</p>
            <input type="text" name="topic"><br>
            <p>Select Difficulty: </p>
            <select name="difficulty">
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
            <p>Constraints: </p>
            <select name="constraints">
                <option value="None">None</option>
                <option value="For_loop">For loop</option>
                <option value="While_loop">While loop</option>
                <option value="Recursion">Recursion</option>
            </select>
            <p>Create Question:</p>
            <textarea rows="4" cols="88" name="question" ></textarea><br>
            <div class = "row">
                <div class = "col">
                <p>Test Case </p>
                <select data-count="0"  onchange="addElement('fadeit',event,this.value);">
                    <option value="0" >0</option>
                    <option value="2" >2</option>
                    <option value="3" >3</option>
                    <option value="4" >4</option>
                    <option value="5" >5</option>
                </select><br><br>
                <div class="fadeit" id="fadeit"></div>
                   
                </div>
                <div class = "col">
                    <p>Output for TestCase </p>
                    <select data-count="0"  onchange="addElement1('slide-fade',event,this.value);">
                        <option value="0" >0</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                    </select><br><br>
                    <div class="slide-fade" id="slide-fade"></div>
                </div>
            </div>
            <br>
            <input class='submit' type="submit" name="submit">
        </form>
    </div>
    <div class="col">
        <form action method = "post">
        <h1><center><b>All Questions</b></center></h1><br>
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-text">Sort</div>
                    <select class="form-control" name="topic" >
                        <option value="no_topic">Topic</option>
                        <?php foreach ($recieved_array as $array_index =>$each_array): ?>
                            <option value="<?php echo $each_array['topic']; ?>"><?php echo $each_array['topic']; ?></option>  
                        <?php endforeach; ?>
                    </select>                    
                </div>
            </div>
            <div class="col-3">
                <div class="input-group">
                    <select class="form-control" name="difficulty">
                    <option value="no_difficulty"><b>Difficulty<b></option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="input-group">
                <input class="form-control" name="key_word" value="" />
                </div>
            </div>
            
            <div class="col">
                <div class="input-group">
                    <input class='submit'type="submit" name="sort" value="Apply" />
                </div>
            </div>
        </form>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th style = background-color:#d6d6d6;><center>Questions</center></th>
                </tr>
                <?php foreach ($recieved_array as $array_index =>$each_array): ?>
                <tr>
                    <td><?php echo $each_array['question']; ?></td>
                </tr>
                <?php endforeach; ?>
            </thead>
        </table>
    </div>
</div>
