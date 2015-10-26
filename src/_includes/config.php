<?php 
$ENV_DIR = '../../';
$ENV_FILE_PATH = "$ENV_DIR.env";

/*
If running on Heroku or the Environment Variables have been set
another way this means we won't get an error from Dotenv.
*/
if(file_exists($ENV_FILE_PATH)) {
  $dotenv = new Dotenv\Dotenv('../../');
  $dotenv->load();
}
