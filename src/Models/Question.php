<?php

namespace KUHdo\Survey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KUHdo\Survey\Database\factories\QuestionFactory;

/**
 * Class Question
 * @package KUHdo\Survey
 */
class Question extends Model
{
    use HasFactory;

    /**
     * @return QuestionFactory
     */
    protected static function newFactory(): QuestionFactory
    {
        return new QuestionFactory();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'question',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the survey that owns the question.
     *
     * @return BelongsTo
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

    /**
     * Get the answers for the question.
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
