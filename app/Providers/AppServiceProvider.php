<?php

    namespace App\Providers;

    use App\SmBackgroundSetting;
    use App\SmGeneralSettings;
    use App\SmNotification;
    use App\SmParent;
    use App\SmRolePermission;
    use App\SmStaff;
    use App\SmStudent;
    use App\SmStyle;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Schema;


    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {


        }

        public function register()
        {
            //
        }
    }
