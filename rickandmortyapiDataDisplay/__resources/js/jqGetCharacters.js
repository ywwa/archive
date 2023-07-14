/**
 * API Request URL Builing
 */
var baseURL = "https://rickandmortyapi.com/api/character";

if ( document.location.search == "" ||
    document.location.search.split('=')[1] == undefined )
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
    success: function (response) {
        $.each(response.results, function (index, value) { 
            var strLocationURL;
            var strOriginURL;

            if ( value.location.url == "" ) {
                strLocationURL = `<a class="link-dark text-decoration-none">${value.location.name}</a><br><br>`;
            } else {
                strLocationURL = `<a href="/location/${value.location.url.split('/')[5]}" class="link-dark text-decoration-none">${value.location.name}</a><br><br>`;
            }

            if ( value.origin.url == "" ) {
                strOriginURL = `<a class="link-dark text-decoration-none">${value.origin.name}</a>`;
            } else {
                strOriginURL = `<a href="/location/${value.origin.url.split('/')[5]}" class="link-dark text-decoration-none">${value.origin.name}</a>`;
            }

            var strHTML = `
            <div class="col-lg-6 my-2">
                <div class="card bg-light text-dark rounded">
                    <div class="d-flex flex-row">
                        <div>
                            <img src="${value.image}" alt="" width="256" height="256" class="rounded">
                        </div>
                        <div class="m-3 d-flex align-items-center">
                            <div class="d-flex flex-column">
                                <div>
                                    <a href="/character/${value.id}" class="link-dark text-decoration-none h4">${value.name}</a>
                                    <p>${value.status} - ${value.species}</p>
                                </div>
                                <div>
                                    <span class="text-secondary h6">Last known location:</span><br>
                                    ` + strLocationURL + `
                                    <span class="text-secondary h6">First seen in:</span><br>
                                    ` + strOriginURL + `
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `.trim();
            $("#main").append(strHTML);
        });
        if ( strPage == "?page=1" ) {
            $("#nav").append(`
                <div class="row row mx-0 my-3 p-0">
                    <a href="/character?page=${response.info.next.split('/')[4].split('=')[1]}" class="btn btn-outline-warning">Next page</a>
                </div>
            `)
        }
        else if ( response.info.next == null ) {
            $("#nav").append(`
                <div class="row mx-0 my-3 p-0">
                    <a href="/character?page=${response.info.prev.split('/')[4].split('=')[1]}" class="btn btn-outline-warning">Previous page</a>
                </div>
            `)
        }
        else {
            $("#nav").append(`
                <div class="col mx-3 my-3 p-0 text-end">
                    <a href="/character?page=${response.info.prev.split('/')[4].split('=')[1]}" class="btn btn-outline-warning" style="width: 150px">Previous page</a>
                </div>
                <div class="col mx-3 my-3 p-0 text-start">
                    <a href="/character?page=${response.info.next.split('/')[4].split('=')[1]}" class="btn btn-outline-warning" style="width: 150px">Next page</a>
                </div>
            `)
        }
        
    }
});
/** END Get&Display results* */
