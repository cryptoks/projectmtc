<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Properties extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $table = $this->table('Properties');

        $table
            ->addColumn('uuid', 'uuid')
            ->addColumn('property_type_id', 'integer', array('null'=>true))
            ->addColumn('county', 'string', array('limit' => 60))
            ->addColumn('country', 'string', array('limit' => 60))
            ->addColumn('town', 'string', array('limit' => 60))
            ->addColumn('description', 'text')
            ->addColumn('address', 'string', array('limit' => 255))
            ->addColumn('image_full', 'text')
            ->addColumn('image_thumbnail', 'text')
            ->addColumn('latitude', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 8
            ])
            ->addColumn('longitude', 'decimal', [
                'default' => null,
                'null' => false,
                'precision' => 11,
                'scale' => 8
            ])
            ->addColumn('num_bedrooms', 'integer')
            ->addColumn('num_bathrooms', 'integer')
            ->addColumn('price', 'integer')
            ->addColumn('type', 'enum', ['values' => ['sale', 'rent']]) //Enum - Sale or Rent
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', array('null' => true))

            ->addIndex(array('uuid'), array('unique' => true))
            ->addForeignKey('property_type_id', 'Property_Types', 'id', array('delete' => 'SET_NULL', 'update' => 'NO_ACTION'))

            ->create();

    }
}
