<?php

    /**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Client.php";
   require_once "src/Stylist.php";

   $server = 'mysql:host=localhost;dbclient_name=hair_salon_test';
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

       function test_getClientName()
       {
           $client_name = "Fred";
           $stylist_id = 1;
           $id = null;
           $test_client = New Client($client_name, $stylist_id, $id);

           $result = $test_client->getClientName();

           $this->assertEquals($client_name, $result);
       }
       function test_getId()
       {
           $client_name = "Fred";
           $stylist_id = 1;
           $id = 1;
           $test_client = new Client($client_name, $stylist_id, $id);

           $result = $test_client->getId();

           $this->assertEquals(true, is_numeric($result));
       }
       function test_getStylistId()
       {
           $client_name = "Fred";
           $stylist_id = 1;
           $id = 1;
           $test_client = new Client($client_name, $stylist_id, $id);

           $result = $test_client->getStylistId();

           $this->assertEquals(true, is_numeric($result));
       }


   }

?>
