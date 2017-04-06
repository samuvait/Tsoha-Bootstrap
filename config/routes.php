<?php

//  $routes->get('/', function() {
//    HelloWorldController::task_list();
//  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
//  $routes->get('/tasklist', function() {
//    HelloWorldController::task_list();
//  });
  
  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function() {
    UserController::handle_login();
  });
  
  $routes->get('/tasklist/2', function() {
    HelloWorldController::task_modify();
  });
  
  $routes->get('/', function(){
    AskareController::index(); 
  });
  
  $routes->post('/askare', function(){
    AskareController::store();
  });
  
  $routes->get('/askare/new', function(){
    AskareController::create();
  });

  $routes->get('/askare/:id', function($id){
    AskareController::show($id);
  });
  
  $routes->get('/askare/:id/edit', function($id) {
    AskareController::edit($id);
  });
  
  $routes->post('/askare/:id/edit', function($id) {
    AskareController::update($id);
  });
  
  $routes->post('/askare/:id/remove', function($id) {
    AskareController::remove($id);
  });