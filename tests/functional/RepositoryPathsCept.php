<?php

use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('repository paths installed');

$I->openFile('vendor/dummy/dummy/composer.json');
$I->seeInThisFile('"name": "dummy/dummy"');
