<?php

namespace Database\Seeders;

use App\Models\{MenuItem, SitePage};
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    private array $data = [
        [
            'site_page_code' => 'main',
            'icon' => 'icon-chart-pie-36',
            'is_active' => true,
            'sort' => 1000
        ],
        [
            'site_page_code' => 'projects',
            'icon' => 'icon-laptop',
            'is_active' => true,
            'sort' => 900
        ],
        [
            'site_page_code' => 'vacations',
            'icon' => 'icon-single-02',
            'is_active' => true,
            'sort' => 700
        ],
        [
            'site_page_code' => 'employees',
            'icon' => 'icon-world',
            'is_active' => true,
            'sort' => 800
        ],
    ];

    public function run(): void
    {
        $sitePages = SitePage::query()
            ->select('id', 'code')
            ->whereIn('code', array_column($this->data, 'site_page_code'))
            ->get()
            ->keyBy('code');

        foreach ($this->data as $menuItem) {
            if ($sitePages->has($menuItem['site_page_code'])) {
                $menuItem['site_page_id'] = $sitePages->get($menuItem['site_page_code'])->id;

                if (MenuItem::query()->where('site_page_id', $menuItem['site_page_id'])->exists()) {
                    continue;
                }

                unset($menuItem['site_page_code']);

                MenuItem::query()->create($menuItem);
            }
        }
    }
}
