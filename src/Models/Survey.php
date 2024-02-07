<?php

namespace KUHdo\Survey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Contracts\Survey as SurveyContract;
use KUHdo\Survey\Database\Factories\SurveyFactory;

class Survey extends Model implements SurveyContract
{
    use HasFactory;

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

    protected static function newFactory(): SurveyFactory
    {
        return new SurveyFactory();
    }

    /**
     * Get the questions for the survey.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public static function findOrFailById(int $id): SurveyContract
    {
        return static::findOrFail($id);
    }
}
