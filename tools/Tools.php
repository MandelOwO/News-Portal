<?php

class Tools
{


    public function convertDate($date)
    {
        $date = date_create($date);
        return date_format($date, 'd.m.Y H:i');
    }
}