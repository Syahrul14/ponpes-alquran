<?php

namespace App\Repositories\Administrator\Setting;

use App\Models\Administrator\Setting\FooterSettingModel;
use App\Models\Administrator\Setting\FooterSocialMediaModel;

class FooterSettingRepository
{
    public function getFooterSetting()
    {
        return FooterSettingModel::first();
    }

    public function updateOrCreateFooterSetting(array $data)
    {
        $setting = FooterSettingModel::first();
        if ($setting) {
            $setting->update($data);
            return $setting;
        }

        return FooterSettingModel::create($data);
    }

    public function getSocialMediaList()
    {
        return FooterSocialMediaModel::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
    }

    public function findSocialMedia($id)
    {
        return FooterSocialMediaModel::findOrFail($id);
    }

    public function storeSocialMedia(array $data)
    {
        return FooterSocialMediaModel::create($data);
    }

    public function updateSocialMedia($id, array $data)
    {
        $socialMedia = FooterSocialMediaModel::findOrFail($id);
        $socialMedia->update($data);
        return $socialMedia;
    }

    public function deleteSocialMedia($id)
    {
        $socialMedia = FooterSocialMediaModel::findOrFail($id);
        $socialMedia->delete();
        return $socialMedia;
    }
}

