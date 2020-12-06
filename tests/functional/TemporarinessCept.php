<?php

use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('temporary project directory is temporary');

$tmpProjectDir = $I->getTmpProjectDir();
$tmpProjectDir = realpath($tmpProjectDir);

$sysTemptDir = realpath(
    sys_get_temp_dir()
);

$I->assertStringStartsWith($sysTemptDir, $tmpProjectDir);
