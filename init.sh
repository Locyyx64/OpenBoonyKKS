#!/bin/bash

echo "Note: You have to install XAMPP manually."
dependancies=$(cat dependancies.txt)
apt install $dependancies -y
