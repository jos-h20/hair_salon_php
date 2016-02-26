<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Stylist::deleteAll();
          Client::deleteAll();

        }

        function test_getStylistName()
        {
            //Arrange
            $stylist_name = "Frida";
            $test_Stylist = new Stylist($stylist_name);

            //Act
            $result = $test_Stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }
        function test_getId()
        {
            //Arrange
            $stylist_name = "Frida";
            $id = 1;
            $test_Stylist = new Stylist($stylist_name, $id);

            //Act
            $result = $test_Stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
            //Arrange
            $stylist_name = "Frida";
            $test_Stylist = new Stylist($stylist_name);
            $test_Stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_Stylist, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $stylist_name = "Frida";
            $stylist_name2 = "Harriet";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Frida";
            $stylist_name2 = "Harriet";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
        function test_find()
        {
            //Arrange
            $stylist_name = "Frida";
            $stylist_name2 = "Harriet";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);
        }
        function test_getClients()
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

            $result = $new_stylist->getClients();

            $this->assertEquals([$new_client, $new_client2], $result);
        }
        function testUpdate()
        {
            //Arrange
            $stylist_id = "Frida";
            $id = null;
            $test_stylist = new Stylist($stylist_id, $id);
            $test_stylist->save();

            $new_stylist_id = "Harriet";

            //Act
            $test_stylist->update($new_stylist_id);

            //Assert
            $this->assertEquals("Harriet", $test_stylist->getStylistName());
        }
        function testDelete()
        {
            //Arrange
            $stylist_id = "Frida";
            $id = null;
            $test_stylist = new Stylist($stylist_id, $id);
            $test_stylist->save();

            $stylist_id2 = "Harriet";
            $test_stylist2 = new Stylist($stylist_id2, $id);
            $test_stylist2->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }
    }

?>
