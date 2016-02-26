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
       protected function tearDown()
       {
           Stylist::deleteAll();
           Client::deleteAll();
       }

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
       function test_save()
       {
           $stylist_name = "Harriet";
           $id = null;
           $new_stylist = new Stylist($stylist_name, $id);
           $new_stylist->save();

           $client_name = "Fred";
           $stylist_id = $new_stylist->getId();
           $new_client = new Client($client_name, $stylist_id, $id);
           $new_client->save();

           $result = Client::getAll();

           $this->assertEquals([$new_client], $result);

       }
       function test_getAll()
       {
           $stylist_name = "Harriet";
           $id = null;
           $new_stylist = new Stylist($stylist_name, $id);
           $new_stylist->save();

           $client_name = "Fred";
           $stylist_id = $new_stylist->getId();
           $new_client = new Client($client_name, $stylist_id, $id);
           $new_client->save();

           $client_name2 = "Pete";
           $stylist_id2 = $new_stylist->getId();
           $new_client2 = new Client($client_name2, $stylist_id2, $id);
           $new_client2->save();

           $result = Client::getAll();

           $this->assertEquals([$new_client, $new_client2], $result);
       }
       function test_delete_all()
       {
           $stylist_name = "Harriet";
           $id = null;
           $new_stylist = new Stylist($stylist_name, $id);
           $new_stylist->save();

           $client_name = "Fred";
           $stylist_id = $new_stylist->getId();
           $new_client = new Client($client_name, $stylist_id, $id);
           $new_client->save();

           $client_name2 = "Pete";
           $stylist_id2 = $new_stylist->getId();
           $new_client2 = new Client($client_name2, $stylist_id2, $id);
           $new_client2->save();

           Client::deleteAll();

           $result = Client::getAll();
           $this->assertEquals([], $result);
       }


   }

?>
