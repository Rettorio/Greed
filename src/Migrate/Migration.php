<?php
namespace Core\Migrate;

interface Migration {
    public function run() :void;
}