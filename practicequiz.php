<?php require_once 'navbarT.php' ?>
<?php
    $data = array(
        'dQuestion' => "dQuestion",
    );

    if(isset($_POST['submit'])){
        if($_POST['answer'] != ''){
            $answer = $_POST['answer'];
            $id = $_POST['id1'];

        echo "$answer";
        echo "<br>";
        echo $questionID;
        echo "<br>";

        // create array to save*
        $data = array(
            'questionID' => $id,
            'answer' => $answer,

        );

        }
        else{
            echo "<h4 style=color:red;><center>Answer slot is empty, Please enter something</center></h4>";
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
    print_r($recieved_array);
?>

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
</head>
<br>
<br>

<div class="row">
    <div class="col" style= "margin-left: 20;">
        <br>
        <table>
            <thead>
                <tr>
                    <th style = background-color:#d6d6d6;><center>Questions</center></th>
                </tr>
                    <?php foreach ($recieved_array1 as $array_index =>$each_array): ?>
                        <tr>
                            <form action method = "post">
                                <td>
                                    <input type="hidden"  name="id1" value="<?php echo $each_array['id']; ?>">
                                    <?php echo $each_array['question']; ?>
                                </td>
                                <td>
                                    <textarea rows="3" cols="80" name="answer" ></textarea><br>
                                </td>
                                <td>
                                    <input class="submit" style = "float:right;padding: 5px 5px;" type="submit" name="submit">
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
            </thead>
        </table>
    </div>
</div>