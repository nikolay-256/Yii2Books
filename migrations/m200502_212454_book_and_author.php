<?php

use yii\db\Migration;

/**
 * Class m200502_212454_book_and_author
 */
class m200502_212454_book_and_author extends Migration
{
    public function up()
    {
	    $this->createTable('book', [
		    'id' => $this->primaryKey(),
		    'author_id' => $this->integer()->notNull(),
		    'title' => $this->string(),
	    ]);
	    
	    $this->createTable('author', [
		    'id' => $this->primaryKey(),
		    'name' => $this->string(),
	    ]);
	    
	    // creates index for column `author_id`
	    $this->createIndex(
		    'idx-book-author_id',
		    'book',
		    'author_id'
	    );

	    // add foreign key for table `author`
	    $this->addForeignKey(
		    'fk-book-author_id',
		    'book',
		    'author_id',
		    'author',
		    'id',
		    'CASCADE'
	    );
    }

    public function down()
    {
	    // drops foreign key for table `author`
	    $this->dropForeignKey(
		    'fk-book-author_id',
		    'book'
	    );
    	
	    // drops index for column `author_id`
	    $this->dropIndex(
		    'idx-book-author_id',
		    'book'
	    );
    	
	    $this->dropTable('book');
	    $this->dropTable('author');
    }
    
}
