<?php namespace SMAHTCity;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {


	public function replies()
	{
		return $this->hasMany('\SMAHTCity\Reply');
	}

	public function responses()
	{
		return $this->hasMany('\SMAHTCity\Response');
	}

    public function parent()
    {
        return $this->hasOne('\SMAHTCity\Question', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('\SMAHTCity\Question', 'parent_id', 'id');
    }

    public function topicScope($query)
    {
        return $query->where('is_topic', true);
    }
}
