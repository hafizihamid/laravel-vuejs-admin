<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'members_group';

    protected $fillable = [
        'groupid',
        'group_name',
        'item_status',
        'perm_list'
    ];
}
