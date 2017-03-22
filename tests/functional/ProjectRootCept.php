<?php use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('project root installed as composer project');

$I->openFile('composer.json');
$I->seeInThisFile('"who-am-i": "project root"');
