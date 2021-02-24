<?php

namespace KUHdo\Survey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Database\factories\SurveyFactory;

/**
 * Class Survey
 * @package KUHdo\Survey
 */
class Survey extends Model
{
    use HasFactory;

    /**
     * @return SurveyFactory
     */
    protected static function newFactory(): SurveyFactory
    {
        return new SurveyFactory();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surveys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the questions for the survey.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
