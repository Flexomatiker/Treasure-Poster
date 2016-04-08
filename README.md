# Treasure-Poster
Treasure-Poster is a simple PHP script to create treasures at www.elitepvpers.com

### Version
1.0.

### Installation
Download or clone this repository to your project.
With this code example you should be fine. It's pretty straight forward.

```php
    // At first include both classes
    require_once 'classes/TreasureManager.php';
    require_once 'classes/Treasure.php';

    // Create a new TreasureManager instance with your Elitepvpers credentials as paramter once
    $treasureManager = new TreasureManager('Username', 'Password');

    // Create a Treasure object
    $treasure = new Treasure();
    $treasure->setTitle('Treasure Title');
    $treasure->setContent('Treasure Content');
    $treasure->setCost(10);

    // Submit the Treasure object to the TreasureManager
    $treasureManager->createTreasure($treasure);
```
