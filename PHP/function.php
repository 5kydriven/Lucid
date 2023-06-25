<?php
    include 'connect.php';
    function logout() {
        unset($id);
        session_destroy();
        header('location: ../signin.php');
    }

    function trimMail($email) {
        $clean_email = str_replace("@gmail.com", "", $email);
        return $clean_email;
    }

    function getTimeLapse($postTimestamp) {
        date_default_timezone_set('Asia/Manila'); // Set the time zone to the Philippines

        $currentTimestamp = time();
        $postTimestamp = strtotime($postTimestamp); // Convert post timestamp to Unix timestamp
        $diff = $currentTimestamp - $postTimestamp;

        $isPast = ($diff >= 0); // Check if it's a past time or future time
        $diff = abs($diff); // Convert negative to positive value
    
        if ($diff < 60) {
            return $isPast ? $diff . "s ago" : "in " . $diff . "s";
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $isPast ? $minutes . "m ago" : "in " . $minutes . "m";
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $isPast ? $hours . "h ago" : "in " . $hours . "h";
        } else {
            $days = floor($diff / 86400);
            return $isPast ? $days . "d ago" : "in " . $days . "d";
        }
    }