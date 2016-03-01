#!/bin/bash
while true; do
    read -p "Push to the webserver? " yn
    case $yn in
        [Yy]* ) sudo rm -rf /var/www/* ; sudo cp -r ./* /var/www/; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done

