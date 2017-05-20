<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = ['parent_id', 'owner_id', 'deleted_by', 'original_name', 'name', 'type', 'size', 'height', 'width', 'purpose', 'folder', 'dimensions', 'user_agent', 'ip_address', 'deleted_at'];
	
    protected $primaryKey = 'product_id';
    
	protected $table = 'products';
	
	public $timestamps = true;

	public $webRules = array(
        'name' => 'required|min:6|max:100',
        'price' => 'required|numeric',
        'quantity' => 'numeric',
        'type' => 'required|in:regular,healthy'
    );

    public static function boot()
    {
        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
    
	// Upload images
	public function uploadImages($files)
	{
        $folder = date('Y-m');
		if( isset($files['image']) )
        {
            foreach($files['image'] as $key => $val)
            {
                $image_name = generateUniqueFileName($val->getClientOriginalExtension());
                if( $val->move(public_path('uploads'), $image_name) ) 
                {
                    $image = new ProductImages;
                    $image->product_id = $this->product_id;
                    $image->image = $image_name;
                    $image->save();
                }
            }
        }
	}
}