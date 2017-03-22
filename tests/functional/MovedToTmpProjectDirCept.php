<?php use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('cd-ed to temporary project directory when test starts');

$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);
$I->assertSame(getcwd(), $tmpProjectDir);
