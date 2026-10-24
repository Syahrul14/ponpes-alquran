<?php

namespace App\Repositories\Website\Contact;

use App\Models\Administrator\Contact\ContactMessageModel;

class WebsiteContactRepository
{
    public function storeMessage(array $data)
    {
        return ContactMessageModel::create($data);
    }
}

