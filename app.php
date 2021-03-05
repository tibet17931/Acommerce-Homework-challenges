<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
    .checked {
        color: orange;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    .container {
        margin-top: 60px;
    }
</style>

<body>
    <div class="container">
        <div class="row">

            <?php
            $json_string = file_get_contents("./list.json");
            $json = json_decode($json_string);
            function numWeeks($dateOne, $dateTwo)
            {
                //Create a DateTime object for the first date.
                $firstDate = new DateTime($dateOne);
                //Create a DateTime object for the second date.
                $secondDate = new DateTime($dateTwo);
                //Get the difference between the two dates in days.
                $differenceInDays = $firstDate->diff($secondDate)->days;
                //Divide the days by 7
                $differenceInWeeks = $differenceInDays / 7;
                //Round down with floor and return the difference in weeks.
                return floor($differenceInWeeks);
            }

            foreach ($json as $value) {
            ?>
                <div class="card" style="width:280px;padding:10px;border: none;">
                    <img class="img-responsive" src="https://loremflickr.com/320/240" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h5 class="card-title"><?= $value->title ?></h5>
                        <p class="card-text"><?= numWeeks(date("Y-m-d H:i:s"), $value->created_at) ?> weeks ago</p>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $value->vote) {
                        ?>
                                <span class="fa fa-star checked"></span>
                            <?php } else { ?>
                                <span class="fa fa-star"></span>
                        <?php }
                        } ?>
                        <p class="card-text" style="margin-top:10px;">$ <?= $value->price ?> </p>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </div>

</body>

</html>