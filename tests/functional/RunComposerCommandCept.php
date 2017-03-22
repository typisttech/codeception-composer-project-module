<?php use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('runComposerCommand');

$I->runComposerCommand('about --no-ansi');

$I->seeInShellOutput('Composer - Package Management for PHP');
