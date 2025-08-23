<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, HasImages;

    protected $table = "activities";
    use SoftDeletes;

    // Activity types
    const TYPE_EVENT = 1;
    const TYPE_COMPETITION = 2;

    // Activity statuses
    const STATUS_DRAFT = 0;
    const STATUS_UPCOMING = 1;
    const STATUS_ONGOING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'start_date',
        'end_date',
        'registration_deadline',
        'location',
        'thumbnail_image',
        'banner_image',
        'type',
        'status',
        'organizer_id',
        'category_id',
        'max_participants',
        'entry_fee',
        'rules',
        'highlights' // if stored as JSON
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'highlights' => 'array', // if storing as JSON
        'entry_fee' => 'decimal:2',
    ];

    /**
     * Get the organizer of the activity.
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * Get the category of the activity.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Check if activity is an event.
     */
    public function isEvent()
    {
        return $this->type === self::TYPE_EVENT;
    }

    /**
     * Check if activity is a competition.
     */
    public function isCompetition()
    {
        return $this->type === self::TYPE_COMPETITION;
    }

    /**
     * Get the status as a readable string.
     */
    public function getStatusTextAttribute()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_UPCOMING => 'Upcoming',
            self::STATUS_ONGOING => 'Ongoing',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ][$this->status] ?? 'Unknown';
    }

    /**
     * Get the type as a readable string.
     */
    public function getTypeTextAttribute()
    {
        return [
            self::TYPE_EVENT => 'Event',
            self::TYPE_COMPETITION => 'Competition',
        ][$this->type] ?? 'Unknown';
    }
}