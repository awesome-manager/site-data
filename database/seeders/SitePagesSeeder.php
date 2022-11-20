<?php

namespace Database\Seeders;

use App\Models\SitePage;
use Illuminate\Database\Seeder;

class SitePagesSeeder extends Seeder
{
    private array $data = [
        [
            'title' => 'Главная',
            'code' => 'main',
            'link' => '/',
            'is_active' => true
        ],
        [
            'title' => 'Диаграмма ганта',
            'code' => 'gantt',
            'link' => '/projects/gantt',
            'is_active' => true
        ],
        [
            'title' => 'Добавить проект',
            'code' => 'add_project',
            'link' => 'projects/add',
            'is_active' => true
        ],
        [
            'title' => 'Отпуск',
            'code' => 'vacations',
            'link' => '/vacations',
            'is_active' => true
        ],
        [
            'title' => 'Проекты',
            'code' => 'projects',
            'link' => '/projects',
            'is_active' => true
        ],
        [
            'title' => 'Сотрудники',
            'code' => 'employees',
            'link' => '/employees',
            'is_active' => true
        ],
    ];

    public function run(): void
    {
        foreach ($this->data as $el) {
            if (!SitePage::query()->where('code', $el['code'])->exists()) {
                SitePage::query()->create($el);
            }
        }
    }
}
