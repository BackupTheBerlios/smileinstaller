<?php
/* $Id: tbl_properties.php,v 1.1 2005/02/03 06:03:56 nuhpardon Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * Runs common work
 */
require('./tbl_properties_common.php');
$err_url   = 'tbl_properties.php' . $err_url;
$url_query .= '&amp;goto=tbl_properties.php&amp;back=tbl_properties.php';

/**
 * Get table information
 */
require('./tbl_properties_table_info.php');

/**
 * Displays top menu links
 */
require('./tbl_properties_links.php');

?>
<!-- TABLE WORK -->
<?php
/**
 * Query box, bookmark, insert data from textfile
 */
$goto = 'tbl_properties.php';
require('./tbl_query_box.php');

/**
 * Displays the footer
 */
echo "\n";
require_once('./footer.inc.php');
?>
