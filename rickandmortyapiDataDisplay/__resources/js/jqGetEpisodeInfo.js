var bolDisplay = false;

if ( document.location.hash !== '' &&
    document.location.hash !== "#0" &&
    document.location.hash !== "#" ) {
    $( function() {
        updateModal( document.location.hash.split("#")[1] )
        $( "#modalEpisode" ).modal('show')
    } )
}

function updateModal( id ) {
    $.ajax({
        type: "GET",
        url: "https://rickandmortyapi.com/api/episode/" + id,
        success: function( data ) {
            $("#modalEpisode #btn-show-characters")[0].innerText = 'Show';
            $("#modalEpisode #characters").empty();
            bolDisplay = false;
            $("#modalEpisode #title")[0].innerText = data.name;
            $("#modalEpisode #air_date")[0].innerText = data.air_date;
            $("#modalEpisode #episode")[0].innerText = data.episode;
            $("#modalEpisode #btn-show-characters").attr('onclick', `toggleCharacters(${id})`);
        }
    })
}
function toggleCharacters( id )
{
    bolDisplay = !bolDisplay;

    if ( bolDisplay ) {
        $.ajax({
            type: "GET",
            url: "https://rickandmortyapi.com/api/episode/" + id,
            success: function( response ) {
                $( "#modalEpisode #btn-show-characters" )[0].innerText = "Hide";
                $( "#modalEpisode #characters" ).empty();

                $.each( response.characters, function(key, val) {
                    $.ajax({
                        type: "GET",
                        url: val,
                        success: function( data ) {
                            $( "#modalEpisode #characters" ).append(`
                                <div class="col-md-5 m-2 p-0 bg-dark text-light rounded">
                                    <img src="${data.image}" class="w-100 rounded">
                                    <h6 class="text-character mt-2">
                                        <a href="/character/${data.id}" class="link-warning text-decoration-none" style="cursor: pointer;">
                                            ${data.name}
                                        </a>
                                    </h6>
                                </div>
                            `)
                        }
                    })
                })
            }
        })
    } else {
        $( "#modalEpisode #btn-show-characters" )[0].innerText = "Show";
        $( "#modalEpisode #characters" ).empty();
    }
}