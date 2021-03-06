<?php
namespace Davzie\ProductCatalog\Attribute\Repositories;
use Davzie\ProductCatalog\Attribute;
use Eloquent as IEloquent;
use App;

class Eloquent extends IEloquent implements Attribute {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attributes';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = [];


    /**
     * Get all the stuffs in the system
     * @return Eloquent
     */
    public function getAll(){
        return $this->orderBy('id','asc')->get();
    }

    /**
     * Delete an attribute by its ID
     * @param  integer $id The attribute ID
     * @return I don't know...
     */
    public function deleteById($id){
        return $this->where('id','=',$id)->delete();
    }

    /**
     * Return the type of attribute
     * @return TypeInterface
     */
    public function type(){
        $typeTransformer = App::make( 'Davzie\ProductCatalog\Attribute\Type' );
        return $typeTransformer->getType( $this->attribute_type_id );        
    }

    /**
     * The relationships to get the attribute sets associated with the attribute
     * @return Eloquent
     */
    public function sets(){
        return $this->belongsToMany( 'Davzie\ProductCatalog\Attribute\Set\Repositories\Eloquent' , 'attribute_attribute_sets' , 'attribute_set_id' , 'attribute_id' );
    }

}