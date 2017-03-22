<?php use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('temporary project directory is temporary');

$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);

$I->assertContains(sys_get_temp_dir(), $tmpProjectDir);
