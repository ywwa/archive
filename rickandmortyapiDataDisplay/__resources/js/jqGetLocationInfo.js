
if ( document.location.hash !== '' && document.location.hash !== '#0' && document.location.hash !== '#' ) {
    $( function() {
        updateModal( document.location.hash.split('#')[1] )
        $("#modalLocation").modal('show')
    } )
}

var bolDisplay = false;

function toggleResidents(id)
{
    bolDisplay = !bolDisplay;

    if ( bolDisplay ) {
        $.ajax({
            type: "GET",
            url: "https://rickandmortyapi.com/api/location/" + id,
            success: function(response) {
                $("#modalLocation #btn-show-residents")[0].innerText = 'Hide';
                $("#modalLocation #residents").empty();
                $.each( response.residents, function(key, val) {
                    $.ajax({
                        type: "GET",
                        url: val,
                        success: function(response) {
                            $("#modalLocation #residents").append(`
                                <div class="col-md-5 m-2 p-0 bg-dark text-light rounded">
                                    <img src="${response.image}" class="w-100 rounded">
                                    <h6 class="text-center mt-2">
                                        <a href="/character/${response.id}" class="link-warning text-decoration-none" style="cursor: pointer;">    
                                            ${response.name}
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
        $("#modalLocation #btn-show-residents")[0].innerText = 'Show';
        $("#modalLocation #residents").empty();
    }
    
}

function updateModal(id)
{
    $.ajax({
        type: "GET",
        url: "https://rickandmortyapi.com/api/location/" + id,
        success : function(response) {
            $("#modalLocation #btn-show-residents")[0].innerText = 'Show';
            $("#modalLocation #residents").empty();
            bolDisplay = false;
            $("#modalLocation #title")[0].innerText = response.name;
            $("#modalLocation #dimension")[0].innerText = response.dimension;
            $("#modalLocation #type")[0].innerText = response.type;
            $("#modalLocation #btn-show-residents").attr("onclick", `toggleResidents(${id})`)
        }
    })
}