<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <?php
        switch ($strMethod) {
            case 'endpoints':
                ?> <script src="/__resources/js/jqGetEndpoints.js" ></script> <?php
                break;

            // Characters
            case 'chars':
                ?> <script src="/__resources/js/jqGetCharacters.js" ></script> <?php
                break;
            case 'charinfo':
                ?> <script src="/__resources/js/jqGetCharacterInfo.js" ></script> <?php
                break;
            // EndCharacters

            // Locations
            case 'locs':
                ?>
                    <script src="/__resources/js/jqGetLocations.js" ></script>
                    <script src="/__resources/js/jqGetLocationInfo.js"></script>
                <?php
                break;
            // EndLocations

            // Episodes
            case 'eps':
                ?>
                    <script src="/__resources/js/jqGetEpisodes.js" ></script>
                    <script src="/__resources/js/jqGetEpisodeInfo.js"></script>
                <?php
                break;
            // EndEpisodes

            default:
                break;
        }
    ?>
</body>
</html>