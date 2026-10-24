<?php

namespace App\Repositories\Administrator\Contact;

use App\Models\Administrator\Contact\ContactInfoModel;

class ContactInfoRepository
{
    public function getData()
    {
        return ContactInfoModel::first();
    }

    public function updateOrCreate(array $data)
    {
        $info = ContactInfoModel::first();
        if ($info) {
            $info->update($data);
            return $info;
        }

        return ContactInfoModel::create($data);
    }
}

