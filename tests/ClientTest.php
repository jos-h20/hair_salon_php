<?php

    /**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Client.php";
   require_once "src/Stylist.php";

   $server = 'mysql:host=localhost;dbname=hair_salon_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);

   class ClientTest extends PHPUnit_Framework_TestCase
   {
    //    protected function tearDown()
    //    {
    //        Stylist::deleteAll();
    //        Client::deleteAll();
    //    }

       function test_getName()
       {
           $client_name = "Fred";
           $stylist_id = 1;
           $id = null;
           $test_client = New Client($client_name, $stylist_id, $id);

           $result = $test_client->getName();

           $this->assertEquals($client_name, $result);
       }


   }

?>
