#!/bin/bash

#plugin path from ilias-root:
PLUGINPATH='Customizing/global/plugins/Services/Cron/CronHook/AutomaticUserAdministration';
SCRIPT_PATH=$(dirname "$0");
cd $SCRIPT_PATH;

# note: no more parameters
phpunit --bootstrap ./vendor/autoload.php tests;

#first param is path to ilias installation
if [ $1 ] ; then
	cd $1;
	echo;
	echo 'now running ILIAS tests in ' $1;
	phpunit --bootstrap ./$PLUGINPATH/classes/autoload.php $PLUGINPATH/tests_ilias
fi
