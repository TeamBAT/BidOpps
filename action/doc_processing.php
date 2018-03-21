<?php
 
// DB table to use
$table = 'opportunity_docs';
 
// Table's primary key
$primaryKey = 'document_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'filename', 'dt' => 0 ),
    array( 'db' => 'filetype',  'dt' => 1 ),
    array( 'db' => 'filesize', 'dt' => 2 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'bidopps_db',
    'host' => 'localhost'
);

 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>