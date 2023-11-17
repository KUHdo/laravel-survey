<?php

namespace KUHdo\Survey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use KUHdo\Survey\Contracts\Answer as AnswerContract;
use KUHdo\Survey\Database\Factories\AnswerFactory;

/**
 * Class Answer
 */
class Answer extends Model implements AnswerContract
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
        'created_at',
        'updated_at',
        'model_type',
        'model_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected static function newFactory(): AnswerFactory
    {
        return new AnswerFactory();
    }

    /**
     * Get the question that owns the answer.
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    /**
     * Get the owning answerable model.
     *
     * @deprecated Use votable as relation instead
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the owning answerable model.
     *
     * @since 1.0.0
     */
    public function votable(): MorphTo
    {
        return $this->morphTo('model');
    }

    public static function findOrFailById(int $id): AnswerContract
    {
        return static::findOrFail($id);
    }
}
