#!/bin/sh

# Needed for deployment over the gitlab
#echo "Remove DATABASE_URL!"
#sed -i "s|'url' => env('DATABASE_URL'),||g" /app/config/database.php

echo "Get nodejs!"
mkdir ~/nodejs-latest
echo "Download and extract nodejs binaries into the created directory"
cd ~/nodejs-latest
wget -c https://nodejs.org/dist/v$NODE_VERSION/node-v$NODE_VERSION-linux-x64.tar.xz
tar xf node-v$NODE_VERSION-linux-x64.tar.xz --strip-components=1
rm -f node-v$NODE_VERSION-linux-x64.tar.xz
wget -c https://www.npmjs.org/install.sh | sh
echo "Set env paths!"
export NODE_HOME=~/nodejs-latest
export PATH=$PATH:$NODE_HOME/bin
export PATH="/app/.heroku/php/bin:${PATH}"
echo "Check key and initialize db!"
cd /app/
grep -s APP_KEY .env
if [ $? = 1 ] || [ ! -f .env ]
then echo APP_KEY=$APP_KEY > .env
  php artisan migrate --force
  php artisan db:seed --force
  php artisan saints:index 
fi

npm set progress=false
npm config set depth 0 
npm install
npm run prod

echo "Remove frontend dependencies!"
rm -fr ~/nodejs-latest

echo "Start Apache!"
exec heroku-php-apache2 public

