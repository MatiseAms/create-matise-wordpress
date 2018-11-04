# install wordpress and plugins
composer install

# link valet to the public folder
cd public
valet link <%= name %>
cd ..

# start developing
npm run dev
