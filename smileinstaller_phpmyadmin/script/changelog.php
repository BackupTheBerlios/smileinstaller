<?php
// Simple script to set correct charset for changelog
/* $Id: changelog.php,v 1.1 2005/02/03 06:03:56 nuhpardon Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

header('Content-type: text/plain; charset=utf-8');
readfile('ChangeLog');
?>
