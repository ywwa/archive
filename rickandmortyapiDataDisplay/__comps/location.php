<div class="container-fluid bg-dark min-vh-100">
    <div class="container bg-dark text-light py-5">
        <div class="row" id="main"></div>
        <div class="row" id="nav"></div>

        <div id="modals">
            <div class="modal fade" id="modalLocation" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header" style="border-bottom: var(--bs-modal-header-border-width) solid var(--bs-dark)">
                            <h3 class="modal-title fs-5" id="title"></h3>
                            <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-dark text-light">
                            <div class="d-flex justify-content-around ">
                                <div>
                                    <p class="text-muted mb-0">Dimension:</p>
                                    <p id="dimension"></p>
                                </div>
                                <div>
                                    <p class="text-muted mb-0">Type:</p>
                                    <p id="type"></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p class="text-muted mb-0 mx-2 d-flex align-items-center">Residents:</p>
                                <button type="button" onClick="toggleResidents(NULL)" id="btn-show-residents" class="mx-2 btn btn-outline-warning">Show</button>
                            </div>
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center mt-2" id="residents">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>