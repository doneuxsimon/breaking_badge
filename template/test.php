<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        section {
            display: flex;
            justify-content: center;
            height: 500px;
            border: 1px solid grey;
        }
        .barreContainer {
            width : 50px;
            border: 1px solid grey;
            /* transform: rotate(180deg); */
            align-self: flex-end;
        }

        .barre1 {
            height: 40px;
            background-color: red;
        }

        .barre2 {
            height: 40px;
            background-color: green;
        }

        .barre3 {
            height: 40px;
            background-color: blue;
        }

        .barre4 {
            height: 40px;
            background-color: yellow;
        }
    </style>
</head>
<body>
<section>
    <?php
        foreach($badges as $badge) {
            // foreach($levels as $level) {
                $percent = generateBarres(averageBadge($badge['id']), averageLevelByBadge($badge['id'], 1), averageLevelByBadge($badge['id'], 2), averageLevelByBadge($badge['id'], 3), averageLevelByBadge($badge['id'], 4));
                // echo $badge['name'] . ", " . $level['level'] . " : " . averageLevelByBadge($badge['id'], $level['id']) . "%<br>";
                echo $percent;
            // }
        }
    ?>
</section>
    
</body>
</html>