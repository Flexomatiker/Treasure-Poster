<?php

    // At first include both classes
    require_once 'classes/TreasureManager.php';
    require_once 'classes/Treasure.php';

    // Create a new TreasureManager instance with your Elitepvpers credentials as paramter
    $treasureManager = new TreasureManager('Username', 'Password');

    // Create a Treasure objects
    $treasure = new Treasure();
    $treasure->setTitle('Treasure Title');
    $treasure->setContent('Treasure Content');
    $treasure->setCost(10);

    // Submit the Treasure object to the TreasureManager
    $treasureManager->createTreasure($treasure);