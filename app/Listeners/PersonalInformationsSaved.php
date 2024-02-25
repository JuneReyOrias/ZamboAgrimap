<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PersonalInformationsSaveds;

use App\Models\FarmProfile;

class PersonalInformationsSaved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PersonalInformationsSaved $event)
    {
        $personalInformationId = $event->personalInformation->id;
        
        // Use $personalInformationId to create FarmProfile record
        // Example:
        FarmProfile::create([
            'personal_information_id' => $personalInformationId,
            // Other fields...
        ]);
    }
}
