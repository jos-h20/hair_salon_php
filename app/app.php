<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();
    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
       'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    /*****INDEX PAGE*****/
    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    /*adding a stylist*/
    $app->post("/stylist", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    /*deletes all stylists and clients*/
    $app->post('/delete_stylists', function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render('index.html.twig');
    });
    /*****END OF INDEX PAGE*****/
    /*****STYLIST PAGE*****/
    /*display single stylist and their clients*/
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist,
        'clients' => $stylist->getClients()));
    });
    /*add a client in stylist*/
    $app->post("/client", function() use ($app) {
        $name = $_POST['name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });
    /*****END OF STYLIST PAGE*****/
    /*****EDIT STYLIST PAGE*****/
    /*route to edit page*/
    $app->get("/stylists_edit/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('edit_stylist.html.twig', array('stylist' => $stylist,
        'clients' => $stylist->getClients()));
    });
    /*edit stylist*/
    $app->patch("/stylists_edit/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('edit_stylist.html.twig', array('stylist' => $stylist,
        'clients' => $stylist->getClients()));
    });
    /*delete stylist*/
    $app->delete("/stylists_edit/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    /*****END OF EDIT STYLIST PAGE*****/
    /*****EDIT CLIENT PAGE*****/
    $app->get("/client/{id}", function($id) use($app) {
        $client = Client::find($id);
        return $app['twig']->render('edit_client.html.twig', array('clients' => $client));
    });
    /*edit client by id*/
    $app->patch("/clients/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $client = Client::find($id);
        $client->update($name);
        return $app['twig']->render('edit_client.html.twig', array('clients' => $client));
    });
    /*delete client by id*/
    $app->delete("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'clients' => Client::getAll()));
    });
    /*****END OF EDIT CLIENT PAGE*****/
    /*****TOTAL*****/
    /*display all*/
    $app->get("/total", function() use ($app){
        $stylist = Stylist::getAll();
        $client = Client::getAll();
        return $app['twig']->render('total.html.twig', array('stylists'=> $stylist, 'clients' => $client));
    });
    /*****END OF TOTAL*****/

    return $app;
 ?>
