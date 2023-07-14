<?php
    require_once getcwd() . '/includes/database.php';


    $intFilmId = explode('=', $_SERVER['QUERY_STRING'])[1];

    

    // Get Film data
    $stmt = $conn->prepare(
        "SELECT
            `title`,
            `description`, 
            `release_year` ,
            `language`.`name` as `language`,
            `category`.`name` as `category`,
            `rental_duration`,
            `rental_rate`,
            `length`,
            `replacement_cost`,
            `rating`,
            `special_features`
            -- *
        FROM
            `film`
        INNER JOIN `film_category` ON `film`.`film_id` = `film_category`.`film_id`
        INNER JOIN `category` ON `category`.`category_id` = `film_category`.`category_id`
        INNER JOIN `language` ON `language`.`language_id` = `film`.`language_id`
        WHERE 
            `film`.`film_id` = " . $intFilmId
    );

    $stmt->execute();
    $filmData = $stmt->fetch();

    // Get Shop data
    $stmt = $conn->prepare(
        "SELECT
            `city`.`city`,
            `country`.`country`,
            `address`.`address`
        FROM `film`
        INNER JOIN `inventory` ON `inventory`.`film_id` = `film`.`film_id`
        INNER JOIN `store` ON `store`.`store_id` = `inventory`.`store_id`
        INNER JOIN `address` ON `store`.`address_id` = `address`.`address_id`
        INNER JOIN `city` ON `city`.`city_id`=`address`.`city_id`
        INNER JOIN `country` ON `country`.`country_id` = `city`.`country_id`
        WHERE
            `film`.`film_id` = " . $intFilmId . "
        GROUP BY `store`.`store_id`"
    );

    $stmt->execute();
    $storeData = $stmt->fetchAll();

    // Get Actor data
    $stmt = $conn->prepare(
        "SELECT
            actor.first_name,
            actor.last_name
        FROM
            actor
        INNER JOIN film_actor ON actor.actor_id = film_actor.actor_id
        INNER JOIN film ON film.film_id = film_actor.film_id
        WHERE
            film.film_id = " . $intFilmId
    );

    $stmt->execute();
    $actorData = $stmt->fetchAll();

?>
    <script>
        document.title = "Film: <?= $filmData['title'] ?>";
        document.body.classList += "bg-dark text-light";
    </script>

    

    <section class="min-vh-100" id="main">
        <div class="container min-vh-100 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <h3 class="font-monospace fw-bold">
                    <?= $filmData['title']?><span class="fs-5 fw-light align-text-top">(<?= $filmData['release_year'] ?>)</span>
                </h3>
                <h5 class="font-monospace">
                    <?= $filmData['language'] . " [ " . $filmData['category'] . " ] "?> <span class="border py-1 px-2"><?= $filmData['rating'] ?></span>
                </h5>
                <h6 class="font-monospace">
                    <span>
                        Duration: 
                        <span class="text-warning">
                            <?= intdiv( $filmData['length'], 60 ).'h '.($filmData['length'] % 60).'m' ?>
                        </span>
                    </span>
                    <span>
                        RR:
                        <span class="text-warning">
                            <?= $filmData['rental_rate'] ?>
                        </span>
                    </span>
                    <span>
                        RD:
                        <span class="text-warning">
                            <?= $filmData['rental_duration'] ?>
                        </span>
                    </span>
                </h6>
                <h6 class="font-monospace mb-4">
                    RC:
                    <span class="text-warning">
                        $<?= $filmData['replacement_cost'] ?>
                    </span>
                </h6>
                <h6 class="font-monospace">
                    <?= $filmData['description'] ?>
                </h6>

                <p class="text-muted"><?= $filmData['special_features']?></p>
                <a href="/" class="btn btn-outline-light">Back to list</a>
            </div>
        </div>
    </section>
    <section class="min-vh-100 bg-light text-dark">
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="w-75">
                <h1 class="text-center font-monospace fw-bold">actors</h1>
                <table class="table table-striped">
                    <tbody>
                        <?php
                        foreach ( $actorData as $actor => $value )
                        {
                            echo sprintf(
                                "<tr>
                                    <td>%s</td>
                                    <td>%s</td>
                                </tr>",
                                $value['first_name'],
                                $value['last_name']
                            );
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </section>
    <section class="min-vh-100 text-light">
        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="w-75">
                <h1 class="text-center font-monospace fw-bold">available at</h1>
                <table class="table table-stripped text-light">
                    <tbody>
                        <?php
                        foreach ( $storeData as $store => $value )
                        {
                            echo sprintf(
                                "<tr>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                </tr>",
                                $value['country'], 
                                $value['city'], 
                                $value['address']
                            );
                        }
                        ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="#main" class="btn btn-outline-light my-5">Back to top</a>
                </div>
            </div>
            
        </div>
        
    </section>
    
    
