<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * message model for messages table.
 *  @author Sumit <sumit.sharma@nmgtechnologies.com>
 *  @since 1.0.0
 */
class Message extends Model
{
    /**
     * attributes which can be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        "sender_id",
        "content",
        "receiver_id",
    ];

    /**
     * one to one relationship with user model.
     *
     * @return void
     */
    public function sender()
    {
        return $this->belongsTo(User::class, "sender_id");
    }
  /**
     * one to one relationship with user model.
     *
     * @return void
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, "receiver_id");
    }
    /**
     * get messges
     *
     * @param [int] $userId
     * @return void
     */
    public function getMessages($userId = null)
    {
        $query = $this->where('sender_id', $userId)->orwhere("receiver_id", $userId)->orWhereNull("receiver_id")->get();
        return $query;

    }

    public static function rules()
    {
        return [
            "content" => ["bail", "required", "max:255"],
        ];
    }

}
