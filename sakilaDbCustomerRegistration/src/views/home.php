<?php

include __DIR__ . '/../includes/Database.php';

?>
<section id="main" class="min-vh-100">
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="alert alert-success position-absolute bottom-0 start-50 translate-middle-x fade" id="alert" role="alert">
            Data saved successfully
        </div>

        
        <form id="createCustomerForm" class="text-center">

            <code><h2 class="text-center fw-bold font-monospace">Add Customer</h2></code>

            <div class="row my-2 mt-3">
                <div class="col">
                    <input type="text" name="first_name" id="first_name" class="form-control text-center" placeholder="First name">
                </div>
                <div class="col">
                    <input type="text" name="last_name" id="last_name" class="form-control text-center" placeholder="Last name">
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <input type="email" name="email" id="email" class="form-control text-center" placeholder="Email">
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <input type="text" name="address" id="address" class="form-control text-center" placeholder="Address">
                </div>
                <div class="col">
                    <input type="text" name="address2" id="address2" class="form-control text-center" placeholder="Secondary Address (Optional)">
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <select name="country" id="country" class="form-control text-center">
                        <option value="NULL" selected>Select Country</option>
                        <?php
                            $db = new db();
                            $arrCountry = $db->query("SELECT country_id, country from country")->fetchAll();
                            foreach( $arrCountry as $county => $data )
                                echo sprintf( "<option value=\"%s\">%s</option>", $data['country_id'], $data['country'] );
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select name="city" id="city" class="form-control text-center">
                        <option value="NULL" selected>Select city</option>
                        <?php
                            $arrCity = $db->query("SELECT city_id, city from city")->fetchAll();
                            foreach( $arrCity as $city => $data )
                                echo sprintf( "<option vlaue=\"%s\">%s</option>", $data['city_id'], $data['city'] );
                        ?>
                    </select>
                </div>
            </div>

            <div class="row my-2">
                <div class="col">
                    <select name="store" id="store" class="form-control text-center">
                        <option value="NULL" selected="selected">Select store</option>
                        <?php
                            $arrStore = $db->query("SELECT store.store_id, address.address FROM store INNER JOIN address ON address.address_id = store.address_id")->fetchAll();
                            foreach( $arrStore as $store => $data )
                                echo sprintf( "<option value=\"%s\">%s</option>", $data['store_id'], $data['address'] );
                            $db->close();
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-primary px-5">Sign up</button>
        </form>
    <button id="toggleList" class="btn btn-outline-primary position-absolute bottom-0 start-50 translate-middle-x mb-5">Show/Hide Customers</button>
    </div>
</section>
<section id="customers" class="min-vh-100 d-none">
        <div class="row">
            <div class="col">
                <table id="deactivated" class="table">
                    <thead>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="deactivated-body">
                        <?php
                            $db = new db();
                            $arrCustomers0 = $db->query( "SELECT customer_id, first_name, last_name, email, active FROM customer WHERE active = 0;" )->fetchAll();
                            foreach ( $arrCustomers0 as $customer => $data )
                                echo sprintf( 
                                    "<tr id=\"%s\">
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>
                                            <button onclick=\"jqActivate('%s')\"
                                                class=\"btn btn-success\">
                                                <i class=\"bi bi-check-lg\"></i>
                                            </button>
                                        </td>
                                    </tr>",
                                    $data['customer_id'], 
                                    $data['first_name'], 
                                    $data['last_name'], 
                                    $data['email'],
                                    $data['customer_id']
                                );
                        ?>  
                    </tbody>
                </table>
            </div>
            <div class="col" class="table">
                <table id="activated" class="table">
                    <thead>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="activated-body">
                    <?php
                            $db = new db();
                            $arrCustomers1 = $db->query( "SELECT customer_id, first_name, last_name, email, active FROM customer WHERE active = 1;" )->fetchAll();
                            foreach ( $arrCustomers1 as $customer => $data )
                                echo sprintf( 
                                    "<tr id=\"%s\">
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>
                                            <button onclick=\"jqDeactivate('%s')\"
                                                class=\"btn btn-danger\">
                                                <i class=\"bi bi-trash2-fill\"></i>
                                            </button>
                                        </td>
                                    </tr>",
                                    $data['customer_id'], 
                                    $data['first_name'], 
                                    $data['last_name'], 
                                    $data['email'],
                                    $data['customer_id']
                                );
                        ?>  
                    </tbody>
                </table>
            </div>
        </div>
</section>


<script>
    // Change city list on country select
    $('#country').on( 'change', function ( event ) {
        $.ajax({
            type: "GET",
            url: "/src/includes/manipulateData.php",
            data: {
                "action": "getCityData",
                "country_id": $("#country").val()
            },
            dataType: "json",
            success: function (response) {
                $('#city').empty();
                $('#city').append("<option value=\"NULL\">Select city</option>");
                $.each( response, function(key) {
                    $("#city").append(`<option value="${response[key]['city_id']}">${response[key]['city']}</option>`);
                });
            }
        })
    } )

    // Save data to database
    $('#createCustomerForm').submit( function (event) {
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "/src/includes/manipulateData.php",
            data: {
                "action": "storeData",
                "first_name": $("#first_name").val(),
                "last_name": $("#last_name").val(),
                "email": $("#email").val(),
                "address": $("#address").val(),
                "address2": $("#address2").val(),
                "country_id": $("#country").val(),
                "city_id": $("#city").val(),
                "store_id": $("#store").val()
            },
            dataType: "json",
            success: function (response) {

                // clear fields
                $("#first_name").prop('value', '');
                $("#last_name").prop('value', '');
                $("#email").prop('value', '');
                $("#address").prop('value', '');
                $("#address2").prop('value', '');
                $("#country option[value=\"NULL\"]").prop('selected', true);
                $("#city option[value=\"NULL\"]").prop('selected', true);
                $("#store option[value=\"NULL\"]").prop('selected', true);

                $('#alert').addClass('show');
                setTimeout(() => $('#alert').removeClass('show'), 5000);
                
            },
            error: function ( xhr, status, error ) {
                console.log( xhr, status, error );
            }
        });
    })


    $("#toggleList").on( 'click', function(event) {
        $("#customers").toggleClass('d-none');
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#customers").offset().top
        });
    } )

    function jqActivate(cusID)
    {
        $.ajax({
            type: "POST",
            url: "/src/includes/manipulateData.php",
            data: {
                "action": "activate",
                "customer_id": cusID
            },
            dataType: "json",
            success: function (response) {
                $(`#${cusID}`).remove()
                $.ajax({
                    type: "GET",
                    url: "/src/includes/manipulateData.php",
                    data: {
                        "subaction": "updateActivated"
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#activated-body").empty()
                        $.each( response, function(key) {
                            $("#activated-body").append(
                                `<tr id=\"${response[key]['customer_id']}\">
                                    <td>${response[key]['first_name']}</td>
                                    <td>${response[key]['last_name']}</td>
                                    <td>${response[key]['email']}</td>
                                    <td>
                                        <button onclick=\"jqDeactivate('${response[key]['customer_id']}')\"
                                            class=\"btn btn-danger\">
                                            <i class=\"bi bi-trash2-fill\"></i>
                                        </button>
                                    </td>
                                </tr>`
                            );
                        } )
                    }
                });
            }
        });
    }
    function jqDeactivate(cusID)
    {
        $.ajax({
            type: "POST",
            url: "/src/includes/manipulateData.php",
            data: {
                "action": "deactivate",
                "customer_id": cusID
            },
            dataType: "json",
            success: function (response) {
                $(`#${cusID}`).remove()
                $.ajax({
                    type: "GET",
                    url: "/src/includes/manipulateData.php",
                    data: {
                        "subaction": "updateDeactivated"
                    },
                    dataType: "json",
                    success: function (response) {
                        $("#deactivated-body").empty()
                        $.each( response, function(key) {
                            $("#deactivated-body").append(
                                `<tr id=\"${response[key]['customer_id']}\">
                                    <td>${response[key]['first_name']}</td>
                                    <td>${response[key]['last_name']}</td>
                                    <td>${response[key]['email']}</td>
                                    <td>
                                        <button onclick=\"jqActivate('${response[key]['customer_id']}')\"
                                            class=\"btn btn-success\">
                                            <i class=\"bi bi-check-lg\"></i>
                                        </button>
                                    </td>
                                </tr>`
                            );
                        } )
                    }
                });
            }
        });
    }
</script>