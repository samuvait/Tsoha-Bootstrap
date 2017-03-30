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
    HelloWorldController::login();
  });
  
  $routes->get('/tasklist/1', function() {
    HelloWorldController::task_page();
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