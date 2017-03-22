<?php use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('getTmpProjectDir');

$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);

$I->assertSame(getcwd(), $tmpProjectDir);
