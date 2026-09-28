<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::doLogin');
$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function($routes){
$routes->get('/', 'Home::index');

$routes->group('', ['filter' => 'role:staff'], function($routes){

$routes->get('members', 'MemberController::index');
$routes->get('members/create', 'MemberController::create'); //menarik form tambah
$routes->post('members/insert', 'MemberController::insert');// Mengirim data ke database
$routes->get('members/edit/(:num)', 'MemberController::edit/$1');//Menarik data dari tabel
$routes->post('members/update/(:num)', 'MemberController::update/$1');//Mengirim data dari tabel
$routes->get('members/inactive/(:num)', 'MemberController::inactive/$1');
$routes->get('members/active/(:num)', 'MemberController::active/$1');

$routes->get('membership', 'MembershipController::index');
$routes->get('membership/create', 'MembershipController::create'); //menarik form tambah
$routes->post('membership/insert', 'MembershipController::insert');// Mengirim data ke database
$routes->get('membership/edit/(:num)', 'MembershipController::edit/$1');//Menarik data dari tabel
$routes->post('membership/update/(:num)', 'MembershipController::update/$1');//Mengirim data dari tabel

$routes->get('trainers', 'TrainersController::index');
$routes->get('trainers/create', 'TrainersController::create'); //menarik form tambah
$routes->post('trainers/insert', 'TrainersController::insert');// Mengirim data ke database
$routes->get('trainers/edit/(:num)', 'TrainersController::edit/$1');//Menarik data dari tabel
$routes->post('trainers/update/(:num)', 'TrainersController::update/$1');//Mengirim data dari tabel
$routes->get('trainers/inactive/(:num)', 'TrainersController::inactive/$1');
$routes->get('trainers/active/(:num)', 'TrainersController::active/$1');

$routes->get('classes', 'ClassesController::index');
$routes->get('classes/create', 'ClassesController::create'); //menarik form tambah
$routes->post('classes/insert', 'ClassesController::insert');// Mengirim data ke database
$routes->get('classes/edit/(:num)', 'ClassesController::edit/$1');//Menarik data dari tabel
$routes->post('classes/update/(:num)', 'ClassesController::update/$1');//Mengirim data dari tabel
$routes->get('classes/delete/(:num)', 'ClassesController::delete/$1');//Mengirim data dari tabel
$routes->get('classes/no/(:num)', 'ClassesController::no/$1');
$routes->get('classes/yes/(:num)', 'ClassesController::yes/$1');


$routes->get('schedule', 'ScheduleController::index');
$routes->get('schedule/create', 'ScheduleController::create'); //menarik form tambah
$routes->get('schedule/trainers-by-class/(:num)', 'ScheduleController::getTrainerByClass/$1');
$routes->post('schedule/insert', 'ScheduleController::insert');// Mengirim data ke database
$routes->post('schedule/bookinginsert/(:num)', 'ScheduleController::bookinginsert/$1');// Mengirim data ke database
$routes->get('schedule/detail/(:num)', 'ScheduleController::detail/$1');//Menarik data dari tabel
$routes->get('schedule/delete/(:num)', 'ScheduleController::delete/$1');//Mengirim data dari tabel
$routes->get('schedule/booking/(:num)', 'ScheduleController::booking/$1');//Menarik data dari tabel
$routes->get('schedule/on_going/(:num)', 'ScheduleController::on_going/$1');
$routes->get('schedule/finish/(:num)', 'ScheduleController::finish/$1');
$routes->get('schedule/cancel/(:num)', 'ScheduleController::cancel/$1');
$routes->get('schedule/cancelBooking/(:num)', 'ScheduleController::cancelBooking/$1');
$routes->get('schedule/cetak/(:num)', 'ScheduleController::cetak/$1');

});

$routes->group('', ['filter' => 'role:kepala'], function($routes){
$routes->get('laporan/schedule', 'LaporanController::schedule');
$routes->get('laporan/schedule/pdf', 'LaporanController::schedulePdf');
$routes->get('laporan/membership', 'LaporanController::membership');
$routes->get('laporan/membership/pdf', 'LaporanController::membershipPdf');

});
});
