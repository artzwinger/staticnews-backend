#!/bin/bash
./vendor/bin/sail artisan migrate:refresh
./vendor/bin/sail artisan ide-helper:models --write --reset
