<?php
define ( "QUERY_STRING", "SELECT casee , count(*) FROM m_ais
						  where delete_flag = 0
						  GROUP BY casee;"
);
?>
