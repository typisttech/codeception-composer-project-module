<?php

use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('runComposerInstall');

$I->amGoingTo('remove vendor directory and reinstall them');
$I->deleteDir('vendor');
$I->runComposerInstall();

$I->wantToTest('composer package dependencies are reinstalled');
$I->openFile('vendor/dummy/dummy/composer.json');
$I->seeInThisFile('"name": "dummy/dummy"');
