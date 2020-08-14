<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateJobsTable extends AbstractMigration
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

    //  public function up()
    //  {
    //      $table = $this->table('jobs');
    //  }

    public function change(): void
    {
        $table = $this->table('jobs_prueba');
        $table->addColumn('title','string',['limit' => 40])
              ->addColumn('description','string',['limit' => 100])
              ->addColumn('active','boolean',['default' => true])
              ->addColumn('months','integer',['null' => true])
              ->addColumn('url_image','string',['limit' => 100])
              ->addColumn('created_at','datetime')
              ->addColumn('updated_at','datetime',['null' => true])
              ->addColumn('deleted_at','datetime',['null' => true])
              ->create();
    }
}
