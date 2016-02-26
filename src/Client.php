<?php

    class Client {
        private $client_name;
        private $stylist_id;
        private $id;

        function __construct($client_name, $stylist_id, $id = null)
        {
            $this->client_name = $client_name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

        function setClientName($new_client_name)
        {
            $this->client_name = $new_client_name;
        }

        function getClientName()
        {
            return $this->client_name;
        }
        function getId()
        {
            return $this->id;
        }
        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }
    }




?>
