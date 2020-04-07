<?php
    function dateFormat($date) 
    {        
            setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
            
            $com_date = ucfirst(strftime("%A %d ", strtotime($date)));
            $com_date .= ucfirst(strftime("%B %Y à %T", strtotime($date)));
            
            return $com_date;
    }