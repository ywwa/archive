/**
 * API Request URL Builing
 */
const baseURL = "https://rickandmortyapi.com/api/character/";
const characterID = document.location.pathname.split('/')[2]

const apiCharacterURL = baseURL + characterID;

/** END API Request URL Build */

/**
 * Get&Display characterData* from API with AJAX
 */
$.ajax({
    type: "GET",
    url: apiCharacterURL,
    success: function (response) {
        var strLocationURL;
        var strOriginURL;
        if ( response.status == "Alive" ) {
            var statusColor = "text-success";
        } else if ( response.status == "Dead" ) {
            var statusColor = "text-danger";
        } else {
            var statusColor = "text-secondary"
        }

        if ( response.location.url == "" ) {
            strLocationURL = `<a class="link-dark fw-bold text-decoration-none">${response.location.name}</a><br><br>`;
        } else {
            strLocationURL = `<a href="/location#${response.location.url.split('/')[5]}" class="link-primary fw-bold text-decoration-none">${response.location.name}</a><br><br>`;
        }

        if ( response.origin.url == "" ) {
            strOriginURL = `<a class="link-dark fw-bold text-decoration-none">${response.origin.name}</a>`;
        } else {
            strOriginURL = `<a href="/location#${response.origin.url.split('/')[5]}" class="link-primary fw-bold text-decoration-none">${response.origin.name}</a>`;
        }
        var strHTMLCard = `
            <div class="card bg-light text-dark rounded m-0 p-0 mb-5" style="width: 48rem;">
                <div class="card-body d-flex p-0 m-0">
                    <img src="${response.image}" alt="...">
                    <div class="m-3 w-100">
                        <h3 class="card-title">${response.name}</h3>
                        <h6 class="card-title">
                            <span class="${ statusColor }">&#9679;</span>
                            ${response.status} - ${response.species} - ${response.gender}
                        </h6>
        
                        <div class="d-flex align-items-center h-75" >
                            <div>
                                <div class="mb-3">
                                    <p class="card-text text-muted mb-0">Last known location:</p>
                                    ` + strLocationURL + `
                                </div>
                                <div>
                                    <p class="card-text text-muted mb-0">First seen in:</p>
                                    `+ strOriginURL +`
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $("#main").append( strHTMLCard );

        /**
         * Get&Display episodes* from API with AJAX
         */
        $.each( response.episode, function(key, value) {
            $.ajax({
                type: "GET",
                url : value,
                success: function (response) {
                    $("#tbody").append(
                        `<tr>
                            <td> <a href="/episode#${response.id}" class="link-primary text-decoration-none">${response.episode}</a></td>
                            <td>${response.name}</td>
                        </tr>`
                    )
                }
            })
        })

    }
});
/** END Get&Display characterData* */

