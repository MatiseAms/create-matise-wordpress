# install wordpress and plugins
composer install

# link valet to the public folder
cd public
valet link <%= name %>
cd ..

valet secure <%= name %>
valet db create <%= name %>

# start developing
# npm run dev
