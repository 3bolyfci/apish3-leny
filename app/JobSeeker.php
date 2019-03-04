<?php

namespace App;


class JobSeeker extends User
{
    /**
     * class @todo
     *  this jobSeeker belong for one user
     *  so every jobSeeker by default as jobSeeker in system
     **/
    protected $fillable = [
        'status', // status of jobSeeker  [search for job  , employed ,student]
        'bio', // Brief Biography
        'position', //current position if jobSeeker working or not
        'linked_in', //  url of profile in linked in
    ];


    /**
     * @todo 1-1 relation ship
     *  describe relation ship between jobSeeker and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

