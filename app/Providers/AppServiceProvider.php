<?php

namespace App\Providers;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Brand;
use App\Models\Social;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\CompanyInformation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $maincate = Cache::rememberForever("maincate", function () {
            return Category::with(['subCategory',
                'subCategory.reSubCategory',
                'subCategory.reSubCategory.reReSubCategory',
                'subCategory.reSubCategory.reReSubCategory.reReReSubCategory',
            ])->isActive()->isDeleted()->get();
        });

        $limitCategory = Cache::rememberForever("limitCategory", function () {
            return Category::isDeleted()->isActive()->orderBy('id', 'ASC')->select(['slug', 'id', 'name'])->withCount('Product')->limit(5)->get();
        });

        $aboutUs = Cache::rememberForever("aboutUs", function () {
            return AboutUs::select(['details', 'id'])->where('keyword', 'about_us')->first();
        });
        $brands = Cache::rememberForever("brands", function () {
            return Brand::isDeleted()->isActive()->select(['image', 'url'])->orderBy('id', 'DESC')->get();
        });
        $icon = Cache::rememberForever("icon", function () {
            return Social::select(['facebook', 'twitter', 'linkend', 'youtube', 'skype', 'google_plus', 'feed'])->first();
        });
        $companyInformation = Cache::rememberForever("companyInformation", function () {
            return CompanyInformation::first();
        });
        $Seo = Cache::rememberForever("icon", function () {
            return Seo::first();
        });

       

        $today            = Carbon::now(new DateTimeZone('Asia/Dhaka'))->format('d H:i:s');
        $eleven_start     = "11" . " 00:00:01";
        $eleven           = "11" . " 23:59:59";
        $twenty_two_start = "22" . " 00:00:01";
        $twenty_two       = "22" . " 23:59:59";

        view()->share('maincate', $maincate);
        view()->share('limitCategory', $limitCategory);
        view()->share('aboutUs', $aboutUs);
        view()->share('brands', $brands);
        view()->share('icon', $icon);
        view()->share('companyInformation', $companyInformation);
        view()->share('Seo', $Seo);
        view()->share('today', $today);
        view()->share('eleven', $eleven);
        view()->share('eleven_start', $eleven_start);
        view()->share('twenty_two_start', $twenty_two_start);
        view()->share('twenty_two', $twenty_two);

        Paginator::useBootstrap();
    }
}
