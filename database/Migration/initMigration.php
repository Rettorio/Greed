<?php
namespace DB\Migration;

use Core\Migrate\Migration;
use Core\Migrate\Scheme;
use Core\Migrate\SchemeBuilder;

class initMigration implements Migration {
    

    public function run() :void {
        Scheme::create("user", function(SchemeBuilder $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->string("email")->unique();
            $table->string("password")->nullable(false);
        });

        Scheme::create("session", function(SchemeBuilder $table) {
            $table->id();
            $table->string("session_id", 50)->unique();
            $table->timestamp("expire_date")->nullable(false);
            $table->foreignId("user_id")->constrained("user")
                                        ->onUpdate("cascade")
                                        ->onDelete("restrict");
        });
    }
}