<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doctors', 'as' => 'doctor.', 'namespace' => 'Doctor'], function () {

        // Route::resource('doctor-appointments', 'DoctorAppointmentController');

});