Use `npm install --only="dev"` to install grunt modules. Grunt must be installed globally.

`grunt build` will create a zip file from the src and docs directories in the build folder.

Docker-compose up will build a develop environment from the docker_root folder. The site should be available at http://localhost and phpmyadmin at http://localhost:8080

You must copy the version of osCommerce that you plan to use to that folder and run the installer.

`grunt` or `grunt default` will watch the /src directory for changes and map those changes to your docker_root.  

