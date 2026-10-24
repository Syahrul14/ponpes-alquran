<?php

namespace App\Repositories\Website\Contact;

use App\Models\Administrator\Contact\ContactInfoModel;
use App\Models\Administrator\Contact\ContactMessageModel;

class WebsiteContactRepository
{
    public function getContactInfo()
    {
        return ContactInfoModel::first();
    }

    public function storeMessage(array $data)
    {
        return ContactMessageModel::create($data);
    }
}
