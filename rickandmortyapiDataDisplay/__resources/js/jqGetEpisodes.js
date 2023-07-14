/**
 * API Reuqest URL Building
 */
var baseURL = "https://rickandmortyapi.com/api/episode";

if ( document.location.search == "" ||
    document.location.search.split("=")[1] == undefined )
{
    var strPage = "?page=1";
} else {
    var strPage = document.location.search;
}
var apiSearchURL = baseURL + strPage;
/** END API Request URL Build */

/**
 * Get&Display results* from API with AJAX
 */
$.ajax({
    type: "GET",
    url: apiSearchURL,
    success: function(response) {
        $.each(
            response.results,
            function( index, value )
            {
                var strHTMLCard = `
                    <div class="col-md-3 my-2">
                        <div class="card bg-dark text-secondary rounded">
                            <div class="d-flex flex-row">
                                <div class="m-3">
                                    <h5 class="card-title mb-3 text-warning">
                                        <a data-bs-toggle="modal"
                                            data-bs-target="#modalEpisode"
                                            style="cursor: pointer;"
                                            onclick="updateModal(${value.id})">
                                            ${value.name}
                                        </a>
                                    </h5>
                                    <p class="text-muted mb-0">Air Date:</p>
                                    <p class="card-text text-light">
                                        ${value.air_date}
                                    </p>
                                    <p class="text-muted mb-0">Episode:</p>
                                    <p class="card-text text-light">
                                        ${value.episode}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                console.log( value );
                $("#main").append(strHTMLCard);
            }
        )
        if ( strPage == "?page=1" ) {
            $("#nav").append(`
                <div class="row row mx-0 my-3 p-0">
                    <a href="/episode?page=${response.info.next.split('/')[4].split('=')[1]}" class="btn btn-outline-warning">Next page</a>
                </div>
            `)
        }
        else if ( response.info.next == null ) {
            $("#nav").append(`
                <div class="row mx-0 my-3 p-0">
                    <a href="/episode?page=${response.info.prev.split('/')[4].split('=')[1]}" class="btn btn-outline-warning">Previous page</a>
                </div>
            `)
        }
        else {
            $("#nav").append(`
                <div class="col mx-3 my-3 p-0 text-end">
                    <a href="/episode?page=${response.info.prev.split('/')[4].split('=')[1]}" class="btn btn-outline-warning" style="width: 150px">Previous page</a>
                </div>
                <div class="col mx-3 my-3 p-0 text-start">
                    <a href="/episode?page=${response.info.next.split('/')[4].split('=')[1]}" class="btn btn-outline-warning" style="width: 150px">Next page</a>
                </div>
            `)
        }
    }
})