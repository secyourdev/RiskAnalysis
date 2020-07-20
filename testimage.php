<?php
session_start();

include("content/php/bdd/connexion.php");

?>
<?php include("testimageselection.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <style type="text/css">
        #content {
            width: 50%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
        }

        form {
            width: 50%;
            margin: 20px auto;
        }

        form div {
            margin-top: 5px;
        }

        #img_div {
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
        }

        #img_div:after {
            content: "";
            display: block;
            clear: both;
        }

        img {
            float: left;
            margin: 5px;
            width: 90%;
        }
    </style>
</head>

<body>
    <div id="content">

        <?php
        // print_r($result);
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='image-preview' id='imagePreview'>";
            echo "<img class='image-preview__image' src='image/" . $row['image'] . "' >";
            echo "<span class='image-preview__default-text'>Image Preview</span>";
            // echo "<p>".$row['image_text']."</p>";
            echo "</div>";
        }
        ?>
        <form method="POST" action="testimagephp.php" enctype="multipart/form-data">
            
        <label for="nom_scenario_operationnel">Nom du scénario opérationnel</label>
            <select class="form-control" name="nom_scenario_operationnel" id="nom_scenario_operationnel">
                <option value="" selected>...</option>
                <?php
                // print 'bonjour';
                // print_r($result_scenario_op);
                while ($row = mysqli_fetch_array($result_scenario_op)) //selection.php
                {
                    // print_r($row);
                    echo '
                        <option id="scenario_operationnel" value="' . $row['id_scenario_operationnel'] . '">' . $row['nom_scenario_operationnel'] . '</option>
                        ';
                }
                ?>
            </select>


            <input type="hidden" name="size" value="1000000">
            <div>
                <input type="file" name="image">
            </div>
            <!-- <div>
        <textarea 
            id="text" 
            cols="40" 
            rows="4" 
            name="image_text" 
            placeholder="Say something about this image..."></textarea>
        </div> -->
            <div>
                <button type="submit" name="upload">POST</button>
            </div>
        </form>
    </div>
</body>

</html>