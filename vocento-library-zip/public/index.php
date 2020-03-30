<?php
print_r("index.php");
require_once '../vendor/autoload.php';
//print_r(get_included_files());

use League\Consumers\Notifier;
use League\Consumers\Phone;

$notifier = new Notifier("20190330", "real-madrid");
$phone = new Phone("1234");
$notifier->add_observer($phone);
$notifier->add_observer(new Phone("5678"));
$notifier->notify_observers();
