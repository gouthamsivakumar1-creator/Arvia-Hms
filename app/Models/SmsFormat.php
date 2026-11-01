<?php
namespace App\Models;

class SmsFormat extends \Eloquent {
    protected $table = 'smsFormat';
    protected $fillable = ['type','sender','message'];
}