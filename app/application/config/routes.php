<?php
use M151\LibraryOK\Routes;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * All relevant routes for posts
 */

$app->get( '/', Routes\IndexRoute::class);                                          //Posts Side Done
$app->get('/posts/all/[{col}]', Routes\IndexRoute::class);;                         //Posts Side Done
$app->get('/documentations/all/[{col}]', Routes\DocumentationsDisplayRoute::class); //Posts Side Done
$app->get('/questions/all/[{col}]', Routes\QuestionsDisplayRoute::class);           //Posts Side Done
$app->get('/posts/single/[{id}]', Routes\SinglePostRoute::class);                   //Posts Side Done
$app->map(['GET', 'POST'],'/posts/edit/[{id}]', Routes\EditPostRoute::class);       //Posts Side Done
$app->map(['GET', 'POST'],'/posts/change/[{id}]', Routes\MakeChangesRoute::class);  //Posts Side Done
$app->get('/posts/remove/[{id}]', Routes\RemovePostRoute::class);                   //Posts Side Done
$app->map(['GET', 'POST'],'/posts/new', Routes\NewPostRoute::class);                //Posts Side Done
$app->map(['GET', 'POST'],'/posts/add', Routes\AddPostRoute::class);                //Posts Side Done

/**
 *  All relevant routes for users
 */

$app->map(['GET', 'POST'],'/register', Routes\RegisterRoute::class);                //Everyone
$app->map(['GET', 'POST'],'/login', Routes\LoginRoute::class);                      //Everyone
$app->map(['GET', 'POST'],'/logout', Routes\LogoutRoute::class);        //Registered
$app->get('/users/all', Routes\IndexRoute::class);                                  //Only Admin access
$app->get('/users/single/[{name}]', Routes\SingleUserRoute::class);                      //All
