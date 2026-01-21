<?php

namespace PahalNGO;

use Illuminate\Database\Eloquent\Model;

class VolunteerSubmission extends Model {
    protected $table = 'volunteer_submissions';
    protected $fillable = ['name', 'email', 'phone', 'area_of_interest', 'availability', 'message', 'ip_address', 'submitted_at'];
    public $timestamps = false;
}
