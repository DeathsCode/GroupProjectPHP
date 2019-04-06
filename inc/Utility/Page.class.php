<?php

class Page  {

    public static $title = "Set Title!";

    static function header($logoff = null)    { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta charset="utf-8">
            <title><?php echo self::$title; ?></title>
            <meta name="description" content="">
            <meta name="author" content="">

            <!-- Check if its a logout page, if it is, then put in the redirect -->
            <?php if (!is_null($logoff))  {
                echo '<meta http-equiv="refresh" content="4; url=login.php">';
            } ?>
                <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

            <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="stylesheet" href="css/skeleton.css">

            <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link rel="icon" type="image/png" href="images/favicon.png">

        </head>

        <body>

            <!-- Primary Page Layout
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <div class="container">
                <div class="row">
                    <div class="ten columns" style="margin-top: 25%">
                        <h4><?php echo self::$title; ?></h4>
    <?php }

    static function footer()    { ?>

            </div>
        </div>
        </div>

        <!-- End Document
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        </body>
        </html>
    <?php }

    static function showMessages($messages) {
        echo '<div>';
            foreach ($messages as $message) {
                echo '<p style="color:red;font-weight: bold;">'. $message. '</p>';
            }
        echo '</div>';
    }

    static function showLogin()    { ?>
    <h4 style="text-align:center;">Please Login</h4>
    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="login">

        <div class="row">

            <div class="six columns">
            <label for="username">Username</label>
            <input class="u-full-width" type="TEXT" placeholder="Username" id="username" NAME="username">
            </div>

            <div class="six columns">
            <label for="name">Password</label>
            <input class="u-full-width" type="PASSWORD" id="password" NAME="password">
            </div>
            
        </div>
        <input class="button-primary" type="submit" value="login" name="post_type">
    </form>
    <?php }

    static function showRegister()    { ?>
    <h4 style="text-align:center;">Please Register</h4>
    <!-- The above form looks like this -->
    <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="action" value="login">

        <div class="row">

            <div class="six columns">
            <label for="username">Username</label>
            <input class="u-full-width" type="TEXT" placeholder="Username" id="username" NAME="username">
            </div>

            <div class="six columns">
            <label for="name">Password</label>
            <input class="u-full-width" type="PASSWORD" id="password" NAME="password">
            </div>
            
        </div>
        <input class="button-primary" type="submit" value="register" name="post_type">
    </form>
    <?php }

    static function PersonalInformation($user, $address){
        //add a table here
        echo '<form Action="" Method="POST">';
        echo '<label for="username">Username</label><p>'.$user->getUsername().'</p>';
        echo '<label for="Street">Street</label><input name="street" value="'.$address->getStreet().'"\>';
        echo '<label for="City">City</label><input name="city" value="'.$address->getCity().'"/>';
        echo '<label for="State">State</label><input name="state" value="'.$address->getState().'"\>';
        echo '<br/><input type="submit" name="update" Value="Update"> </form>';
        echo '<p><a href="home.php">Back to Search</a></p>';
        echo '<p>Click <A HREF="logout.php">here to logout</A>.</p>';
    }


    static function showSearch() {
        echo '<form method="GET" action="home.php">';
            echo '<input type="TEXT" placeholder="Search" id="search" NAME="search">';
            echo '<input class="button-primary" type="submit" value="search">';
        echo '</form>';
    }

    //This function takes information from the header and welcomes the user.
    static function showMovies($movies) { ?>
    <p><a href="PersonalInformation.php">Update Personal Information</a></p>
        <table class="u-full-width">
        <col width="20%">
        <col width="20%">
        <col width="40%">
        <col width="10%">
        <thead>
            <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Overview</th>
            <th>Release Date</th>
            <th>Add Review</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($movies as $movie) {
                echo '<tr>';
                echo '<td><img src="' . TheMovieDbApi::getW500Image($movie->poster_path) . '" alt="The Movie DB" height="100" width="100"/></td>';
                echo '<td>' . $movie->title . '</td>';
                echo '<td>' . $movie->overview . '</td>';
                echo '<td>' . $movie->release_date . '</td>';
                echo '<td><a href="Review.php?movie='.$movie->title.'">Add Review</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
        </table>

        <p>Click <A HREF="logout.php">here to logout</A>.</p>
    <?php }

    static function showMovie($movie,$rating = 0) { ?>
    <div>
            <?php
               
                echo '<img src="' .TheMovieDbApi::getW500Image($movie->poster_path) . '" alt="The Movie DB" height="300" width="300"/>';
                echo '<p>Rating: '.$rating.'/5';
                echo  '<p>Description:</p>
                <p>'. $movie->overview . '</p>';
                echo '<p>' . $movie->release_date . '</p>';
                echo '<p><a href="home.php">Back to Search</a></p>';
            ?>

    </div>
    <form Method="POST" ACTION = "<?php echo $_SERVER["PHP_SELF"]; ?>">
    <?php }

    static function ShowUserReview($Review, $movie){
                  echo'<table calls="u-full-width">
                    <col width="50%">
                    <col  width="10%">
                    <tr>
                    <th>Review</th> <th>Rating</th>
                    </tr>
                    <tr>
                    <td><TextArea name="reviewdesc">'.$Review->getReviewDesc().'</TextArea></td>
                    <td><input name="rating" type="number" max=5 min=0 value = "'.$Review->getRating().'"></td>
                    </tr>
                    <tr>
                    <td><button formaction="?movie='.$movie->title.'" name="update">Update</button></td>
                    <td><button formaction="?movie='.$movie->title.'" name="delete">Delete</button></td>
                    </tr>
                    </table>
                    ';
    }

    static function showReviews($Reviews){
        ?>
    </form>
            <table class="u-full-width">
                    <col width="20%">
                    <col width="40%">
                    <col width="10%">
                    <thead>
                        <tr>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($Reviews != null){
                            foreach($Reviews as $Review){
                            echo "<tr>";
                            echo "<td>".$Review->getRating()."/5</td>";
                            echo "<td>".$Review->getReviewDesc()."</td>";
                            echo "<td>".$Review->getDate()."</td>";
                            echo "</tr>";
                            }
        
                    }
                        ?>
                    </tbody>
                    </table>
                    <p>Click <A HREF="logout.php">here to logout</A>.</p>


        <?php
    }

    static function goodBye() { ?>
       <p>Thanks for stopping by.</p>
    <?php   }
}