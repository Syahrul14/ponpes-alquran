<?php

namespace App\Repositories\Administrator\Dashboard;

use App\Models\Administrator\Contact\ContactMessageModel;
use App\Models\Administrator\Contact\ContactInfoModel;
use App\Models\Administrator\Information\News\NewsModel;
use App\Models\Administrator\Information\Informasi\InformasiModel;
use App\Models\Administrator\Academic\Program\ProgramCardModel;
use App\Models\Administrator\Academic\Prestasi\PrestasiCardModel;
use App\Models\Administrator\Facility\FasilitasCardModel;
use App\Models\Administrator\Infaq\InfaqBankTransferModel;
use App\Models\Administrator\Infaq\InfaqQrisModel;
use App\Models\Administrator\Setting\FooterSettingModel;
use App\Models\User;

class DashboardRepository
{
    public function getDashboardData()
    {
        return [
            'unreadMessagesCount' => ContactMessageModel::where('is_read', false)->count(),
            'totalMessagesCount'  => ContactMessageModel::count(),
            'recentMessages'      => ContactMessageModel::latest()->take(5)->get(),
            'totalNewsCount'      => NewsModel::count(),
            'totalInfoCount'      => InformasiModel::count(),
            'recentNews'          => NewsModel::latest()->take(5)->get(),
            'totalPrograms'       => ProgramCardModel::count(),
            'totalPrestasi'       => PrestasiCardModel::count(),
            'totalFacilities'     => FasilitasCardModel::count(),
            'totalBanks'          => InfaqBankTransferModel::count(),
            'qris'                => InfaqQrisModel::first(),
            'totalAdmins'         => User::count(),
            'footerSetting'       => FooterSettingModel::first(),
            'contactInfo'         => ContactInfoModel::first(),
        ];
    }
}

