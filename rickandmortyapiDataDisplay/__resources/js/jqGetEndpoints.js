const BaseURL = "https://rickandmortyapi.com/api";

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

$.ajax({
    type: "GET",
    url: BaseURL,
    success: function (response) {
        // console.log(response)
        $.each(response, function (index, value) { 
            $("#endpoint-buttons").append(`
                <a href="/${index.slice(0, -1)}" class="btn btn-outline-warning btn-lg mx-1" style="width: 150px">${ capitalizeFirstLetter(index) }</a>
            `)
        });
        
    }
});