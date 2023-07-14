<?php

require_once getcwd() . '/includes/database.php';


$stmt = $conn->prepare("SELECT * FROM film");
$stmt->execute();
$films = $stmt->fetchAll();




?>


<div class="container">
    <div id="infoModal"></div>
    <table class="table table-striped">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Film name</th>
        </thead>
        <tbody>
            <?php

                foreach( $films as $film )
                {
                    $strFilmName = str_replace(" ", "_", $film[1]);
                    echo sprintf(
                        "<tr>
                            <td>%s</td>
                            <td>
                                <a
                                    class=\"text-primary text-decoration-none\"
                                    id=\"#%s\"
                                    role=\"button\"
                                    onclick=\"openFilm('%s')\"
                                    data-bs-toggle=\"%s\">
                                    %s
                                </a>
                            </td>
                        </tr>",
                        $film[0], $strFilmName, $film[0], 
                        $strFilmName, $strFilmName, $film[1]
                    );
                }

            ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        function openFilm( intFilmId )
        { document.location = `/film.php?id=${intFilmId}` }

    </script>



</div>