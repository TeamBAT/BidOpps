<?php
session_start();
$user_id = $_SESSION['SESS_MEMBER_ID'];
// DB table to use
$table = 'submission_info';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'title', 'dt' => 1 ),
    array( 'db' => 'status', 'dt' => 2),
    array( 'db' => 'last_updated', 'dt' => 3)

);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'bidopps_db',
    'host' => 'localhost'
);

require( 'ssp.class.php' );

$where = "`needs_clarification` = 1 AND `bidder_id` = $user_id";

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where)
);

?>