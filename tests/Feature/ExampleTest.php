<?php

it('should be redirected when not login')->get('/')->assertStatus(302);
it('should be has login page')->get('/login')->assertStatus(200);
it('should be has register page')->get('/register')->assertStatus(200);
