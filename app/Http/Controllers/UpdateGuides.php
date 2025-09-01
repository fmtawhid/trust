<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class UpdateGuides extends Controller
{
    public function __construct()
    {
        $this->middleware(['demo'])->only(['runUpdatedCommand']);
    }

    public function index()
    {
        return view('backend.update_guides');
    }

    public function runUpdatedCommand()
    {
        try {
            // Step 1: Clear cachesy
            Artisan::call('cache:clear');
            Artisan::call('optimize:clear');

            // Step 2: DB inserts
            DB::beginTransaction();

            // Insert / update google recaptcha setting
            DB::statement("INSERT INTO `settings` (`id`, `event`, `details`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) 
                VALUES 
                (121, 'google_recaptcha', '{\"site_key\":\"\",\"secret_key\":\"\"}', NULL, 1, NULL, '2025-08-17 04:36:03', NULL)
                ON DUPLICATE KEY UPDATE 
                `details` = VALUES(`details`), `updated_by` = VALUES(`updated_by`), `updated_at` = VALUES(`updated_at`);
            ");

            // Insert / update user types
            DB::statement("INSERT INTO `user_types` (`id`, `uuid`, `user_type_title`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
                (1, 'bf3b4b4c-78ea-11f0-963c-18c04d0cd11f', 'Admin', 1, NULL, NULL, '2025-08-14 08:43:25', '2025-08-14 08:43:25', NULL),
                (2, 'bf3b724f-78ea-11f0-963c-18c04d0cd11f', 'Staff', 1, NULL, NULL, '2025-08-14 08:43:25', '2025-08-14 08:43:25', NULL)
                ON DUPLICATE KEY UPDATE 
                `user_type_title` = VALUES(`user_type_title`),
                `is_active` = VALUES(`is_active`),
                `updated_at` = VALUES(`updated_at`);
            ");

            // Insert / update menu items
            $menuItems = [
                [
                    'uuid'          => '',
                    'parentmenu_id' => 31,
                    'lable'         => 0,
                    'menu_name'     => 'Google Recaptcha',
                    'created_by'    => null,
                    'updated_by'    => null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                    'deleted_at'    => null,
                ],
            ];

            foreach ($menuItems as $item) {
                // Insert or update by menu_name (or another unique field you prefer)
                DB::table('per_menus')->updateOrInsert(
                    ['menu_name' => $item['menu_name']],
                    $item
                );

                // Fetch the actual auto-increment ID
                $menuId = DB::table('per_menus')
                    ->where('menu_name', $item['menu_name'])
                    ->value('id');

                // Define permission actions dynamically
                $actions = ['create', 'update', 'read', 'delete'];

                foreach ($actions as $action) {
                    DB::table('permissions')->updateOrInsert(
                        ['name' => "{$action}_google_recaptcha", 'guard_name' => 'web'],
                        [
                            'name'        => "{$action}_google_recaptcha",
                            'guard_name'  => 'web',
                            'per_menu_id' => $menuId,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ]
                    );
                }
            }

            DB::commit();

            return redirect('admin/update/guides')->with('success', localize('update_completed_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('admin/update/guides')
                ->with('fail', localize('update_failed'));
        }
    }
}
