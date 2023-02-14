<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardrobeItemDraft extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_DECLINED = 'declined';

    protected $table = 'wardrobe_item_drafts';

    protected $fillable = [
        'name', 'image', 'sex', 'status'
    ];

    public function getStatus()
    {
        return self::statusesList()[$this->status];
    }

    public static function statusesList()
    {
        return [
            self::STATUS_DRAFT => 'Не просмотрен',
            self::STATUS_APPROVED => 'Одобрен',
            self::STATUS_DECLINED => 'Отклонен'
        ];
    }
}
