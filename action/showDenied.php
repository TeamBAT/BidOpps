<?php

// DB table to use
$table = 'submission_info';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'firstname', 'dt' => 0 ),
    array( 'db' => 'lastname', 'dt' => 1 ),
    array( 'db' => 'category', 'dt' => 2 ),
    array( 'db' => 'title', 'dt' => 3 ),
    array( 'db' => 'status', 'dt' => 4 ),
    array( 'db' => 'id', 'dt' => 5)

);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'bidopps_db',
    'host' => 'localhost'
);


require( 'ssp.class.php' );

$where = "`status`=".'"Denied"';

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);

?>