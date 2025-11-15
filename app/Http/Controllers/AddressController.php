<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    // address should be checked before storing
    // address with same city, country, state, street_address_1, street_address_2 should not be stored
    // concept is that if order is placed, then address should be checked
    // user can use previously saved his/her address
}
