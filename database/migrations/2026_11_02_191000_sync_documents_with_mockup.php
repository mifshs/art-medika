<?php

use App\Models\Document;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $docs = [
            // Организационные документы
            [
                'category' => 'Организационные документы',
                'title' => 'Устав ООО «МКЦ «Арт-Медика»',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 1,
            ],
            [
                'category' => 'Организационные документы',
                'title' => 'Лицензия на осуществление медицинской деятельности',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 2,
            ],
            [
                'category' => 'Организационные документы',
                'title' => 'Свидетельство о государственной регистрации юридического лица',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 3,
            ],
            [
                'category' => 'Организационные документы',
                'title' => 'Положение об обработке и защите персональных данных',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 4,
            ],

            // Нормативно-правовые документы (в макете раскрыты с 4 документами)
            [
                'category' => 'Нормативно-правовые документы',
                'title' => 'Правила предоставления платных медицинских услуг',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 1,
            ],
            [
                'category' => 'Нормативно-правовые документы',
                'title' => 'Права и обязанности граждан в сфере охраны здоровья',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 2,
            ],
            [
                'category' => 'Нормативно-правовые документы',
                'title' => 'Порядок оказания медицинской помощи по профилю «Косметология»',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 3,
            ],
            [
                'category' => 'Нормативно-правовые документы',
                'title' => 'Порядок оказания медицинской помощи по профилю «Пластическая хирургия»',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 4,
            ],

            // Другие документы
            [
                'category' => 'Другие документы',
                'title' => 'Прейскурант на медицинские услуги клиники',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 1,
            ],
            [
                'category' => 'Другие документы',
                'title' => 'Правила внутреннего распорядка для потребителей услуг',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 2,
            ],
            [
                'category' => 'Другие документы',
                'title' => 'Контактные данные контролирующих органов и организаций',
                'file_url' => 'documents/sample-document.pdf',
                'sort_order' => 3,
            ],
        ];

        foreach ($docs as $doc) {
            Document::updateOrCreate(
                ['title' => $doc['title']],
                [
                    'category' => $doc['category'],
                    'file_url' => $doc['file_url'],
                    'sort_order' => $doc['sort_order'],
                    'published_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
    }
};
