<?php
namespace Davzie\ProductCatalog\Category\Entities;
use Davzie\ProductCatalog\Entity;
use App;
use Input;
use Str;

class Create extends Entity {

    protected static $model = 'Davzie\ProductCatalog\Category';

    /**
     * We may want to specify fixed stuff to throw into the database, do so here.
     * @var array
     */
    protected static $defaultData = [
        'enabled'=>1,
    ];

    protected static $rules = [
        'name'          => 'required|max:255',
        'url'           =>  'required|alpha_dash|unique:categories,url',
        'parent_id'     =>  'integer|exists:categories,id',
    ];

    public function __construct(){
        // Default Data
        static::$defaultData['slug'] = Str::slug( Input::get('url') , '-' );
        

        // If we have a 0 through on parent ID then we can assume the user has not chosen anything
        if( Input::get('parent_id') == 0 ){
            unset( static::$rules['parent_id'] );
            static::$defaultData['parent_id'] = null;
        }
    
        parent::__construct();
    }

}