<?php

use TypistTech\CodeceptionComposerProjectModule\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantToTest('runComposerCommand');

$expectComposerV1 = (bool) getenv('EXPECT_COMPOSER_V1');
$expectedComposerMajorVersion = $expectComposerV1 ? 'Composer version 1.10.' : 'Composer version 2.';

$I->runComposerCommand('--version --no-ansi');

$I->seeInShellOutput($expectedComposerMajorVersion);
