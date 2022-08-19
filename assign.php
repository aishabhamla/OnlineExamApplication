<?php require_once 'navbarT.php' ?>
<?php
    $data = array(
        'exam_display_question' => "exam_display_question",
    );

    $url = "https://afsaccess4.njit.edu/~arn2/middle.php";
    
    if(isset($_POST['sort'])){
        $data=$_POST;
        //print_r($data);
    }

    // curl1
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    $recieved_array1 = array();
    $recieved_array1 = json_decode($result,true);

    $data = array(
        'exam_display_exam' => "exam_display_exam",
    );

    if(isset($_POST['submit'])){
        $data = $_POST;
    }

    // curl2
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    $recieved_array2 = array();
    $recieved_array2 = json_decode($result,true);
?>

<head>
    <meta charset="UTF-8">
    <title>Make an Exam</title>
</head>
<br>
<div class="row">
    <div class="col" style= "margin-left: 20;">
        <h1><center><b>Make an Exam</b></center></h1><br>
        <table>
            <thead>
                <tr>
                    <th style = background-color:#d6d6d6;><center>Questions</center></th>
                    <th style = background-color:#d6d6d6;><center>Score</center></th>
                </tr>
                <div class="row">
            
            <div class="row">
            <div class="col">
            <form action method = "post">
            <div class="row">
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-text">Sort</div>
                    <select class="form-control" name="topic" >
                        <option value="no_topic">Topic</option>
                        <?php foreach ($recieved_array1 as $array_index =>$each_array): ?>
                            <option value="<?php echo $each_array['topic']; ?>"><?php echo $each_array['topic']; ?></option>  
                        <?php endforeach; ?>
                    </select>
                    
                </div>
            </div>
            <div class="col-2">
                <div class="input-group">
                    <select class="form-control" name="difficulty">
                    <option value="no_difficulty"><b>Difficulty<b></option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
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
        </form>
        </div>
                <?php foreach ($recieved_array1 as $array_index =>$each_array): ?>
                <tr>
                    <form action method = "post">
                        <td>
                            <?php echo $each_array['question']; ?>
                        </td>
                        <td>
                            <center><input type="number"  style = "align-items-center;width:50px;" name="<?php echo "points-". $each_array['id']; ?>"></center>
                        </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <th style = background-color:#d6d6d6;><center>Confirm</center></th>
                    <td>
                            <center><input class="submit" style = "padding: 5px 5px;" type="submit" name="submit"><center>
                    </td>
                    </form>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col">
        <h1><center><b>CS 490 Midterm Exam</b></center></h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th style = background-color:#d6d6d6;><center> Exam Questions</center></th>
                    <th style = background-color:#d6d6d6;><center>Score</center></th>
                </tr>
                <?php foreach ($recieved_array2 as $array_index =>$each_array): ?>
                <tr>
                    <td><?php echo $each_array['question']; ?></td>
                    <td><center><?php echo $each_array['score']; ?></center></td>
                </tr>
                <?php endforeach; ?>
            </thead>
        </table>
    </div>
</div>