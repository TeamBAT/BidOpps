<?php

// DB table to use
$table = 'opportunity_docs';
session_start(); 
// Table's primary key
$primaryKey = 'document_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'subheading', 'dt' => 0 ),
    array( 'db' => 'documentTitle',  'dt' => 1 ),
    array( 'db' => 'postedDate', 'dt' => 2 ),
    array( 'db' => 'document_id', 'dt' => 3 ),
    array( 'db' => 'filename', 'dt' => 4 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'bidopps_db',
    'host' => 'localhost'
);

 
require( 'ssp.class.php' );
//here put query as variable then add it at the end of simple inputs
$where = "`opportunity_id`=".$_SESSION['id'];
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where )
);

?>