<?php

    function getStatus($getData){
        $data = [];
        $data[0] = "Inactive";
        $data[1] = "Active";
        return $data[$getData];
    }
    function getStatusColor($getData){
        $data = [];
        $data[0] = "danger";
        $data[1] = "success";
        return $data[$getData];
    }


?>