<?php

use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('amInTmpProjectDir');

$I->amGoingTo('cd to codeception.yml directory and cd back');
$I->amInPath(codecept_root_dir());
$I->assertSame(codecept_root_dir(), getcwd() . '/');

$I->amGoingTo('cd back to tmpProjectDir');
$I->amInTmpProjectDir();

$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);
$I->assertSame(getcwd(), $tmpProjectDir);
