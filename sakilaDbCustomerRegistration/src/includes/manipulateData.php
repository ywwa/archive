<?php


include 'Database.php';


if ( strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' )
    $strAction = $_GET['action'];
else $strAction = $_POST['action'];

if ( !empty($_GET['subaction']) ) {
    $strSubAction = $_GET['subaction'];
}

switch ($strAction) {
    case 'getCityData':
        $db = new db();
        $data = $db->query("SELECT city_id, city FROM city WHERE country_id = " . $_GET['country_id'])->fetchAll();
        $db->close();
        return print_r(json_encode($data));
    
    case 'storeData':
        $db = new db();

        $insertAddress = $db->query(
            "INSERT INTO address( address, address2, district, city_id, postal_code, phone, last_update )
            VALUES( ?, ?, 'Valmiera', ?, '', '', NOW() )",
            $_POST['address'], $_POST['address2'], $_POST['city_id']
        );
        $intLastId = $db->lastInsertID();

        $insertCustomer = $db->query(
            "INSERT INTO customer( store_id, first_name, last_name, email, address_id, active, create_date, last_update )
            VALUES( ?, ?, ?, ?, ?, 1, NOW(), NOW() )",
            $_POST['store_id'], $_POST['first_name'], $_POST['last_name'],
            $_POST['email'], $intLastId
        );

        $db->close();
        return print_r(json_encode( array( 'affectedRows' => $insertCustomer->affectedRows() )));

    case 'activate':
        $db = new db();

        $updateCustomer = $db->query(
            "UPDATE customer
            SET 
                active = 1,
                last_update = NOW()
            WHERE customer_id = ?",
            $_POST['customer_id']
        );
        $db->close();
        return print_r(json_encode( array( "affectedRows" => $updateCustomer->affectedRows() ) ) );
    
    case 'deactivate':
        $db = new db();

        $updateCustomer = $db->query(
            "UPDATE customer
            SET 
                active = 0,
                last_update = NOW()
            WHERE customer_id = ?",
            $_POST['customer_id']
        );
        $db->close();
        return print_r(json_encode( array( "affectedRows" => $updateCustomer->affectedRows() ) ) );
        
    default:
        # code...
        break;

}
switch ($strSubAction)
{
    case 'updateActivated':
        $db = new db();
        $arrCustomersActive = $db->query( "SELECT customer_id, first_name, last_name, email, active FROM customer WHERE active = 1;" )->fetchAll();

        $db->close();
        return print_r( json_encode( $arrCustomersActive ) );
    
    case 'updateDeactivated':
        $db = new db();
        $arrCustomersUnactive = $db->query( "SELECT customer_id, first_name, last_name, email, active FROM customer WHERE active = 0;" )->fetchAll();

        $db->close();
        return print_r( json_encode( $arrCustomersUnactive ) );

    default:
        # code...
        break;
}