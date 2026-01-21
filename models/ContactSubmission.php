<?php

namespace PahalNGO;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model {
    protected $table = 'contact_submissions';
    protected $fillable = ['name', 'email', 'message', 'ip_address', 'submitted_at'];
    public $timestamps = false; // Using custom submitted_at instead of created_at/updated_at
}
